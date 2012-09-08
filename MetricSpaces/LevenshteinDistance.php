<?php

require_once "../MetricSpace.php";

/**
 * The Levenshtein distance is the minimum number of changes in spelling 
 * required to change one word into another.
 */
final class LevenshteinDistance extends MetricSpace
{
    /**
     * Computes Levenshtein distance between $from and $to.
     */
    public function compute($from, $to)
    {
        return levenshtein($from, $to);
    }
}
