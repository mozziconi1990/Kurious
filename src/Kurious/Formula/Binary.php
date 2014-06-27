<?php
namespace Kurious\Formula;

abstract class Binary extends Formula
{
  private $left,$right;

  function __construct($left,$right)
  {
    if (!is_a($right,'Kurious\Formula\Formula')) {
      $right = new Constant($right);
    }

    $this->left = $left;
    $this->right = $right;
  }
  
  function subst_attrs($assoc)
  {
    $class = get_called_class();
    return new $class($left->subst_attrs($assoc),
                      $right->subst_attrs($assoc));
  }
  
  abstract function to_string();

  function __toString()
  {
    return ' ( ' . (string) $this->left . ' ) ' . $this->to_string() . ' ( ' . (string) $this->right . ' ) ';
  }
}