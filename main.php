<?php

/**
 * Этот класс является контроллером сборщика фруктов.
 */
class Controller
{
    public function __construct()
    {
        $this->trees = array();
    }

    /**
     * Возвращает массив данных о всех собранных фруктах.
     *
     * @return array собранные фрукты.
     */
    public function collectAllFruits(): array
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

    /**
     * Загружает деревья плодов в сборщик фруктов.
     *
     * @param array $trees массив дервеьев.
     */
    public function loadTrees(array $trees): void
    {
        foreach ($trees as $tree) {
            $this->addTree($tree);
        }
    }

    /**
     * Добавляет дерево в массив $trees.
     *
     * @param Tree $tree дерево.
     */
    private function addTree(Tree $tree): void
    {
        $this->trees[] = $tree;
    }
}

/**
 * Этот абстрактный класс является основой для всех фруктов.
 */
abstract class Fruit
{
    public function __construct()
    {
        $this->weight = rand($this->min_weight, $this->max_weight);
    }

    /**
     * Возвращает вес фрукта.
     *
     * @return int вес фрукта.
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}

/**
 * Класс для создания яблок.
 */
class Apple extends Fruit
{
    protected $min_weight = 150;
    protected $max_weight = 180;
}

/**
 * Класс для создания груш.
 */
class Pear extends Fruit
{
    protected $min_weight = 130;
    protected $max_weight = 170;
}

/**
 * Этот абстрактный класс является основой для всех деревьев.
 */
abstract class Tree
{
    public function __construct()
    {
        $this->uuid = uniqid();
        $this->fruits = array();
        $this->setFruits();
    }

    /**
     * Генерирует и устанавливает фрукты на дереве.
     *
     */
    private function setFruits(): void
    {
        $fruits_count = rand($this->min_fruits, $this->max_fruits);
        for ($i = 0; $i < $fruits_count; $i++) {
            $this->fruits[] = new $this->fruit;
        }
    }

    /**
     * Возвращает название фрукта.
     *
     * @return string название фрукта.
     */
    private function getFruitName(): string
    {
        return $this->fruit_name;
    }

    /**
     * Возвращает массив фруктов дерева.
     *
     * @return array массив фруктов.
     */
    private function getFruits(): array
    {
        return $this->fruits;
    }

    /**
     * Возвращает число фруктов на дереве.
     *
     * @return int количество фруктов.
     */
    private function getFruitsCount(): int
    {
        return count($this->getFruits());
    }

    /**
     * Возвращает общий вес фруктов на дереве.
     *
     * @return int общий вес фруктов.
     */
    private function getFruitsWeight(): int
    {
        $total_weight = 0;
        foreach ($this->fruits as $fruit) {
            $total_weight += $fruit->getWeight();
        }
        return $total_weight;
    }

    /**
     * Возвращает уникальный регистрационный номер дерева.
     *
     * @return string UUID дерева.
     */
    public function getUUID(): string
    {
        return $this->uuid;
    }

    /**
     * Возвращает массив данных о фруктах с дерева и очищает список $fruits.
     *
     * "fruit" - название плода,
     * "count" - количество фруктов,
     * "weight" - общий вес фруктов,
     *
     * @return array массив данных о собранных фруктах.
     */
    public function collectFruits(): array
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


$trees = array();
// загрузка яблонь и груш
for ($i = 0; $i < 10; $i++) {
    $trees[] = new ApplesTree;
}
for ($i = 0; $i < 15; $i++) {
    $trees[] = new PearsTree;
}

$controller = new Controller;
$controller->loadTrees($trees);
$fruits = $controller->collectAllFruits();

foreach ($fruits as $fruit) {
    echo "Фрукт: " . $fruit["name"] . PHP_EOL;
    echo "Количество: " . $fruit["count"] . PHP_EOL;
    echo "Вес: " . $fruit["weight"] . PHP_EOL;
    echo "---------------" . PHP_EOL;
}
