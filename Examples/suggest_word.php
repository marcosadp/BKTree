<?php
require_once "../BKTree.php";
require_once "../MetricSpaces/LevenshteinDistance.php";

// Incorrect word for which we would like to get suggestions
$word = "inkorrect";

// Load tree
$dictionary = BKTree::load('SavedTrees/tree.levensthein');

// If word isn't in the dictionary, look for suggestions.
if (!$dictionary->find($word, 0)) {
    $suggestions = $dictionary->find($word, 2);
    
    if (count($suggestions)) {
        echo "Did you mean: ", implode(', ', $suggestions), "\n";
    } else {
        echo "Unable to find any suggestions for ", $word, "\n";
    }
} else {
    echo $word, " is a valid word.\n";
}
