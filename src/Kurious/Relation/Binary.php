<?php
namespace Kurious\Relation;

abstract class Binary extends Relation
{
  public $left,$right;

  function __construct($left,$right)
  {
    $this->left = $left;
    $this->right = $right;
  }

  function push_restrict()
  {
    $class = get_called_class();
    return new $class($this->left->push_restrict(),
                      $this->right->push_restrict());
  }
  
  function push_restrict_when_outer_is_a_restrict($outer_formula)
  {
    $class = get_called_class();
    $pushed = new $class(new Restrict($outer_formula,$this->left),
                         new Restrict($outer_formula,$this->right));
    return $pushed->push_restrict();
  }
}