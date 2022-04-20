<?php

namespace ApplesPears\Trees;

use ApplesPears\Fruits\Apple;

/**
 * Класс для создания дереьев яблок.
 */
class ApplesTree extends Tree
{
    protected $min_fruits = 40;
    protected $max_fruits = 50;
    protected $fruit_name = "Яблоко";
    protected $fruit = Apple::class;
}