<?php
    class RankingTable {
        private $players = array(); // tablica graczy
        private $results = array(); // tablica wyników
    
        public function __construct($players) {
            $this->players = $players;
            foreach ($players as $player) {
                $this->results[$player] = 0;
            }
        }
    
        public function recordResult($player, $score) {
            $this->results[$player] = $score;
        }
    
        public function playerRank($rank) {
            $sortedResults = $this->results;
            arsort($sortedResults); // sortowanie wyników malejąco
    
            $sortedPlayers = array();
            foreach ($sortedResults as $player => $score) {
                $sortedPlayers[] = $player;
            }
    
            // wyznaczanie rankingu gracza o podanym rankingu
            $currentRank = 1;
            foreach ($sortedPlayers as $player) {
                if ($currentRank == $rank) {
                    return $player;
                }
    
                $currentScore = $this->results[$player];
                $previousScore = ($currentRank > 1) ? $this->results[$sortedPlayers[$currentRank-2]] : null;
    
                // porównywanie wyników i liczby gier
                if ($currentScore == $previousScore) {
                    $currentGamesPlayed = array_search($player, $this->players);
                    $previousGamesPlayed = ($currentRank > 1) ? array_search($sortedPlayers[$currentRank-2], $this->players) : null;
    
                    if ($currentGamesPlayed < $previousGamesPlayed || $previousGamesPlayed === null) {
                        return $player;
                    }
                }
    
                $currentRank++;
            }
    
            return null; // nie znaleziono gracza o podanym rankingu
        }
    }
    
    // Przykład użycia

    $table = new RankingTable(array('Jan', 'Maks', 'Monika'));
    $table->recordResult('Jan', 2);
    $table->recordResult('Maks', 3);
    $table->recordResult('Monika', 5);
    echo $table->playerRank(1); // powinno zwrócić "Monika"


    