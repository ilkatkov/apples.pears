<?php

namespace ApplesPears\Fruits;

/**
 * Этот абстрактный класс является основой для всех фруктов.
 */
abstract class Fruit
{
    private $weight;

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
