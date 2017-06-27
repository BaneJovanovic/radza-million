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

            // if ($("#analyze-probability-result").val() == '') {
            //     $("#analyze-error-result").append('Array with probability not generated!');
            // }
            //
            // if ($("#analyze-probability-per-day-result").val() == '') {
            //     $("#analyze-error-result").append("Array with games per day not generated!");
            // }
            //
            // if ($("#analyze-generated-odds-result").val() == '') {
            //     $("#analyze-error-result").append("Odds array not generated!");
            // }

            var wrapper = $(".output-result .col-md-12");
            wrapper.empty();

            $.ajax({
                type: "POST",
                url: "server.php",
                data: $("#generate-form, #analyze-form").serialize()
            }).done(function (data) {
                var obj = JSON.parse(data);

                if ('min_min' in obj) {
                    var multipleMinRow = $('<div>').attr({
                        class: 'form-inline'
                    });

                    $('<label>').attr({
                        for: 'multiple-min-min'
                    }).text('MinMIN').appendTo(multipleMinRow);
                    $('<output>').attr({
                        id: 'multiple-min-min',
                        class: 'form-control'
                    }).val(obj['min_min']).appendTo(multipleMinRow);

                    $('<label>').attr({
                        for: 'multiple-max-min'
                    }).text('MaxMIN').appendTo(multipleMinRow);
                    $('<output>').attr({
                        id: 'multiple-max-min',
                        class: 'form-control'
                    }).val(obj['max_min']).appendTo(multipleMinRow);

                    $('<label>').attr({
                        for: 'multiple-avg-min'
                    }).text('AvgMIN').appendTo(multipleMinRow);
                    $('<output>').attr({
                        id: 'multiple-avg-min',
                        class: 'form-control'
                    }).val(obj['avg_min']).appendTo(multipleMinRow);


                    var multipleMaxRow = $('<div>').attr({
                        class: 'form-inline'
                    });

                    $('<label>').attr({
                        for: 'multiple-min-max'
                    }).text('MinMAX').appendTo(multipleMaxRow);
                    $('<output>').attr({
                        id: 'multiple-min-max',
                        class: 'form-control'
                    }).val(obj['min_max']).appendTo(multipleMaxRow);

                    $('<label>').attr({
                        for: 'multiple-max-max'
                    }).text('MaxMAX').appendTo(multipleMaxRow);
                    $('<output>').attr({
                        id: 'multiple-max-max',
                        class: 'form-control'
                    }).val(obj['max_max']).appendTo(multipleMaxRow);

                    $('<label>').attr({
                        for: 'multiple-avg-max'
                    }).text('AvgMAX').appendTo(multipleMaxRow);
                    $('<output>').attr({
                        id: 'multiple-avg-max',
                        class: 'form-control'
                    }).val(obj['avg_max']).appendTo(multipleMaxRow);


                    var multipleETRow = $('<div>').attr({
                        class: 'form-inline'
                    });

                    $('<label>').attr({
                        for: 'multiple-min-et'
                    }).text('MinET').appendTo(multipleETRow);
                    $('<output>').attr({
                        id: 'multiple-min-et',
                        class: 'form-control'
                    }).val(obj['min_et']).appendTo(multipleETRow);

                    $('<label>').attr({
                        for: 'multiple-max-et'
                    }).text('MaxET').appendTo(multipleETRow);
                    $('<output>').attr({
                        id: 'multiple-max-et',
                        class: 'form-control'
                    }).val(obj['max_et']).appendTo(multipleETRow);

                    $('<label>').attr({
                        for: 'multiple-avg-et'
                    }).text('AvgET').appendTo(multipleETRow);
                    $('<output>').attr({
                        id: 'multiple-avg-et',
                        class: 'form-control'
                    }).val(obj['avg_et']).appendTo(multipleETRow);


                    var multipleGOARow = $('<div>').attr({
                        class: 'form-inline'
                    });

                    $('<label>').attr({
                        for: 'multiple-min-goa'
                    }).text('MinGOA').appendTo(multipleGOARow);
                    $('<output>').attr({
                        id: 'multiple-min-goa',
                        class: 'form-control'
                    }).val(obj['min_goa']).appendTo(multipleGOARow);

                    $('<label>').attr({
                        for: 'multiple-max-goa'
                    }).text('MaxGOA').appendTo(multipleGOARow);
                    $('<output>').attr({
                        id: 'multiple-max-goa',
                        class: 'form-control'
                    }).val(obj['max_goa']).appendTo(multipleGOARow);

                    $('<label>').attr({
                        for: 'multiple-avg-goa'
                    }).text('AvgGOA').appendTo(multipleGOARow);
                    $('<output>').attr({
                        id: 'multiple-avg-goa',
                        class: 'form-control'
                    }).val(obj['avg_goa']).appendTo(multipleGOARow);


                    multipleMinRow.appendTo(wrapper);
                    multipleMaxRow.appendTo(wrapper);
                    multipleETRow.appendTo(wrapper);
                    multipleGOARow.appendTo(wrapper);
                }

                $.each( obj['analyze-data'], function( key, value ) {
                    var row = $('<div>').attr({
                        class: 'form-inline'
                    });

                    $('<label>').attr({
                        for: 'global-max' + key
                    }).text('Max').appendTo(row);
                    $('<output>').attr({
                        id: 'global-max' + key,
                        class: 'form-control'
                    }).val(value['global_max']).appendTo(row);

                    $('<label>').attr({
                        for: 'global-max-position' + key
                    }).text('After iteration').appendTo(row);
                    $('<output>').attr({
                        id: 'global-max-position' + key,
                        class: 'form-control'
                    }).val(value['max_iteration_number']).appendTo(row);

                    $('<label>').attr({
                        for: 'global-min' + key
                    }).text('Min').appendTo(row);
                    $('<output>').attr({
                        id: 'global-min' + key,
                        class: 'form-control'
                    }).val(value['global_min']).appendTo(row);

                    $('<label>').attr({
                        for: 'global-min-position' + key
                    }).text('After iteration').appendTo(row);
                    $('<output>').attr({
                        id: 'global-min-position' + key,
                        class: 'form-control'
                    }).val(value['min_iteration_number']).appendTo(row);

                    $('<label>').attr({
                        for: 'earned-total' + key
                    }).text('Earned Total').appendTo(row);
                    $('<output>').attr({
                        id: 'earned-total' + key,
                        class: 'form-control'
                    }).val(value['earned_total']).appendTo(row);

                    $('<label>').attr({
                        for: 'game-over-amount' + key
                    }).text('Game over amount').appendTo(row);
                    $('<output>').attr({
                        id: 'game-over-amount' + key,
                        class: 'form-control'
                    }).val(value['game_over_amount']).appendTo(row);

                    $('<label>').attr({
                        for: 'total-days-played' + key
                    }).text('Days played').appendTo(row);
                    $('<output>').attr({
                        id: 'total-days-played' + key,
                        class: 'form-control'
                    }).val(value['total_days_played']).appendTo(row);

                    row.appendTo(wrapper);

                    var resultTable = $('<table>').attr({
                        id: 'records-table' + key,
                        class: 'table table-hover'
                    }).append(
                        $('<thead>').append(
                            $('<tr>').attr({
                                class: 'info'
                            }).append(
                                $('<th>').text('#'),
                                $('<th>').text('Marker'),
                                $('<th>').text('Daily odds'),
                                $('<th>').text('TB'),
                                $('<th>').text('MPD'),
                                $('<th>').text('ET'),
                                $('<th>').text('CT')
                            )
                        )
                    );

                    var tableBody = $('<tbody>');

                    $.each(value['table_data'], function (i, item) {
                        var odds = $('<td>');
                        $.each(item.DailyOdds, function (j, dailyOdd) {
                            odds.append(
                                $('<p>').addClass(dailyOdd.class).text(dailyOdd.odd)
                            );
                        });

                        tableBody.append(
                            $('<tr>').append(
                                $('<td>').text(item.Iteration),
                                $('<td>').text(item.Marker),
                                $('<td>').append(odds),
                                $('<td>').text(item.TB),
                                $('<td>').text(item.MPD),
                                $('<td>').text(item.ET),
                                $('<td>').text(item.CT)
                            )
                        );
                    });

                    resultTable.append(tableBody);
                    wrapper.append(resultTable);
                });

                /*
                $("#analyze-error-result").html(obj['error'].join("<br>"));
                */
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

    $("#add-breakpoint").on({
        click: function (e) {
            var count = $("#breakpoint-list button").length;

            var wrapper = $("#breakpoint-list");

            var newBreakpoint = $('<div>').attr({
                class: 'form-inline '
            });

            $('<label>').attr({
                for: 'min-allowed'
            }).text('Min allowed').appendTo(newBreakpoint);
            $('<input>').attr({
                id: 'min-allowed',
                name: 'min-allowed[]',
                size: 4,
                class: 'form-control'
            }).appendTo(newBreakpoint);

            $('<label>').attr({
                for: 'desired-day'
            }).text('Desired day').appendTo(newBreakpoint);
            $('<input>').attr({
                id: 'desired-day',
                name: 'desired-day[]',
                size: 4,
                class: 'form-control'
            }).appendTo(newBreakpoint);

            $('<label>').attr({
                for: 'desired-goal'
            }).text('Desired goal').appendTo(newBreakpoint);
            $('<input>').attr({
                id: 'desired-goal',
                name: 'desired-goal[]',
                size: 4,
                class: 'form-control'
            }).appendTo(newBreakpoint);

            $('<label>').attr({
                for: 'condition-probability'
            }).text('Condition probability').appendTo(newBreakpoint);
            $('<output>').attr({
                id: 'condition-probability',
                name: 'condition-probability',
                class: 'form-control'
            }).appendTo(newBreakpoint);

            $('<button>').attr({
                id: 'remove-breakpoint',
                type: 'button',
                class: 'btn btn-primary form-control'
            }).html('-').appendTo(newBreakpoint);

            newBreakpoint.appendTo(wrapper);
        }
    });

    $("#breakpoint-list").on("click", "button#remove-breakpoint", function(){
        $(this).closest('div').remove();
    });

});
