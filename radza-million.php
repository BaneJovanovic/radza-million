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
     * @return array|float|int|mixed
     */
    public function getBettingResults($type, $arrayWithGameResults, $gamesPerDay, $oddsArray, $budget, $percentageUsed, $turningSaldoVelocity)
    {
        $bettingData = array();
        $result = $budget;

        if ($type < 1) {
            $this->log('Betting type not selected');
            return $result;
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
        foreach ($bettingData as $item) {
            $moneyPerDay = $budget * $percentageUsed;
            echo "TEMP MONEY STATUS: " . number_format($result, 2) . ", TEMP MONEY PER DAY: $moneyPerDay, ODDS-RESULTS PER DAY ";
            foreach ($item['game_results'] as $key => $gameResults) {
                echo $item['start_odds'][$key] . "-" . $item['game_results'][$key] . " ";
            }
            ?><br><?php

            $result -= $moneyPerDay;
            $moneyPerCombination = $moneyPerDay / $item['combinations'];

            foreach ($item['odds'] as $odd) {
                $result += $odd * $moneyPerCombination;
            }

            if ($turningSaldoVelocity) {
                while ($result < $budget && $budget != $minBudget) {
                    $budget = $budget / (1 + $turningSaldoVelocity);
                }

                while ($result >= $budget * (1 + $turningSaldoVelocity)) {
                    $budget *= (1 + $turningSaldoVelocity);
                }
            }
        }

        return $result;
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
        $combinations = $this->getCombinations($arrayKeys, $games - 1);
        foreach ($combinations as $combination) {
            $totalOdd = 1;
            foreach ($combination as $item) {
                $totalOdd *= $oddsArray[$item] * $gameResultsArray[$item];
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
        $combinations = $this->getCombinations($arrayKeys, $games - 1);
        $combinations[] = $arrayKeys;
        foreach ($combinations as $combination) {
            $totalOdd = 1;
            foreach ($combination as $item) {
                $totalOdd *= $oddsArray[$item] * $gameResultsArray[$item];
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
        $combinations = $this->getCombinations($arrayKeys, $games - 2);
        $combinations = array_merge($combinations, $this->getCombinations($arrayKeys, $games - 1));
        $combinations[] = $arrayKeys;
        foreach ($combinations as $combination) {
            $totalOdd = 1;
            foreach ($combination as $item) {
                $totalOdd *= $oddsArray[$item] * $gameResultsArray[$item];
            }
            $result[] = $totalOdd;
        }

        $bettingData['odds'] = $result;

        return $bettingData;
    }

    /**
     * @param $base
     * @param $n
     * @return array|void
     */
    public function getCombinations($base, $n)
    {
        $baseLength = count($base);
        if ($baseLength == 0) {
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

    /**
     * Simple logging, can be upgraded after
     *
     * @param $message
     */
    public function log($message)
    {
        echo $message;
    }
}