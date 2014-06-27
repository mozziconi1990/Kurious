<?php
namespace Kurious\Relation;

class Table extends Relation
{
  public $name,$attributes;

  function __construct($name,$attributes)
  {
    $this->name = $name;
    $this->attributes = $attributes;
  }
  
  function attributes() { return $this->attributes; }
  
  function push_restrict()
  {
    return $this;
  }
  
  function push_restrict_when_outer_is_a_restrict($outer_formula)
  {
    return new Restrict($outer_formula,$this);
  }
}