<?php

class Controller
{
    public function __construct()
    {
        $this->trees = array();
    }

    public function collectAllFruits()
    {
        $result = array();
        foreach ($this->trees as $tree) {
            $collect = $tree->collectFruits();
            if (!array_key_exists($collect["fruit"], $result)) {
                $result[$collect["fruit"]] = array("name" => $collect["fruit"], "count" => 0, "weight" => 0);
            } else {
                $result[$collect["fruit"]]["count"] += $collect["count"];
                $result[$collect["fruit"]]["weight"] += $collect["weight"];
            }
        }
        return $result;
    }

    public function loadTrees($trees)
    {
        foreach ($trees as $tree) {
            $this->addTree($tree);
        }
    }

    private function addTree($tree)
    {
        $this->trees[] = $tree;
    }
}

abstract class Fruit
{
    public function __construct()
    {
        $this->weight = rand($this->min_weight, $this->max_weight);
    }

    public function getWeight()
    {
        return $this->weight;
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
        $this->setFruits();
    }

    public function getId()
    {
        return $this->id;
    }

    private function setFruits()
    {
        $fruits_count = rand($this->min_fruits, $this->max_fruits);
        for ($i = 0; $i < $fruits_count; $i++) {
            $this->fruits[] = new $this->fruit;
        }
    }

    private function getFruitName()
    {
        return $this->fruit_name;
    }

    private function getFruits()
    {
        return $this->fruits;
    }

    private function getFruitsCount()
    {
        return count($this->getFruits());
    }

    private function getFruitsWeight()
    {
        $total_weight = 0;
        foreach ($this->fruits as $fruit) {
            $total_weight += $fruit->getWeight();
        }
        return $total_weight;
    }

    public function collectFruits()
    {
        $fruit_name = $this->getFruitName();
        $fruits_count = $this->getFruitsCount();
        $fruits_weight = $this->getFruitsWeight();
        $this->fruits = array(); // собрали фрукты (обнулили количество фруктов на дереве)
        return array(
            "fruit" => $fruit_name,
            "count" => $fruits_count,
            "weight" => $fruits_weight
        );
    }
}

class ApplesTree extends Tree
{
    protected $min_fruits = 40;
    protected $max_fruits = 50;
    protected $fruit_name = "Яблоко";
    protected $fruit = Apple::class;
}

class PearsTree extends Tree
{
    protected $min_fruits = 0;
    protected $max_fruits = 20;
    protected $fruit_name = "Груша";
    protected $fruit = Pear::class;
}

$trees = [
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new ApplesTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
    new PearsTree(),
];

$controller = new Controller();
$controller->loadTrees($trees);
$fruits = $controller->collectAllFruits();

foreach ($fruits as $fruit) {
    echo "Фрукт: " . $fruit["name"] . PHP_EOL;
    echo "Количество: " . $fruit["count"] . PHP_EOL;
    echo "Вес: " . $fruit["weight"] . PHP_EOL;
    echo "---------------" . PHP_EOL;
}
