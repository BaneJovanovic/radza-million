<?php
    session_start();
?>


<form action="" method="post" id="main-form">

    <label>Win ratio</label><br>
    <input type="text" size="4" maxlength="4" name="probability" id="probability"
           value="<?php echo isset($_POST['probability']) ? $_POST['probability'] : '' ?>" /><br>
    <label for="games-count">Total games</label><br>
    <input type="text" size="10" maxlength="10" name="games-count" id="games-count"
           value="<?php echo isset($_POST['games-count']) ? $_POST['games-count'] : '' ?>" /><br>

    <input type="button" id="show-hide-results" value="Show/Hide"/><br>
    <label id="probability-result"></label><br>
    <br>

    <label>Add probability for games per day</label><br>
    1 <input type="text" size="4" maxlength="4" name="probability-per-day1" id="probability-per-day1"
           value="<?php echo isset($_POST['probability-per-day1']) ? $_POST['probability-per-day1'] : '' ?>" />
    2 <input type="text" size="4" maxlength="4" name="probability-per-day2" id="probability-per-day2"
           value="<?php echo isset($_POST['probability-per-day2']) ? $_POST['probability-per-day2'] : '' ?>" />
    3 <input type="text" size="4" maxlength="4" name="probability-per-day3" id="probability-per-day3"
           value="<?php echo isset($_POST['probability-per-day3']) ? $_POST['probability-per-day3'] : '' ?>" />
    4 <input type="text" size="4" maxlength="4" name="probability-per-day4" id="probability-per-day4"
           value="<?php echo isset($_POST['probability-per-day4']) ? $_POST['probability-per-day4'] : '' ?>" />
    5 <input type="text" size="4" maxlength="4" name="probability-per-day5" id="probability-per-day5"
           value="<?php echo isset($_POST['probability-per-day5']) ? $_POST['probability-per-day5'] : '' ?>" />
    6 <input type="text" size="4" maxlength="4" name="probability-per-day6" id="probability-per-day6"
           value="<?php echo isset($_POST['probability-per-day6']) ? $_POST['probability-per-day6'] : '' ?>" />
    7 <input type="text" size="4" maxlength="4" name="probability-per-day7" id="probability-per-day7"
           value="<?php echo isset($_POST['probability-per-day7']) ? $_POST['probability-per-day7'] : '' ?>" />
    8 <input type="text" size="4" maxlength="4" name="probability-per-day8" id="probability-per-day8"
           value="<?php echo isset($_POST['probability-per-day8']) ? $_POST['probability-per-day8'] : '' ?>" />
    9 <input type="text" size="4" maxlength="4" name="probability-per-day9" id="probability-per-day9"
           value="<?php echo isset($_POST['probability-per-day9']) ? $_POST['probability-per-day9'] : '' ?>" />
    10 <input type="text" size="4" maxlength="4" name="probability-per-day10" id="probability-per-day10"
           value="<?php echo isset($_POST['probability-per-day10']) ? $_POST['probability-per-day10'] : '' ?>" />
    11 <input type="text" size="4" maxlength="4" name="probability-per-day11" id="probability-per-day11"
           value="<?php echo isset($_POST['probability-per-day11']) ? $_POST['probability-per-day11'] : '' ?>" />
    12 <input type="text" size="4" maxlength="4" name="probability-per-day12" id="probability-per-day12"
           value="<?php echo isset($_POST['probability-per-day12']) ? $_POST['probability-per-day12'] : '' ?>" />
    13 <input type="text" size="4" maxlength="4" name="probability-per-day13" id="probability-per-day13"
           value="<?php echo isset($_POST['probability-per-day13']) ? $_POST['probability-per-day13'] : '' ?>" />
    14 <input type="text" size="4" maxlength="4" name="probability-per-day14" id="probability-per-day14"
           value="<?php echo isset($_POST['probability-per-day14']) ? $_POST['probability-per-day14'] : '' ?>" /><br>

    <input type="button" id="show-hide-probability-per-day-result" value="Show/Hide"/><br>

    <label id="probability-per-day-result"></label><br>

    <h3>Average odds</h3>
    Min<input type="text" size="4" maxlength="4" name="min-odd" id="min-odd"
             value="<?php echo isset($_POST['min-odd']) ? $_POST['min-odd'] : '' ?>" />
    Max<input type="text" size="4" maxlength="4" name="max-odd" id="max-odd"
             value="<?php echo isset($_POST['max-odd']) ? $_POST['max-odd'] : '' ?>" />
    Avg<input type="text" size="4" maxlength="4" name="avg-odd" id="avg-odd"
             value="<?php echo isset($_POST['avg-odd']) ? $_POST['avg-odd'] : '' ?>" /><br>

    <input type="button" id="show-hide-generated-odds-result" value="Show/Hide"/><br>

    <label id="generated-odds-result"></label>
    <br><br>

    <input type="submit" name="action" value="Generate" id="generate" />
    <br><br><br>

    <label>Choose betting type</label><br>
    <select name="betting-type">
        <option value=""></option>
        <option value="1" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 1) echo 'selected'; ?> >Singles</option>
        <option value="2" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 2) echo 'selected'; ?> >k/k</option>
        <option value="3" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 3) echo 'selected'; ?> >k-1/k</option>
        <option value="4" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 4) echo 'selected'; ?> >k-1 k/k</option>
        <option value="5" <?php if (isset($_POST['betting-type']) && $_POST['betting-type'] == 5) echo 'selected'; ?> >k-2 k-1 k/k</option>
    </select>
    <br>


<?php /* ?>
    <label>Money units per day</label><br>
    <input type="text" size="6" maxlength="6" name="money-units-per-day" id="money-units-per-day"
             value="<?php echo isset($_POST['money-units-per-day']) ? $_POST['money-units-per-day'] : '' ?>" /><br>
*/ ?>
    <h3>Budget management</h3>
    <label>Budget</label><br>
    <input type="text" size="6" maxlength="6" name="budget" id="budget"
           value="<?php echo isset($_POST['budget']) ? $_POST['budget'] : '' ?>" /><br>

    <label>Percentage used</label><br>
    <input type="text" size="6" maxlength="6" name="percentage-used" id="percentage-used"
           value="<?php echo isset($_POST['percentage-used']) ? $_POST['percentage-used'] : '' ?>" /><br>

    <label>Turning saldo velocity</label><br>
    <input type="text" size="6" maxlength="6" name="turning-saldo-velocity" id="turning-saldo-velocity"
           value="<?php echo isset($_POST['turning-saldo-velocity']) ? $_POST['turning-saldo-velocity'] : '' ?>" /><br>

    <input type="checkbox" name="dynamic-cream-strategy" value="Dynamic Cream Strategy">Dynamic Cream strategy<br>

    <label>Cream taker</label><br>
    <input type="text" size="6" maxlength="6" name="cream-taker" id="cream-taker"
           value="<?php echo isset($_POST['cream-taker']) ? $_POST['cream-taker'] : '' ?>" /><br>

    <label>Percentage for cream</label><br>
    <input type="text" size="6" maxlength="6" name="percentage-for-cream" id="percentage-for-cream"
           value="<?php echo isset($_POST['percentage-for-cream']) ? $_POST['percentage-for-cream'] : '' ?>" /><br>

    <label>Showstopper</label><br>
    <input type="text" size="6" maxlength="6" name="showstopper" id="showstopper"
           value="<?php echo isset($_POST['showstopper']) ? $_POST['showstopper'] : '' ?>" /><br>

    <label id="earned-total"></label><br>
    <br>

    <label id="game-over-amount"></label><br>
    <br>

    <label id="betting-data-result"></label><br>
    <br>

    <br><br>
    <input type="submit" name="action" value="Analyze" id="analyze" />
</form>







<?php
    require_once 'radza-million.php';
    $radzaMillion = new RadzaMilion();

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'Generate') {
            $_SESSION['array-with-probability'] = $radzaMillion->generateArrayWithProbability($_POST['games-count'], $_POST['probability']);;
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
                $bettingResults = $radzaMillion->getBettingResults($_POST['betting-type'], $_SESSION['array-with-probability'], $_SESSION['games-per-day'], $_SESSION['odds-array'], $_POST['budget'], $_POST['percentage-used'], $_POST['turning-saldo-velocity']);
                echo 'MONEY STATUS: ' . $bettingResults['money_status'];
                echo 'GLOBAL MIN: ' . $bettingResults['global_min'] . ' ITERATION: ' . $bettingResults['min_iteration_number'];
                echo 'GLOBAL MAX: ' . $bettingResults['global_max'] . ' ITERATION: ' . $bettingResults['max_iteration_number'];
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
