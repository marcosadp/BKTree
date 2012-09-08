<?php
require_once "../BKTree.php";
require_once "../MetricSpaces/HaversineDistance.php";

// Load tree
$root = BKTree::load('SavedTrees/tree.cities');

// Find all cities near Los Angeles
$lookfor = array('Los Angeles', 34.0522342, -118.2436849);
$nearby_cities = $root->find($lookfor, 10);

// Display nearby cities found
if (count($nearby_cities) == 0) {
    echo "No cities found near ", $lookfor[0], "\n";
} else {
    echo "Found ", count($nearby_cities), " cities near ", $lookfor[0], ":\n";
    foreach ($nearby_cities as $city)
    {
        echo $city[0], "\n";
    }
}
