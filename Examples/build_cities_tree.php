<?php
require_once "../BKTree.php";
require_once "../MetricSpaces/HaversineDistance.php";

// Create tree with some random origin point.
$origin = array('',0,0);
$tree = new BKTree($origin, new HaversineDistance());

// Read cities from file and insert them into the tree
$handle = fopen('data/lotsofcities.csv','r');
while ($city = fgetcsv($handle)) {
    $tree->insert($city);
}

// Save tree
BKTree::save($tree, 'SavedTrees/tree.cities');
