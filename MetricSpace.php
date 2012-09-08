<?php

/**
 * A metric space is a set where a notion of distance (called a metric) between 
 * elements of the set is defined. Distances of metric spaces have to conform
 * to the following criteria:
 * 
 *    - d(x,y) >= 0
 *    - d(x,y) = 0 <-> x = y
 *    - d(x,y) = d(y,x)
 *    - d(x,y) + d(y,z) >= d(x,z)
 *
 * Examples of such distance algorithms are Levenshtein distance (for strings) 
 * and Haversine distance (for coordinates).
 */
abstract class MetricSpace
{
    /**
     * Computes distance between $from and $to.
     */
    abstract public function compute($from, $to);
}
