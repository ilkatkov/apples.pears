<?php

namespace ApplesPears\Trees;

use ApplesPears\Fruits\Apple;
use ApplesPears\Fruits\Pear;

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
