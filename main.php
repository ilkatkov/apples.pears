<?php

abstract class Fruit
{
    public function __construct()
    {
        $this->weight = rand($this->min_weight, $this->max_weight);
    }
}

class Apple extends Fruit
{
    protected $min_weight = 150;
    protected $max_weight = 180;
}

class Pear extends Fruit
{
    protected $min_weight = 130;
    protected $max_weight = 170;
}
