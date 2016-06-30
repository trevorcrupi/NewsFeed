<?php

namespace Nucleus\DataStructures\Trees;

class Node
{
  public $value, $left, $right;

  public function __construct( $value, Node $parent = null )
  {
    $this->value = $value;
    $this->parent = $parent;
  }

  public function delete()
  {
      if ($this->left && $this->right) {
          $min = $this->right->min();
          $this->value = $min->value;
          $min->delete();
      } elseif ($this->right) {
          if ($this->parent->left === $this) {
              $this->parent->left = $this->right;
              $this->right->parent = $this->parent->left;
          } elseif ($this->parent->right === $this) {
              $this->parent->right = $this->right;
              $this->right->parent = $this->parent->right;
          }
          $this->parent = null;
          $this->right   = null;
      } elseif ($this->left) {
          if ($this->parent->left === $this) {
              $this->parent->left = $this->left;
              $this->left->parent = $this->parent->left;
          } elseif ($this->parent->right === $this) {
              $this->parent->right = $this->left;
              $this->left->parent = $this->parent->right;
          }
          $this->parent = null;
          $this->left   = null;
      } else {
          if ($this->parent->right === $this) {
              $this->parent->right = null;
          } elseif ($this->parent->left === $this) {
              $this->parent->left = null;
          }
          $this->parent = null;
      }
  }
}
