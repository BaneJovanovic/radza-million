jQuery(function($) {
    $("#generate").on({
        click: function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "server.php",
                data: $("#generate-form").serialize()
            }).done(function(data) {
                var obj = JSON.parse(data);
                $("#probability-result").html(obj['array-with-probability'].join(", "));
                $("#probability-per-day-result").html(obj['games-per-day'].join(", "));
                $("#generated-odds-result").html(obj['odds-array'].join(", "));

                $("#analyze-probability-result").val(obj['array-with-probability'].join(", "));
                $("#analyze-probability-per-day-result").val(obj['games-per-day'].join(", "));
                $("#analyze-generated-odds-result").val(obj['odds-array'].join(", "));

                $("#generate-error-result").html(obj['error'].join("<br>"));

                if ($.inArray(1, obj['games-per-day']) != -1) {
                    $("#betting-type option[value=3]").hide();
                    $("#betting-type option[value=4]").hide();
                    if ($("#betting-type option:selected").text() == 3 || $("#betting-type option:selected").text() == 4) {
                        $("#betting-type").val(0);
                    }
                } else {
                    $("#betting-type option[value=3]").show();
                    $("#betting-type option[value=4]").show();
                }

                if ($.inArray(1, obj['games-per-day']) != -1 || $.inArray(2, obj['games-per-day']) != -1) {
                    $("#betting-type option[value=5]").hide();
                    if ($("#betting-type option:selected").text() == 5) {
                        $("#betting-type").val(0);
                    }
                } else {
                    $("#betting-type option[value=5]").show();
                }

                $("#records-table tbody").empty();
            });
        }
    });

    $("#analyze").on({
        click: function(e) {
            e.preventDefault();

            $("#records-table tbody").empty();

            if ($("#analyze-probability-result").val() == '') {
                $("#analyze-validation-result").append('Array with probability not generated!');
            }

            if ($("#analyze-probability-per-day-result").val() == '') {
                $("#analyze-validation-result").append("Array with games per day not generated!");
            }

            if ($("#analyze-generated-odds-result").val() == '') {
                $("#analyze-validation-result").append("Odds array not generated!");
            }

            $.ajax({
                type: "POST",
                url: "server.php",
                data: $("#analyze-form").serialize()
            }).done(function(data) {
                var obj = JSON.parse(data);

                $("#global-max").val(obj['global_max']);
                $("#global-max-position").val(obj['global_max']);
                $("#global-min").val(obj['global_max']);
                $("#global-min-position").val(obj['global_max']);
                $("#earned-total").val(obj['global_max']);
                $("#game-over-amount").val(obj['global_max']);
                $("#total-days-played").val(obj['global_max']);

                $.each(obj['table_data'], function(i, item) {
                    var $odds = $('<td>');
                    $.each(item.DailyOdds, function(j, dailyOdd) {
                        $odds.append(
                            $('<p>').addClass(dailyOdd.class).text(dailyOdd.odd)
                        );
                    });

                    var $tr = $('<tr>').append(
                        $('<td>').text(item.Iteration),
                        $('<td>').text(item.Marker),
                        $('<td>').append($odds),
                        $('<td>').text(item.TB),
                        $('<td>').text(item.MPD),
                        $('<td>').text(item.ET),
                        $('<td>').text(item.CT)
                    );

                    $tr.appendTo("#records-table tbody");
                });
            });
        }
    });

    $("#show-hide-results").on({
        click: function (e) {
            if ($("#probability-result").css("display") == 'none') {
                $("#probability-result").show("slow");
            } else {
                $("#probability-result").hide("slow");
            }
        }
    });

    $("#show-hide-probability-per-day-result").on({
        click: function (e) {
            if ($("#probability-per-day-result").css("display") == 'none') {
                $("#probability-per-day-result").show("slow");
            } else {
                $("#probability-per-day-result").hide("slow");
            }
        }
    });

    $("#show-hide-generated-odds-result").on({
        click: function (e) {
            if ($("#generated-odds-result").css("display") == 'none') {
                $("#generated-odds-result").show("slow");
            } else {
                $("#generated-odds-result").hide("slow");
            }
        }
    });
});
