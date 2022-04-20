<?php

namespace ApplesPears\Controllers;

use ApplesPears\Trees\Tree;

/**
 * Этот класс является контроллером сборщика фруктов.
 */
class Collector
{
    private $trees;

    public function __construct()
    {
        $this->trees = array();
    }

    /**
     * Возвращает массив данных о всех собранных фруктах.
     * 
     * "name" - название плода,
     * "count" - количество фруктов,
     * "weight" - общий вес фруктов.
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