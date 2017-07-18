<?php

class RadzaMilion
{
    const DEFAULT_PRECISION = 10000;

    const ODDS_PRECISION = 100; // 2 decimal places

    const BETTING_TYPE_SINGLES      = 1;
    const BETTING_TYPE_K_K          = 2;
    const BETTING_TYPE_K_1_K        = 3;
    const BETTING_TYPE_K_1_K_K      = 4;
    const BETTING_TYPE_K_2_K_1_K_K  = 5;

    /** @var array All generated combinations */
    public $allCombinations = null;

    public $errorLog = array();

    /**
     * All results generated by clicking on 'Generate' button
     *
     * @param $postedData
     * @return array
     */
    public function generateButtonClickResult($postedData)
    {
        $generateButtonClickResult = array();

        $generateButtonClickResult['array-with-probability'] = $this->generateArrayWithProbability($postedData['games-count'], $postedData['probability']);

        $probabilityPerDayData = $this->generateInputArrayForGamesPerDay($postedData);
        $generateButtonClickResult['games-per-day'] = $this->generateGamesPerDayArray($postedData['games-count'], $probabilityPerDayData);

        $generateButtonClickResult['odds-array'] = $this->generateOddsArray($postedData['games-count'], $postedData['min-odd'], $postedData['max-odd'], $postedData['avg-odd']);

        $generateButtonClickResult['error'] = $this->errorLog;

        return $generateButtonClickResult;
    }

    /**
     * This method generate '1's with probability $probability
     *
     * @param $probability Value should be between 0-1 (from 0% to 100%)
     * @param $precision
     * @return int
     */
    public function generateNumberWithProbability($probability, $precision)
    {
        /** @var int $generated */
        $generated = mt_rand(1, $precision);

        if ($precision * $probability >= $generated) {
            return 1;
        }

        return 0;
    }

    /**
     * This method generate array of '1's with probability $probability
     *
     * @param $arraySize
     * @param $probability
     * @param int $precision
     * @return array
     */
    public function generateArrayWithProbability($arraySize, $probability, $precision = self::DEFAULT_PRECISION)
    {
        /** @var array $generatedArray */
        $generatedArray = array();

        if (!strlen($probability) || $probability < 0 || $probability > 1) {
            $this->log('Probability should be between 0 and 1!');
            return $generatedArray;
        }

        if ((int) $arraySize < 0) {
            $this->log('Games count should be positive!');
            return $generatedArray;
        }

        for ($i = 0; $i < $arraySize; $i++) {
            $generatedArray[$i] = $this->generateNumberWithProbability($probability, $precision);
        }

        return $generatedArray;
    }

    /**
     * This method generates array of odds (two decimal places) in range between $min and $max. Average of all values
     * is ~$average
     *
     * @param $arraySize
     * @param $min
     * @param $max
     * @param $average
     * @return array
     */
    public function generateOddsArray($arraySize, $min, $max, $average)
    {
        $oddsArray = array();

        if (!strlen($min) || $min < 0) {
            $this->log('Missing or incorrect min odd value!');
            return $oddsArray;
        }

        if (!strlen($max) || $max < 0) {
            $this->log('Missing or incorrect max odd value!');
            return $oddsArray;
        }

        if (!strlen($average) || $average < 0) {
            $this->log('Missing or incorrect avg odd value!');
            return $oddsArray;
        }

        if ($min > $max || $min > $average || $average > $max) {
            $this->log('Relations between odds are not correct!');
            return $oddsArray;
        }


        $min *= $this::ODDS_PRECISION;
        $max *= $this::ODDS_PRECISION;
        $average *= $this::ODDS_PRECISION;

        $sum = mt_rand($min, $max);
        $oddsArray[0] = $sum / $this::ODDS_PRECISION;

        for ($i = 1; $i < $arraySize; $i++) {
            if ($sum / $i < $average) {
                $oddsArray[$i] = mt_rand($average, $max) / $this::ODDS_PRECISION;
            } else {
                $oddsArray[$i] = mt_rand($min, $average) / $this::ODDS_PRECISION;
            }

            $sum += $oddsArray[$i] * $this::ODDS_PRECISION;
        }

        return $oddsArray;
    }

    /**
     * Get data from input and generate inputArray for  generateGamesPerDayArray method
     *
     * @param $data
     * @return array
     */
    public function generateInputArrayForGamesPerDay($data)
    {
        $valueName = 'probability-per-day';
        $probabilityPerDayData = array();
        for ($i = 1; $i <= 14; $i++) {
            if (isset($data[$valueName . $i]) && $data[$valueName . $i] > 0) {
                $probabilityPerDayData[] = array(
                    'value'         => $i,
                    'probability'   => $data[$valueName . $i]
                );
            }
        }

        return $probabilityPerDayData;
    }

    /**
     * Purpose of this method is to create array that will be used for generating games number per day with
     * some probability. $inputDataArray should have format:
     * $inputDataArray = array(
     *                      array(
     *                          'value'         => number of games per day
     *                          'probability'   => probability for that number of games
     *                      )
     *                  )
     * Generated array $probabilityArray will be used in method generateGamesPerDayArray
     *
     * @param $inputDataArray
     * @param $precision
     * @return array
     */
    public function generateArrayForGettingGamesNumberWithProbability($inputDataArray, $precision)
    {
        $probabilityArray = array();
        $counter = 0;

        foreach ($inputDataArray as $inputData) {
            for ($i = 0; $i < $inputData['probability'] * $precision; $i++) {
                $probabilityArray[$counter + $i] = $inputData['value'];
            }

            $counter += $i;
        }

        return $probabilityArray;
    }

    /**
     * Generates games per day
     *
     * @param $numberOfGames
     * @param $inputDataArray
     * @param int $precision
     * @return array
     */
    public function generateGamesPerDayArray($numberOfGames, $inputDataArray, $precision = self::DEFAULT_PRECISION)
    {
        $gamesPerDay = array();

        $totalProbability = 0;
        foreach ($inputDataArray as $item) {
            $totalProbability += $item['probability'];
        }

        if (round($totalProbability, 2) != 1.00) {
            $this->log('Total probability for all games per day should be 1!');
            return $gamesPerDay;
        }

        $probabilityArray = $this->generateArrayForGettingGamesNumberWithProbability($inputDataArray, $precision);
        $probabilityArraySize = count($probabilityArray);

        $value = mt_rand(0, $probabilityArraySize - 1);

        while ($numberOfGames >= $probabilityArray[$value]) {
            $gamesPerDay[] = $probabilityArray[$value];
            $numberOfGames -= $probabilityArray[$value];
            $value = mt_rand(0, $probabilityArraySize - 1);
        }

        return $gamesPerDay;
    }

    /**
     * Return value is array in format:
     *  array(
     *      'money_status'          => $result,
     *      'global_min'            => $globalMin,
     *      'min_iteration_number'  => $minIterationNumber,
     *      'global_max'            => $globalMax,
     *      'max_iteration_number'  => $maxIterationNumber,
     *      'table_data'            => array(
     *                                  'Iteration'
     *                                  'Marker',
     *                                  'DailyOdds',
     *                                  'TB',
     *                                  'MPD',
     *                                  'ET',
     *                                  'CT'
     *                              ),
     *      'earned_total'          => $earnedTotal,
     *      'game_over_amount',
     *      'total_days_played'
     *          );
     *
     *
     * Gets number of combinations for every betting type and total odd for every combination
     *
     * Betting types        |       Number of combinations
     *                      |
     * 1 - Singles          |       k
     * 2 - k/k              |       1
     * 3 - k-1/k            |       k
     * 4 - k-1 k/k          |       k + 1
     * 5 - k-2 k-1 k/k      |       (k + 1) * (k + 2) / 2
     *
     * @param $type
     * @param $arrayWithGameResults
     * @param $gamesPerDay
     * @param $oddsArray
     * @param $budget
     * @param $percentageUsed
     * @param $turningSaldoVelocity
     * @param $dailyAmplifier
     * @param $creamStrategyData
     * @return array
     */
    public function getBettingResults($type, $arrayWithGameResults, $gamesPerDay, $oddsArray, $budget, $percentageUsed, $turningSaldoVelocity, $dailyAmplifier, $creamStrategyData)
    {
        $bettingData = array();
        $tempBudget = $budget;

        if ($type < 1) {
            $this->log('Betting type not selected');
            return $bettingData;
        }

        $counter = 0;
        foreach ($gamesPerDay as $games) {
            switch ($type) {
                case $this::BETTING_TYPE_SINGLES:
                    $bettingData[] = $this->getBettingDataSingles($games, array_slice($arrayWithGameResults, $counter, $games), array_slice($oddsArray, $counter, $games));
                    break;

                case $this::BETTING_TYPE_K_K:
                    $bettingData[] = $this->getBettingDataKK($games, array_slice($arrayWithGameResults, $counter, $games), array_slice($oddsArray, $counter, $games));
                    break;

                case $this::BETTING_TYPE_K_1_K:
                    $bettingData[] = $this->getBettingDataK1K($games, array_slice($arrayWithGameResults, $counter, $games), array_slice($oddsArray, $counter, $games));
                    break;

                case $this::BETTING_TYPE_K_1_K_K:
                    $bettingData[] = $this->getBettingDataK1KK($games, array_slice($arrayWithGameResults, $counter, $games), array_slice($oddsArray, $counter, $games));
                    break;

                case $this::BETTING_TYPE_K_2_K_1_K_K:
                    $bettingData[] = $this->getBettingDataK2K1KK($games, array_slice($arrayWithGameResults, $counter, $games), array_slice($oddsArray, $counter, $games));
                    break;
            }

            $counter += $games;
        }

        $minBudget = $budget;
        $moneyPerDay = $budget * $percentageUsed;
        $globalMin = $budget;
        $minIterationNumber = 0;
        $globalMax = $budget;
        $maxIterationNumber = 0;

        $earnedTotal = 0;

        $tableData = array();
        foreach ($bettingData as $iterationNumber => $item) {

            if ($tempBudget > $globalMax) {
                $globalMax = $tempBudget;
                $maxIterationNumber = $iterationNumber;
            }

            if ($tempBudget < $globalMin) {
                $globalMin = $tempBudget;
                $minIterationNumber = $iterationNumber;
            }

            $tableOddsData = array();
            foreach ($item['game_results'] as $key => $gameResults) {
                $tableOddsData[] = array(
                    'class' => $item['game_results'][$key] ? 'success-text' : 'failure-text',
                    'odd'   =>  $item['start_odds'][$key]
                );
            }

            if (strlen($creamStrategyData['cream_taker'])) {
                $creamTaker = $creamStrategyData['cream_taker'];
            } else {
                $creamTaker = 0;
            }

            $tableData[] = array(
                'Iteration'     => $iterationNumber + 1,
                'Marker'        => count($item['game_results']) . " game(s)",
                'DailyOdds'     => $tableOddsData,
                'TB'            => round($tempBudget, 3),
                'MPD'           => $moneyPerDay,
                'ET'            => round($earnedTotal, 3),
                'CT'            => round($creamTaker, 3),
            );

            $tempBudget -= $moneyPerDay;
            $moneyPerCombination = $moneyPerDay / $item['combinations'];

            foreach ($item['odds'] as $odd) {
                $tempBudget += $odd * $moneyPerCombination;
            }

            $calculateMoneyPerDayFromBudget = $this->calculateMoneyPerDayFromBudget($moneyPerDay, $budget, $minBudget, $turningSaldoVelocity, $dailyAmplifier, $tempBudget);

            $budget         = $calculateMoneyPerDayFromBudget['budget'];
            $moneyPerDay    = $calculateMoneyPerDayFromBudget['money_per_day'];

            if ($creamStrategyData['dynamic_cream_strategy']) {
                $calculatedCreamStrategy = $this->calculateDynamicCreamStrategy($creamStrategyData, $tempBudget, $earnedTotal);
            } else {
                $calculatedCreamStrategy = $this->calculateStaticCreamStrategy($creamStrategyData, $tempBudget, $earnedTotal);
            }

            $earnedTotal = $calculatedCreamStrategy['earned_total'];
            $tempBudget = $calculatedCreamStrategy['temp_budget'];

            if (isset($calculatedCreamStrategy['cream_taker'])) {
                $creamStrategyData['cream_taker'] = $calculatedCreamStrategy['cream_taker'];
            }

            if (isset($calculatedCreamStrategy['stop'])) {
                break;
            }
        }

        $rval = array(
            'money_status'          => $tempBudget,
            'global_min'            => round($globalMin, 3),
            'min_iteration_number'  => $minIterationNumber,
            'global_max'            => round($globalMax, 3),
            'max_iteration_number'  => $maxIterationNumber,
            'table_data'            => $tableData,
            'earned_total'          => round($earnedTotal, 3),
            'game_over_amount'      => round($tempBudget + $earnedTotal, 3),
            'total_days_played'     => $iterationNumber + 1
        );
        return $rval;
    }

    /**
     * Method do Static cream strategy calculations and return array in format
     * array(
     *      earned_total,   - value of earned total
     *      temp_budget,
     *      stop            - this field is set to 1 if we reach showstopper value
     * )
     *
     * @param $creamStrategyData
     * @param $tempBudget
     * @param $earnedTotal
     * @return array
     */
    public function calculateStaticCreamStrategy($creamStrategyData, $tempBudget, $earnedTotal)
    {
        $rval = array();

        if (strlen($creamStrategyData['cream_taker']) && is_numeric($creamStrategyData['cream_taker'])
            && strlen($creamStrategyData['percentage_for_cream']) && is_numeric($creamStrategyData['percentage_for_cream'])) {

            if ($tempBudget >= $creamStrategyData['cream_taker']) {
                $diff = $creamStrategyData['cream_taker'] * $creamStrategyData['percentage_for_cream'];
                $earnedTotal += $diff;
                $tempBudget -= $diff;
            }
        }

        if (strlen($creamStrategyData['showstopper']) && is_numeric($creamStrategyData['showstopper'])) {
            if ($earnedTotal + $tempBudget >= $creamStrategyData['showstopper']) {
                $rval['stop'] = 1;
            }
        }

        $rval['earned_total'] = $earnedTotal;
        $rval['temp_budget'] = $tempBudget;

        return $rval;
    }

    /**
     * (ct - cream taker;  tb - temp budget; poc - “percentage for cream” ; et = “earned total”, cc - “change criteria”)
     * if  tb > ct then et += ct*poc && tb-=ct*poc && ct=ct*cc
     * NOTE: ct can only become bigger value, it is not reducing if tb lowers down
     *
     * array(
     *      earned_total,   - value of earned total
     *      temp_budget,
     *      cream_taker
     *      stop            - this field is set to 1 if we reach showstopper value
     * )
     * @param $creamStrategyData
     * @param $tempBudget
     * @param $earnedTotal
     * @return array
     */
    public function calculateDynamicCreamStrategy($creamStrategyData, $tempBudget, $earnedTotal)
    {
        $rval = array();

        if (strlen($creamStrategyData['cream_taker']) && is_numeric($creamStrategyData['cream_taker'])
            && strlen($creamStrategyData['percentage_for_cream']) && is_numeric($creamStrategyData['percentage_for_cream'])
            && strlen($creamStrategyData['change_criteria']) && is_numeric($creamStrategyData['change_criteria'])) {

            if ($tempBudget >= $creamStrategyData['cream_taker']) {
                $diff = $creamStrategyData['cream_taker'] * $creamStrategyData['percentage_for_cream'];
                $earnedTotal += $diff;
                $tempBudget -= $diff;
                $rval['cream_taker'] = $creamStrategyData['cream_taker'] * $creamStrategyData['change_criteria'];
            }
        }

        if (strlen($creamStrategyData['showstopper']) && is_numeric($creamStrategyData['showstopper'])) {
            if ($earnedTotal + $tempBudget >= $creamStrategyData['showstopper']) {
                $rval['stop'] = 1;
            }
        }

        $rval['earned_total'] = $earnedTotal;
        $rval['temp_budget'] = $tempBudget;

        return $rval;
    }

    /**
     * This method calculate money per day from budget and turning saldo velocity. Return value is array in format
     *      array(
     *          'budget' => $budget,
     *          'money_per_day' => $moneyPerDay
     *      );
     *
     * @param $moneyPerDay
     * @param $budget
     * @param $minBudget
     * @param $turningSaldoVelocity
     * @param $dailyAmplifier
     * @param $newBudget
     * @return array
     */
    public function calculateMoneyPerDayFromBudget($moneyPerDay, $budget, $minBudget, $turningSaldoVelocity, $dailyAmplifier, $newBudget)
    {
        if ($turningSaldoVelocity >= 1) {
            while ($newBudget < $budget && $budget != $minBudget) {
                $budget = $budget / $turningSaldoVelocity;
                $moneyPerDay /= $dailyAmplifier;
            }

            while ($newBudget >= $budget * $turningSaldoVelocity) {
                $budget *= $turningSaldoVelocity;
                $moneyPerDay *= $dailyAmplifier;
            }
        }

        $rval = array(
            'budget' => $budget,
            'money_per_day' => $moneyPerDay
        );

        return $rval;
    }


    /**
     * @param $games
     * @param $gameResultsArray
     * @param $oddsArray
     * @return mixed
     */
    public function getBettingDataSingles($games, $gameResultsArray, $oddsArray)
    {
        $bettingData['game_results'] = $gameResultsArray;
        $bettingData['start_odds'] = $oddsArray;
        $bettingData['combinations'] = $games;

        $result = array();
        foreach ($oddsArray as $key => $item) {
            $result[] = $oddsArray[$key] * $gameResultsArray[$key];
        }

        $bettingData['odds'] = $result;

        return $bettingData;
    }

    /**
     * @param $games
     * @param $gameResultsArray
     * @param $oddsArray
     * @return mixed
     */
    public function getBettingDataKK($games, $gameResultsArray, $oddsArray)
    {
        $bettingData['game_results'] = $gameResultsArray;
        $bettingData['start_odds'] = $oddsArray;
        $bettingData['combinations'] = 1;

        $result = array();
        $totalOdd = 1;
        foreach ($oddsArray as $key => $item) {
            $totalOdd *= $oddsArray[$key] * $gameResultsArray[$key];
            if ($totalOdd == 0) {
                break;
            }
        }

        $result[] = $totalOdd;

        $bettingData['odds'] = $result;

        return $bettingData;
    }

    /**
     * @param $games
     * @param $gameResultsArray
     * @param $oddsArray
     * @return mixed
     */
    public function getBettingDataK1K($games, $gameResultsArray, $oddsArray)
    {
        $bettingData['game_results'] = $gameResultsArray;
        $bettingData['start_odds'] = $oddsArray;
        $bettingData['combinations'] = $games;

        $result = array();

        $arrayKeys = array_keys($gameResultsArray);

        $allCombinations = $this->generateAllCombinations();
        $combinations = $allCombinations[count($arrayKeys)]['n-1'];
        foreach ($combinations as $combination) {
            $totalOdd = 1;
            foreach ($combination as $item) {
                $totalOdd *= $oddsArray[$item] * $gameResultsArray[$item];
                if ($totalOdd == 0) {
                    break;
                }
            }
            $result[] = $totalOdd;
        }

        $bettingData['odds'] = $result;

        return $bettingData;
    }

    /**
     * @param $games
     * @param $gameResultsArray
     * @param $oddsArray
     * @return mixed
     */
    public function getBettingDataK1KK($games, $gameResultsArray, $oddsArray)
    {
        $bettingData['game_results'] = $gameResultsArray;
        $bettingData['start_odds'] = $oddsArray;
        $bettingData['combinations'] = $games + 1;

        $result = array();

        $arrayKeys = array_keys($gameResultsArray);

        $allCombinations = $this->generateAllCombinations();
        $combinations = $allCombinations[count($arrayKeys)]['n-1'];
        $combinations[] = $arrayKeys;
        foreach ($combinations as $combination) {
            $totalOdd = 1;
            foreach ($combination as $item) {
                $totalOdd *= $oddsArray[$item] * $gameResultsArray[$item];
                if ($totalOdd == 0) {
                    break;
                }
            }
            $result[] = $totalOdd;
        }

        $bettingData['odds'] = $result;

        return $bettingData;
    }

    /**
     * @param $games
     * @param $gameResultsArray
     * @param $oddsArray
     * @return mixed
     */
    public function getBettingDataK2K1KK($games, $gameResultsArray, $oddsArray)
    {
        $bettingData['game_results'] = $gameResultsArray;
        $bettingData['start_odds'] = $oddsArray;
        $bettingData['combinations'] = $games + 1 + ($games - 1) * $games / 2;

        $result = array();

        $arrayKeys = array_keys($gameResultsArray);

        $allCombinations = $this->generateAllCombinations();
        $combinations = $allCombinations[count($arrayKeys)]['n-2'];
        $combinations = array_merge($combinations, $allCombinations[count($arrayKeys)]['n-1']);
        $combinations[] = $arrayKeys;
        foreach ($combinations as $combination) {
            $totalOdd = 1;
            foreach ($combination as $item) {
                $totalOdd *= $oddsArray[$item] * $gameResultsArray[$item];
                if ($totalOdd == 0) {
                    break;
                }
            }
            $result[] = $totalOdd;
        }

        $bettingData['odds'] = $result;

        return $bettingData;
    }

    /**
     * Calculate probability of breakpoints
     *
     * @param $analyzeResults
     * @param $postedData
     * @return mixed
     */
    public function calculateConditionProbability($analyzeResults, $postedData)
    {
        $result = array();

        foreach ($postedData['desired-goal'] as $key => $goal) {
            $successful = 0;
            foreach ($analyzeResults['analyze-data'] as $itemKey => $item) {
                if ($item['global_min'] >= $postedData['min-allowed']) {
                    $analyzeResults['analyze-data'][$itemKey]['radza-probability'] = 1;
                    if (strlen($postedData['desired-day'][$key]) && $postedData['desired-day'][$key] < $item['total_days_played']) {
                        $desiredDay = $postedData['desired-day'][$key];
                    } else {
                        $desiredDay = $item['total_days_played'];
                    }

                    if ($item['table_data'][$desiredDay-1]['TB'] + $item['table_data'][$desiredDay-1]['ET'] >= $goal) {
                        $successful++;
                    }
                } else {
                    $analyzeResults['analyze-data'][$itemKey]['radza-probability'] = 0;
                }
            }

            $result[$key] = $successful / count($analyzeResults['analyze-data']);
        }

        $analyzeResults['condition-probability'] = $result;

        return $analyzeResults;
    }

    /**
     * Get all generated combinations
     *
     * @return array
     */
    public function generateAllCombinations()
    {
        if (!is_null($this->allCombinations)) {
            return $this->allCombinations;
        }

        $combinations = array();
        $data = array();

        $data[] = 0;
        $data[] = 1;
        $combinations[2]['n-1'] = $this->getCombinations($data, 1);
        for ($i = 2; $i <= 13; $i++) {
            $data[] = $i;
            $combinations[$i + 1]['n-1'] = $this->getCombinations($data, $i);
            $combinations[$i + 1]['n-2'] = $this->getCombinations($data, $i - 1);
        }

        $this->allCombinations = $combinations;

        return $this->allCombinations;
    }

    /**
     * @param $base
     * @param $n
     * @return array|void
     */
    public function getCombinations($base, $n)
    {
        $baseLength = count($base);
        if ($baseLength == 0 || $n <= 0) {
            return;
        }

        if ($n == 1) {
            $return = array();
            foreach ($base as $b) {
                $return[] = array($b);
            }

            return $return;
        } else {
            //get one level lower combinations
            $oneLevelLower = $this->getCombinations($base, $n-1);

            //for every one level lower combinations add one element to them that the last element of a combination is preceded by the element which follows it in base array if there is none, does not add
            $newCombs = array();

            foreach ($oneLevelLower as $oll) {

                $lastEl = $oll[$n-2];
                $found = false;
                foreach ($base as $key => $b) {
                    if ($b == $lastEl) {
                        $found = true;
                        continue;
                        //last element found
                    }
                    if ($found == true) {
                        //add to combinations with last element
                        if ($key < $baseLength) {
                            $tmp = $oll;
                            $newCombination = array_slice($tmp,0);
                            $newCombination[] = $b;
                            $newCombs[] = array_slice($newCombination,0);
                        }
                    }
                }
            }
        }

        return $newCombs;
    }

    public function analyzeButtonClickResult($postedData)
    {
        /** @var array $analyzeButtonClickResult */
        $analyzeButtonClickResult = array();

        if (strlen($postedData['number-of-tests']) && $postedData['number-of-tests'] > 1) {
            $analyzeButtonClickResult = $this->analyzeButtonClickResultMultiple($postedData);

            $analyzeButtonClickResult = $this->calculateConditionProbability($analyzeButtonClickResult, $postedData);
        } else {
            $analyzeButtonClickResult['analyze-data'][] = $this->analyzeButtonClickResultSingle($postedData);
        }

        $this->addDataToDatabase($postedData, $analyzeButtonClickResult);

        return $analyzeButtonClickResult;
    }

    public function analyzeButtonClickResultMultiple($postedData)
    {
        /** @var array $analyzeData */
        $analyzeData = array();

        $avgMin = 0;
        $avgMax = 0;
        $avgET = 0;
        $avgGOA = 0;

        for ($i = 1; $i <= $postedData['number-of-tests']; $i++) {
            $generatedData = $this->generateButtonClickResult($postedData);

            $postedData['analyze-probability-result'] = implode(", ", $generatedData['array-with-probability']);
            $postedData['analyze-probability-per-day-result'] = implode(", ", $generatedData['games-per-day']);
            $postedData['analyze-generated-odds-result'] = implode(", ", $generatedData['odds-array']);

            $singleTestResult = $this->analyzeButtonClickResultSingle($postedData);
            $singleTestResult['error'] = array_merge($generatedData['error'], $singleTestResult['error']);

            $analyzeData[] = $singleTestResult;

            if ($i == 1) {
                $minMin = $singleTestResult['global_min'];
                $maxMin = $singleTestResult['global_min'];

                $minMax = $singleTestResult['global_max'];
                $maxMax = $singleTestResult['global_max'];

                $minET = $singleTestResult['earned_total'];
                $maxET = $singleTestResult['earned_total'];

                $minGOA = $singleTestResult['game_over_amount'];
                $maxGOA = $singleTestResult['game_over_amount'];
            }

            $avgMin += $singleTestResult['global_min'];
            $avgMax += $singleTestResult['global_max'];
            $avgET += $singleTestResult['earned_total'];
            $avgGOA += $singleTestResult['game_over_amount'];

            if ($minMin > $singleTestResult['global_min']) {
                $minMin = $singleTestResult['global_min'];
            }
            if ($maxMin < $singleTestResult['global_min']) {
                $maxMin = $singleTestResult['global_min'];
            }

            if ($minMax > $singleTestResult['global_max']) {
                $minMax = $singleTestResult['global_max'];
            }
            if ($maxMax < $singleTestResult['global_max']) {
                $maxMax = $singleTestResult['global_max'];
            }

            if ($minET > $singleTestResult['earned_total']) {
                $minET = $singleTestResult['earned_total'];
            }
            if ($maxET < $singleTestResult['earned_total']) {
                $maxET = $singleTestResult['earned_total'];
            }

            if ($minGOA > $singleTestResult['game_over_amount']) {
                $minGOA = $singleTestResult['game_over_amount'];
            }
            if ($maxGOA < $singleTestResult['game_over_amount']) {
                $maxGOA = $singleTestResult['game_over_amount'];
            }
        }

        $analyzeButtonClickResultMultiple['min_min'] = $minMin;
        $analyzeButtonClickResultMultiple['max_min'] = $maxMin;
        $analyzeButtonClickResultMultiple['avg_min'] = round($avgMin / $postedData['number-of-tests'], 3);

        $analyzeButtonClickResultMultiple['min_max'] = $minMax;
        $analyzeButtonClickResultMultiple['max_max'] = $maxMax;
        $analyzeButtonClickResultMultiple['avg_max'] = round($avgMax / $postedData['number-of-tests'], 3);

        $analyzeButtonClickResultMultiple['min_et'] = $minET;
        $analyzeButtonClickResultMultiple['max_et'] = $maxET;
        $analyzeButtonClickResultMultiple['avg_et'] = round($avgET / $postedData['number-of-tests'], 3);

        $analyzeButtonClickResultMultiple['min_goa'] = $minGOA;
        $analyzeButtonClickResultMultiple['max_goa'] = $maxGOA;
        $analyzeButtonClickResultMultiple['avg_goa'] = round($avgGOA / $postedData['number-of-tests'], 3);

        $analyzeButtonClickResultMultiple['analyze-data'] = $analyzeData;

        return $analyzeButtonClickResultMultiple;
    }

    /**
     * All results generated by clicking on 'Analyze' button
     *
     * @param $postedData
     * @return array
     */
    public function analyzeButtonClickResultSingle($postedData)
    {
        $creamStrategyData = array(
            'dynamic_cream_strategy' => isset($postedData['dynamic-cream-strategy']) ? 1 : 0,
            'cream_taker'            => isset($postedData['cream-taker']) ? $postedData['cream-taker'] : 0,
            'percentage_for_cream'   => isset($postedData['percentage-for-cream']) ? $postedData['percentage-for-cream'] : 0,
            'showstopper'            => isset($postedData['showstopper']) ? $postedData['showstopper'] : 0,
            'change_criteria'        => isset($postedData['change-criteria']) ? $postedData['change-criteria'] : 0
        );

        $analyzeButtonClickResult = $this->getBettingResults(
            $postedData['betting-type'],
            explode(', ', $postedData['analyze-probability-result']),
            explode(', ', $postedData['analyze-probability-per-day-result']),
            explode(', ', $postedData['analyze-generated-odds-result']),
            (float) $postedData['budget'],
            (float) $postedData['percentage-used'],
            (float) $postedData['turning-saldo-velocity'],
            (float) $postedData['daily-amplifier'],
            $creamStrategyData
        );

        $analyzeButtonClickResult['error'] = $this->errorLog;

        return $analyzeButtonClickResult;
    }

    /**
     * Simple logging, can be upgraded after
     *
     * @param $message
     */
    public function log($message)
    {
        $this->errorLog[] = $message;
    }

    public function addDataToDatabase($postedData, $analyzeButtonClickResult)
    {
        $servername = "localhost";
        $username = "radzkspg_radzkspg";
        $password = "CVPrdCd4woQuX";

        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $selected = mysqli_select_db($conn,"radzkspg_radza_million")
        or die("Could not select examples");

        $minOdd = $postedData['min-odd'];
        $maxOdd = $postedData['max-odd'];
        $bettingType = $postedData['betting-type'];
        $ba = $postedData['turning-saldo-velocity'];
        $dpa = $postedData['percentage-used'];
        $da = $postedData['daily-amplifier'];

        foreach ($analyzeButtonClickResult['analyze-data'] as $row) {
            $probability = $row['radza-probability'];
            $goa = $row['game_over_amount'];

            $sql = "INSERT INTO analyze_results (min_odd, max_odd, betting_type, ba, dpa, da, probability, goa)
                VALUES ($minOdd, $maxOdd, $bettingType, $ba, $dpa, $da, $probability, $goa)";

            $conn->query($sql);
        }

    }
}