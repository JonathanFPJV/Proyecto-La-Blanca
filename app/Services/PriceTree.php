<?php

namespace App\Services;

class TreeNode {
    public $producto;
    public $left = null;
    public $right = null;

    public function __construct($producto) {
        $this->producto = $producto;
    }
}

class PriceTree {
    private $root = null;

    public function insert($producto) {
        $this->root = $this->insertRec($this->root, $producto);
    }

    private function insertRec($node, $producto) {
        if ($node === null) {
            return new TreeNode($producto);
        }

        if ($producto->Precio < $node->producto->Precio) {
            $node->left = $this->insertRec($node->left, $producto);
        } else {
            $node->right = $this->insertRec($node->right, $producto);
        }

        return $node;
    }

    public function findInRange($min, $max) {
        $result = [];
        $this->findRec($this->root, $min, $max, $result);
        return $result;
    }

    private function findRec($node, $min, $max, &$result) {
        if ($node == null) {
            return;
        }

        if ($min < $node->producto->Precio) {
            $this->findRec($node->left, $min, $max, $result);
        }

        if ($node->producto->Precio >= $min && $node->producto->Precio <= $max) {
            $result[] = $node->producto;
        }

        if ($node->producto->Precio < $max) {
            $this->findRec($node->right, $min, $max, $result);
        }
    }
}
