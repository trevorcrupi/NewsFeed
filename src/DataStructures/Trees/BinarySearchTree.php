<?php

namespace Nucleus\DataStructures\Trees;

class BinarySearchTree
{
  public $root;

  public function __construct($value = null)
  {
    if($value !== null) {
      $this->root = new Node($value);
    }
  }

  public function search($value)
  {
    $node  = $this->root;

    while($node) {
      switch ($value) {
        case $value > $node->value:
          $node = $node->right;
          break;
        case $value < $node->value:
          $node = $node->left;
        default:
          break;
      }
    }

    return $node;
  }

  public function insert($value)
  {
    $node = $this->root;
    if(!$node)
      return $this->root = new Node($value);

      while($node) {
          if ($value > $node->value) {
              if ($node->right) {
                  $node = $node->right;
              } else {
                  $node = $node->right = new Node($value, $node);
                  break;
              }
          } elseif ($value < $node->value) {
              if ($node->left) {
                  $node = $node->left;
              } else {
                  $node = $node->left = new Node($value, $node);
                  break;
              }
          } else {
              break;
          }
      }
      return $node;
  }

  public function delete($value)
  {
    $node = $this->search($value);
    if($node)
      $node->delete();
  }
}
