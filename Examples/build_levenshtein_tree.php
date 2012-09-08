<?php
require_once "../BKTree.php";
require_once "../MetricSpaces/LevenshteinDistance.php";

// Read words from file and insert them into the tree
$f = file('data/words');
$tree = new BKTree('', new LevenshteinDistance());
foreach ($f as $w) {
    $tree->insert(trim($w));
}

// Save the tree
BKTree::save($tree, 'SavedTrees/tree.levensthein');

