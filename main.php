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

abstract class Tree
{
    public function __construct()
    {
        $this->id = uniqid();
        $this->fruits = array();

        $fruits_count = rand($this->min_friuts, $this->max_fruits);
        for ($i = 0; $i < $fruits_count; $i++) {
            $this->fruits[] = new $this->fruit;
        }
    }

    public function getFruits()
    {
        return $this->fruits;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFruitsCount()
    {
        return count($this->getFruits());
    }
}

class ApplesTree extends Tree
{
    protected $min_fruits = 40;
    protected $max_fruits = 50;
    protected $fruit = Apple::class;
}

class PearsTree extends Tree
{
    protected $min_fruits = 0;
    protected $max_fruits = 20;
    protected $fruit = Pear::class;
}
