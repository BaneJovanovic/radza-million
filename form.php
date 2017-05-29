<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Radza Million</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php
        session_start();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" id="main-form">

                    <div class="form-inline">
                        <label for="probability">Win ratio</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability" id="probability"
                               value="<?php echo isset($_POST['probability']) ? $_POST['probability'] : '' ?>" />

                        <label for="games-count">Total games</label>
                        <input class="form-control" type="text" size="10" maxlength="10" name="games-count" id="games-count"
                               value="<?php echo isset($_POST['games-count']) ? $_POST['games-count'] : '' ?>" />
                    </div>
                    <br>

                    <input class="btn btn-primary" type="button" id="show-hide-results" value="Show/Hide"/><br>
                    <label id="probability-result" style="display: none">Not generated!</label><br>
                    <br>

                    <div class="form-inline">
                        <label>Add probability for games per day</label><br>

                        <label for="probability-per-day1">1</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day1" id="probability-per-day1"
                               value="<?php echo isset($_POST['probability-per-day1']) ? $_POST['probability-per-day1'] : '' ?>" />
                        <label for="probability-per-day2">2</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day2" id="probability-per-day2"
                                 value="<?php echo isset($_POST['probability-per-day2']) ? $_POST['probability-per-day2'] : '' ?>" />
                        <label for="probability-per-day3">3</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day3" id="probability-per-day3"
                                 value="<?php echo isset($_POST['probability-per-day3']) ? $_POST['probability-per-day3'] : '' ?>" />
                        <label for="probability-per-day4">4</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day4" id="probability-per-day4"
                                 value="<?php echo isset($_POST['probability-per-day4']) ? $_POST['probability-per-day4'] : '' ?>" />
                        <label for="probability-per-day5">5</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day5" id="probability-per-day5"
                                 value="<?php echo isset($_POST['probability-per-day5']) ? $_POST['probability-per-day5'] : '' ?>" />
                        <label for="probability-per-day6">6</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day6" id="probability-per-day6"
                                 value="<?php echo isset($_POST['probability-per-day6']) ? $_POST['probability-per-day6'] : '' ?>" />
                        <label for="probability-per-day7">7</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day7" id="probability-per-day7"
                                 value="<?php echo isset($_POST['probability-per-day7']) ? $_POST['probability-per-day7'] : '' ?>" />
                        <label for="probability-per-day8">8</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day8" id="probability-per-day8"
                                 value="<?php echo isset($_POST['probability-per-day8']) ? $_POST['probability-per-day8'] : '' ?>" />
                        <label for="probability-per-day9">9</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day9" id="probability-per-day9"
                                 value="<?php echo isset($_POST['probability-per-day9']) ? $_POST['probability-per-day9'] : '' ?>" />
                        <label for="probability-per-day10">10</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day10" id="probability-per-day10"
                                  value="<?php echo isset($_POST['probability-per-day10']) ? $_POST['probability-per-day10'] : '' ?>" />
                        <label for="probability-per-day11">11</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day11" id="probability-per-day11"
                                  value="<?php echo isset($_POST['probability-per-day11']) ? $_POST['probability-per-day11'] : '' ?>" />
                        <label for="probability-per-day12">12</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day12" id="probability-per-day12"
                                  value="<?php echo isset($_POST['probability-per-day12']) ? $_POST['probability-per-day12'] : '' ?>" />
                        <label for="probability-per-day13">13</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day13" id="probability-per-day13"
                                  value="<?php echo isset($_POST['probability-per-day13']) ? $_POST['probability-per-day13'] : '' ?>" />
                        <label for="probability-per-day14">14</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day14" id="probability-per-day14"
                                  value="<?php echo isset($_POST['probability-per-day14']) ? $_POST['probability-per-day14'] : '' ?>" /><br>
                    </div>
                    <br>

                    <input class="btn btn-primary" type="button" id="show-hide-probability-per-day-result" value="Show/Hide"/><br>

                    <label id="probability-per-day-result" style="display: none">Not generated!</label><br>

                    <div class="form-inline">
                        <h3>Average odds</h3>

                        <label for="min-odd">Min</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="min-odd" id="min-odd"
                                  value="<?php echo isset($_POST['min-odd']) ? $_POST['min-odd'] : '' ?>" />
                        <label for="max-odd">Max</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="max-odd" id="max-odd"
                                  value="<?php echo isset($_POST['max-odd']) ? $_POST['max-odd'] : '' ?>" />
                        <label for="avg-odd">Avg</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="avg-odd" id="avg-odd"
                                  value="<?php echo isset($_POST['avg-odd']) ? $_POST['avg-odd'] : '' ?>" /><br>
                    </div>
                    <br>

                    <input class="btn btn-primary" type="button" id="show-hide-generated-odds-result" value="Show/Hide"/><br>

                    <label id="generated-odds-result" style="display: none">Not generated!</label><br>
                    <br><br>

                    <input class="btn btn-danger" type="submit" name="action" value="Generate" id="generate" />
                    <br><br><br>

                    <label for="betting-type">Choose betting type</label>
                    <select name="betting-type" id="betting-type">
                        <option value=""></option>
                        <option value="1" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 1) echo 'selected'; ?> >Singles</option>
                        <option value="2" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 2) echo 'selected'; ?> >k/k</option>
                        <option value="3" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 3) echo 'selected'; ?> >k-1/k</option>
                        <option value="4" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 4) echo 'selected'; ?> >k-1 k/k</option>
                        <option value="5" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 5) echo 'selected'; ?> >k-2 k-1 k/k</option>
                    </select>
                    <br/>

                    <h3>Budget management</h3>

                    <label for="budget">Budget</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="budget" id="budget"
                           value="<?php echo isset($_POST['budget']) ? $_POST['budget'] : '' ?>" /><br>

                    <label for="percentage-used">Percentage used</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="percentage-used" id="percentage-used"
                           value="<?php echo isset($_POST['percentage-used']) ? $_POST['percentage-used'] : '' ?>" /><br>

                    <label for="turning-saldo-velocity">Turning saldo velocity</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="turning-saldo-velocity" id="turning-saldo-velocity"
                           value="<?php echo isset($_POST['turning-saldo-velocity']) ? $_POST['turning-saldo-velocity'] : '' ?>" /><br>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="dynamic-cream-strategy" id="dynamic-cream-strategy" value="Dynamic Cream Strategy"
                            <?php if (isset($_POST['dynamic-cream-strategy'])) echo 'checked'; ?>>Dynamic Cream strategy
                        </label>
                    </div>

                    <label for="cream-taker">Cream taker</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="cream-taker" id="cream-taker"
                           value="<?php echo isset($_POST['cream-taker']) ? $_POST['cream-taker'] : '' ?>" /><br>

                    <label for="percentage-for-cream">Percentage for cream</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="percentage-for-cream" id="percentage-for-cream"
                           value="<?php echo isset($_POST['percentage-for-cream']) ? $_POST['percentage-for-cream'] : '' ?>" /><br>

                    <label for="showstopper">Showstopper</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="showstopper" id="showstopper"
                           value="<?php echo isset($_POST['showstopper']) ? $_POST['showstopper'] : '' ?>" /><br>

                    <label for="change-criteria">Change criteria</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="change-criteria" id="change-criteria"
                           value="<?php echo isset($_POST['change-criteria']) ? $_POST['change-criteria'] : '' ?>" /><br>

                    <input class="btn btn-success" type="submit" name="action" value="Analyze" id="analyze" />
                    <br><br>

                    <div class="form-inline">
                        <label for="global-max">Max</label>
                        <output id="global-max" class="form-control"></output>

                        <label for="global-max-position">After iteration</label>
                        <output id="global-max-position" class="form-control"></output>

                        <label for="global-min">Min</label>
                        <output id="global-min" class="form-control"></output>

                        <label for="global-min-position">After iteration</label>
                        <output id="global-min-position" class="form-control"></output>

                        <label for="earned-total">Earned Total</label>
                        <output id="earned-total" class="form-control"></output>

                        <label for="game-over-amount">Game over amount</label>
                        <output id="game-over-amount" class="form-control"></output>

                        <label for="total-days-played">Days played</label>
                        <output id="total-days-played" class="form-control"></output>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- dodaj rezultat ovde -->
            </div>
        </div>
    </div>





            <?php
        require_once 'radza-million.php';
        $radzaMillion = new RadzaMilion();

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'Generate') {
                $_SESSION['array-with-probability'] = $radzaMillion->generateArrayWithProbability($_POST['games-count'], $_POST['probability']);
                ?>
                <script language="javascript" type="text/javascript">
                    document.getElementById('probability-result').innerHTML = '<?php echo implode("", $_SESSION['array-with-probability']) ?>';
                </script>
                <?php

                $probabilityPerDayData = $radzaMillion->generateInputArrayForGamesPerDay($_POST);
                $_SESSION['games-per-day'] = $radzaMillion->generateGamesPerDayArray($_POST['games-count'], $probabilityPerDayData);
                ?>
                <script language="javascript" type="text/javascript">
                    document.getElementById('probability-per-day-result').innerHTML = '<?php echo implode(" ", $_SESSION['games-per-day']) ?>';
                </script>
                <?php

                $_SESSION['odds-array'] = $radzaMillion->generateOddsArray($_POST['games-count'], $_POST['min-odd'], $_POST['max-odd'], $_POST['avg-odd'])
                ?>
                <script language="javascript" type="text/javascript">
                    document.getElementById('generated-odds-result').innerHTML = '<?php echo implode(" ", $_SESSION['odds-array']) ?>';
                </script>
                <?php

                if (isset($_POST['betting-type']) && $_POST['betting-type'] > 0) {
                    $_SESSION['betting-type'] = $_POST['betting-type'];
                }
            } elseif ($_POST['action'] == 'Analyze') {
                $dataMissing = false;

                if (isset($_SESSION['array-with-probability']) && !empty($_SESSION['array-with-probability'])) {
                    ?>
                    <script language="javascript" type="text/javascript">
                        document.getElementById('probability-result').innerHTML = '<?php echo implode("", $_SESSION['array-with-probability']) ?>';
                    </script>
                    <?php
                } else {
                    $dataMissing = true;
                    echo 'Array with probability not generated!';
                }

                if (isset($_SESSION['games-per-day']) && !empty($_SESSION['games-per-day'])) {
                    ?>
                    <script language="javascript" type="text/javascript">
                        document.getElementById('probability-per-day-result').innerHTML = '<?php echo implode(" ", $_SESSION['games-per-day']) ?>';
                    </script>
                    <?php

                } else {
                    $dataMissing = true;
                    echo 'Array with games per day not generated!';
                }

                if (isset($_SESSION['odds-array']) && !empty($_SESSION['odds-array'])) {
                    ?>
                    <script language="javascript" type="text/javascript">
                        document.getElementById('generated-odds-result').innerHTML = '<?php echo implode(" ", $_SESSION['odds-array']) ?>';
                    </script>
                    <?php

                } else {
                    $dataMissing = true;
                    echo 'Odds array not generated!';
                }

                if (isset($_POST['turning-saldo-velocity']) && $_POST['turning-saldo-velocity'] > 0 && $_POST['turning-saldo-velocity'] < 1) {
                    $dataMissing = true;
                    echo 'Turning saldo velocity must have value higher or equal to 1!';
                }

                if (!$dataMissing) {
                    $creamStrategyData = array(
                        'dynamic_cream_strategy' => isset($_POST['dynamic-cream-strategy']) ? 1 : 0,
                        'cream_taker'            => isset($_POST['cream-taker']) ? $_POST['cream-taker'] : '',
                        'percentage_for_cream'   => isset($_POST['percentage-for-cream']) ? $_POST['percentage-for-cream'] : '',
                        'showstopper'            => isset($_POST['showstopper']) ? $_POST['showstopper'] : '',
                        'change_criteria'        => isset($_POST['change-criteria']) ? $_POST['change-criteria'] : ''
                    );

                    $bettingResults = $radzaMillion->getBettingResults($_POST['betting-type'], $_SESSION['array-with-probability'], $_SESSION['games-per-day'], $_SESSION['odds-array'], $_POST['budget'], $_POST['percentage-used'], $_POST['turning-saldo-velocity'], $creamStrategyData);

                    ?>
                        <script language="javascript" type="text/javascript">
                            document.getElementById('global-max').value = '<?php echo $bettingResults['global_max'] ?>';
                            document.getElementById('global-max-position').value = '<?php echo $bettingResults['max_iteration_number'] ?>';
                            document.getElementById('global-min').value = '<?php echo $bettingResults['global_min'] ?>';
                            document.getElementById('global-min-position').value = '<?php echo $bettingResults['min_iteration_number'] ?>';
                            document.getElementById('earned-total').value = '<?php echo $bettingResults['earned_total'] ?>';
                            document.getElementById('game-over-amount').value = '<?php echo $bettingResults['game_over_amount'] ?>';
                            document.getElementById('total-days-played').value = '<?php echo $bettingResults['total_days_played'] ?>';
                        </script>
                    <?php
                        $tableData = $bettingResults['table_data'];
                    ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>#</th>
                                            <th>Marker</th>
                                            <th>Daily odds</th>
                                            <th>TB</th>
                                            <th>MPD</th>
                                            <th>ET</th>
                                            <th>CT</th>
                                        </tr>
                                        <?php
                                            foreach ($tableData as $item) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $item['Iteration']; ?></td>
                                                        <td><?php echo $item['Marker']; ?></td>
                                                        <td><?php echo $item['Daily odds']; ?></td>
                                                        <td><?php echo $item['TB']; ?></td>
                                                        <td><?php echo $item['MPD']; ?></td>
                                                        <td><?php echo $item['ET']; ?></td>
                                                        <td><?php echo $item['CT']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
        }
    ?>

    <script language="javascript" type="text/javascript">
        var buttonResults = document.getElementById('show-hide-results');
        var buttonPerDay = document.getElementById('show-hide-probability-per-day-result');
        var buttonOdds = document.getElementById('show-hide-generated-odds-result');


        buttonResults.onclick = function() {
            var div = document.getElementById('probability-result');
            if (div.style.display !== 'none') {
                div.style.display = 'none';
            }
            else {
                div.style.display = 'block';
            }
        };

        buttonPerDay.onclick = function() {
            var div = document.getElementById('probability-per-day-result');
            if (div.style.display !== 'none') {
                div.style.display = 'none';
            }
            else {
                div.style.display = 'block';
            }
        };

        buttonOdds.onclick = function() {
            var div = document.getElementById('generated-odds-result');
            if (div.style.display !== 'none') {
                div.style.display = 'none';
            }
            else {
                div.style.display = 'block';
            }
        };
    </script>

</body>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</html>

