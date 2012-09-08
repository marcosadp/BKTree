<?php

require_once "MetricSpace.php";

/**
 * BKTree is a metric tree specially adapted for discrete metric spaces.
 * This kind of tree is arranged in such a way that makes finding closely 
 * related items really efficient. To build the tree, the structure depends on 
 * an algorithm that  measures the distances between two items. The algorithm 
 * has to conform to basic criteria of a metric space:
 *
 *    - d(x,y) >= 0
 *    - d(x,y) = 0 <-> x = y
 *    - d(x,y) = d(y,x)
 *    - d(x,y) + d(y,z) >= d(x,z)
 *
 * Examples of such distance algorithms are Levenshtein distance (for strings) 
 * and Haversine distance (for coordinates).
 */
class BKTree
{
    private $data     = NULL;
    public  $edges    = array();
    private $distance = NULL;
    
    /**
     * Constructs BKTree with data property set to $data.
     */
    public function __construct($data, MetricSpace $distance)
    {
        $this->data = $data;
        $this->distance = $distance;
    }
    
    /**
     * Inserts $data into BKTree.
     */
    public function insert($data)
    {
        $distance = $this->distance->compute($this->data, $data);
        
        if (!isset($this->edges[$distance])) {
            $this->edges[$distance] = new BKTree($data, $this->distance);
        } else {
            $this->edges[$distance]->insert($data);
        }
    }
    
    /**
     * Find entries where the distance to $data is less or equal to $max_dist.
     */
    public function find($data, $max_dist=1)
    {
        $distance = $this->distance->compute($this->data, $data);
        
        $matches = array();
        
        if ($distance >= 0 && $distance <= $max_dist) $matches[] = $this->data;
        
        for ($i = $distance-$max_dist; $i <= $distance+$max_dist; $i++) {
            if (isset($this->edges[$i])) {
                $foundMatches = $this->edges[$i]->find($data, $max_dist);
                $matches = array_merge($matches, $foundMatches);
            }
        }
        
        return $matches;
    }
    
    /**
     * Loads BKTree from $file.
     * Note: assumes the file given by $file contains a valid serialization
     *       of a BKTree.
     */
    static public function load($file)
    {
        $tree = null;
        if (file_exists($file)) {
          $tree = unserialize(file_get_contents($file));
        }
        return $tree;
    }
    
    /**
     * Saves to file the serialization of the BKTree.
     * Note: assumes $file is writable.
     */
    static public function save(BKTree $tree, $file)
    {
        file_put_contents($file, serialize($tree));
    }
    
}
