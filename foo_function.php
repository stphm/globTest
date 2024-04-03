<?php

function foo($intervals) {
     // Sort intervals by start values
    array_multisort(array_column($intervals, 0), $intervals);

    $merged = [];
    $count = count($intervals);
    $current = $intervals[0];
    for ($i = 1; $i < $count; $i++) {
        $next = $intervals[$i];
         // If the end of the current interval >= the start of the next interval
        if ($current[1] >= $next[0]) {
            // Merge the intervals
            $current[1] = max($current[1], $next[1]);
        } else {
            // Add the last interval to the merged intervals
            $merged[] = $current;
            $current = $next;
        }
    }
    $merged[] = $current;
    return $merged;
}

// Jeu de test
$testInput = [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];
$result = foo($testInput);

foreach ($result as $interval) {
   echo "[" . $interval[0] . ", " . $interval[1] . "] ";
}