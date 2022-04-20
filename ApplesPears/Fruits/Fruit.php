<?php

namespace ApplesPears\Fruits;

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