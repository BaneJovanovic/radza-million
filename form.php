<?php
session_start();
?>
<form action="" method="post" id="main-form">

    <label>Add probability of 1s. Value should be between 0 and 1</label><br>
    <input type="text" size="4" maxlength="4" name="probability" id="probability"
           value="<?php echo isset($_POST['probability']) ? $_POST['probability'] : '' ?>" /><br>
    <label for="games-count">Add total games count</label><br>
    <input type="text" size="10" maxlength="10" name="games-count" id="games-count"
           value="<?php echo isset($_POST['games-count']) ? $_POST['games-count'] : '' ?>" /><br>
    <label id="probability-result"></label><br>
    <br>

    <label>Add probability for games per day</label><br>
    1 <input type="text" size="4" maxlength="4" name="probability-per-day1" id="probability-per-day1"
           value="<?php echo isset($_POST['probability-per-day1']) ? $_POST['probability-per-day1'] : '' ?>" /><br>
    2 <input type="text" size="4" maxlength="4" name="probability-per-day2" id="probability-per-day2"
           value="<?php echo isset($_POST['probability-per-day2']) ? $_POST['probability-per-day2'] : '' ?>" /><br>
    3 <input type="text" size="4" maxlength="4" name="probability-per-day3" id="probability-per-day3"
           value="<?php echo isset($_POST['probability-per-day3']) ? $_POST['probability-per-day3'] : '' ?>" /><br>
    4 <input type="text" size="4" maxlength="4" name="probability-per-day4" id="probability-per-day4"
           value="<?php echo isset($_POST['probability-per-day4']) ? $_POST['probability-per-day4'] : '' ?>" /><br>
    5 <input type="text" size="4" maxlength="4" name="probability-per-day5" id="probability-per-day5"
           value="<?php echo isset($_POST['probability-per-day5']) ? $_POST['probability-per-day5'] : '' ?>" /><br>
    6 <input type="text" size="4" maxlength="4" name="probability-per-day6" id="probability-per-day6"
           value="<?php echo isset($_POST['probability-per-day6']) ? $_POST['probability-per-day6'] : '' ?>" /><br>
    7 <input type="text" size="4" maxlength="4" name="probability-per-day7" id="probability-per-day7"
           value="<?php echo isset($_POST['probability-per-day7']) ? $_POST['probability-per-day7'] : '' ?>" /><br>
    8 <input type="text" size="4" maxlength="4" name="probability-per-day8" id="probability-per-day8"
           value="<?php echo isset($_POST['probability-per-day8']) ? $_POST['probability-per-day8'] : '' ?>" /><br>
    9 <input type="text" size="4" maxlength="4" name="probability-per-day9" id="probability-per-day9"
           value="<?php echo isset($_POST['probability-per-day9']) ? $_POST['probability-per-day9'] : '' ?>" /><br>
    10 <input type="text" size="4" maxlength="4" name="probability-per-day10" id="probability-per-day10"
           value="<?php echo isset($_POST['probability-per-day10']) ? $_POST['probability-per-day10'] : '' ?>" /><br>
    11 <input type="text" size="4" maxlength="4" name="probability-per-day11" id="probability-per-day11"
           value="<?php echo isset($_POST['probability-per-day11']) ? $_POST['probability-per-day11'] : '' ?>" /><br>
    12 <input type="text" size="4" maxlength="4" name="probability-per-day12" id="probability-per-day12"
           value="<?php echo isset($_POST['probability-per-day12']) ? $_POST['probability-per-day12'] : '' ?>" /><br>
    13 <input type="text" size="4" maxlength="4" name="probability-per-day13" id="probability-per-day13"
           value="<?php echo isset($_POST['probability-per-day13']) ? $_POST['probability-per-day13'] : '' ?>" /><br>
    14 <input type="text" size="4" maxlength="4" name="probability-per-day14" id="probability-per-day14"
           value="<?php echo isset($_POST['probability-per-day14']) ? $_POST['probability-per-day14'] : '' ?>" /><br>
    <label id="probability-per-day-result"></label><br>
    <br>

    <label>Add values for min, max, average odd</label><br>
    <input type="text" size="4" maxlength="4" name="min-odd" id="min-odd"
             value="<?php echo isset($_POST['min-odd']) ? $_POST['min-odd'] : '' ?>" /><br>
    <input type="text" size="4" maxlength="4" name="max-odd" id="max-odd"
             value="<?php echo isset($_POST['max-odd']) ? $_POST['max-odd'] : '' ?>" /><br>
    <input type="text" size="4" maxlength="4" name="avg-odd" id="avg-odd"
             value="<?php echo isset($_POST['avg-odd']) ? $_POST['avg-odd'] : '' ?>" /><br>
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

    <label>Budget</label><br>
    <input type="text" size="6" maxlength="6" name="budget" id="budget"
           value="<?php echo isset($_POST['budget']) ? $_POST['budget'] : '' ?>" /><br>

    <label>Percentage used</label><br>
    <input type="text" size="6" maxlength="6" name="percentage-used" id="percentage-used"
           value="<?php echo isset($_POST['percentage-used']) ? $_POST['percentage-used'] : '' ?>" /><br>

    <label>Turning saldo velocity</label><br>
    <input type="text" size="6" maxlength="6" name="turning-saldo-velocity" id="turning-saldo-velocity"
           value="<?php echo isset($_POST['turning-saldo-velocity']) ? $_POST['turning-saldo-velocity'] : '' ?>" /><br>


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

            if (!$dataMissing) {
                $bettingData = $radzaMillion->getBettingResults($_POST['betting-type'], $_SESSION['array-with-probability'], $_SESSION['games-per-day'], $_SESSION['odds-array'], $_POST['budget'], $_POST['percentage-used'], $_POST['turning-saldo-velocity']);
                echo 'MONEY STATUS: ' . $bettingData;
            }
        }
    }

