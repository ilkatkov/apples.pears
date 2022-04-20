<?php

include_once "core/autoloader.php";

use ApplesPears\Controllers\Collector;
use ApplesPears\Trees\ApplesTree;
use ApplesPears\Trees\PearsTree;

$trees = array();

// загрузка яблонь и груш
for ($i = 0; $i < 10; $i++) {
    $trees[] = new ApplesTree();
}
for ($i = 0; $i < 15; $i++) {
    $trees[] = new PearsTree();
}

$collector = new Collector();
$collector->loadTrees($trees);
$fruits = $collector->collectAllFruits();

foreach ($fruits as $fruit) {
    echo "Фрукт: " . $fruit["name"] . PHP_EOL;
    echo "Количество: " . $fruit["count"] . PHP_EOL;
    echo "Вес: " . $fruit["weight"] . PHP_EOL;
    echo "---------------" . PHP_EOL;
}
