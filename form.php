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

    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php
        ini_set('max_execution_time', 0);
    ?>

    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <form action="server.php" method="post" id="generate-form">
                    <input type="hidden" name="generate-form-submit" id="generate-form-submit" value="1" />

                    <div class="form-inline">
                        <h3>Target Scenarios</h3>
                        <label for="probability">Win ratio</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability" id="probability" />

                        <label for="games-count">Total games</label>
                        <input class="form-control" type="text" size="10" maxlength="10" name="games-count" id="games-count" />
                    </div>
                    <br>

                    <input class="btn btn-primary" type="button" id="show-hide-results" value="Show/Hide"/><br>
                    <label id="probability-result">Not generated!</label>

                    <br><hr/><br/>

                    <div class="breakpoint-list" id="breakpoint-list">
                        <div class="form-inline">
                            <label for="min-allowed">Min allowed</label>
                            <input class="form-control" type="text" size="4" maxlength="4" name="min-allowed[]" id="min-allowed" />

                            <label for="desired-day">Desired day</label>
                            <input class="form-control" type="text" size="4" maxlength="4" name="desired-day[]" id="desired-day" />

                            <label for="desired-goal">Desired goal</label>
                            <input class="form-control" type="text" size="4" maxlength="4" name="desired-goal[]" id="desired-goal" />

                            <label for="condition-probability0">Condition probability</label>
                            <output class="form-control" type="text" size="4" maxlength="4" name="condition-probability" id="condition-probability"></output>

                            <button class="btn btn-primary" type="button" id="add-breakpoint">+</button>
                        </div>
                    </div>


                    <div class="form-inline">
                        <label>Add probability for games per day</label><br>

                        <label for="probability-per-day1">1</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day1" id="probability-per-day1" />
                        <label for="probability-per-day2">2</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day2" id="probability-per-day2" />
                        <label for="probability-per-day3">3</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day3" id="probability-per-day3" />
                        <label for="probability-per-day4">4</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day4" id="probability-per-day4" />
                        <label for="probability-per-day5">5</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day5" id="probability-per-day5" />
                        <label for="probability-per-day6">6</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day6" id="probability-per-day6" />
                        <label for="probability-per-day7">7</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day7" id="probability-per-day7" />
                        <label for="probability-per-day8">8</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day8" id="probability-per-day8" />
                        <label for="probability-per-day9">9</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day9" id="probability-per-day9" />
                        <label for="probability-per-day10">10</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day10" id="probability-per-day10" />
                        <label for="probability-per-day11">11</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day11" id="probability-per-day11" />
                        <label for="probability-per-day12">12</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day12" id="probability-per-day12" />
                        <label for="probability-per-day13">13</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day13" id="probability-per-day13" />
                        <label for="probability-per-day14">14</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="probability-per-day14" id="probability-per-day14" />
                        <br>
                    </div>
                    <br>

                    <input class="btn btn-primary" type="button" id="show-hide-probability-per-day-result" value="Show/Hide"/><br>

                    <label id="probability-per-day-result">Not generated!</label>

                    <br><hr/><br/>

                    <div class="form-inline">
                        <h3>Average odds</h3>

                        <label for="min-odd">Min</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="min-odd" id="min-odd" />
                        <label for="max-odd">Max</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="max-odd" id="max-odd" />
                        <label for="avg-odd">Avg</label>
                        <input class="form-control" type="text" size="4" maxlength="4" name="avg-odd" id="avg-odd" />
                        <br>
                    </div>
                    <br>

                    <input class="btn btn-primary" type="button" id="show-hide-generated-odds-result" value="Show/Hide"/><br>

                    <label id="generated-odds-result">Not generated!</label><br>

                    <br><hr/><br/>

                    <button class="btn btn-danger" type="button" name="action" value="Generate" id="generate">Generate</button>
                    <div name="generate-error-result" id="generate-error-result"></div>
                    <br><br><br>
                </form>


                <form action="server.php" method="post" id="analyze-form">
                    <input type="hidden" name="analyze-form-submit" id="analyze-form-submit" value="1" />

                    <input type="hidden" name="analyze-probability-result" id="analyze-probability-result" />
                    <input type="hidden" name="analyze-probability-per-day-result" id="analyze-probability-per-day-result" />
                    <input type="hidden" name="analyze-generated-odds-result" id="analyze-generated-odds-result" />


                    <label for="betting-type">Choose betting type</label>
                    <select name="betting-type" id="betting-type">
                        <option value="0"></option>
                        <option value="1">Singles</option>
                        <option value="2">k/k</option>
                        <option value="3">k-1/k</option>
                        <option value="4">k-1 k/k</option>
                        <option value="5">k-2 k-1 k/k</option>
                    </select>
                    <br/>

                    <h3>Budget management</h3>

                    <label for="budget">Budget</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="budget" id="budget" />
                    <br>

                    <label for="percentage-used">Percentage used</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="percentage-used" id="percentage-used" />
                    <br>

                    <label for="turning-saldo-velocity">Turning saldo velocity</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="turning-saldo-velocity" id="turning-saldo-velocity" />
                    <br>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="dynamic-cream-strategy" id="dynamic-cream-strategy" value="Dynamic Cream Strategy">Dynamic Cream strategy
                        </label>
                    </div>

                    <label for="cream-taker">Cream taker</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="cream-taker" id="cream-taker" />
                    <br>

                    <label for="percentage-for-cream">Percentage for cream</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="percentage-for-cream" id="percentage-for-cream" />
                    <br>

                    <label for="showstopper">Showstopper</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="showstopper" id="showstopper" />
                    <br>

                    <label for="change-criteria">Change criteria</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="change-criteria" id="change-criteria" />
                    <br>

                    <br><hr/><br/>

                    <label for="number-of-tests">Number of tests</label>
                    <input class="form-control" type="text" size="6" maxlength="6" name="number-of-tests" id="number-of-tests" />
                    <br>

                    <br><hr/><br/>

                    <button class="btn btn-success" type="button" name="action" value="Analyze" id="analyze">Analyze</button>
                    <div name="analyze-error-result" id="analyze-error-result"></div>

                    <br><hr/><br/>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row output-result">
            <div class="col-md-12">
                <div class="form-inline">
                </div>
            </div>
        </div>
    </div>

    <br><br>
</body>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="js/main.js"></script>
</html>

