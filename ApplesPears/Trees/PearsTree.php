<?php

namespace ApplesPears\Trees;

use ApplesPears\Fruits\Pear;

/**
 * Класс для создания дереьев груш.
 */
class PearsTree extends Tree
{
    protected $min_fruits = 0;
    protected $max_fruits = 20;
    protected $fruit_name = "Груша";
    protected $fruit = Pear::class;
}
