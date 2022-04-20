<?php

function autoloader() {
    require_once 'ApplesPears/Controllers/Collector.php';
    require_once 'ApplesPears/Trees/Tree.php';
    require_once 'ApplesPears/Trees/ApplesTree.php';
    require_once 'ApplesPears/Trees/PearsTree.php';
    require_once 'ApplesPears/Fruits/Fruit.php';
    require_once 'ApplesPears/Fruits/Apple.php';
    require_once 'ApplesPears/Fruits/Pear.php';
}

autoloader();