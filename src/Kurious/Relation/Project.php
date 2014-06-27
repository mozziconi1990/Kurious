<?php
namespace Kurious\Relation;

class Project extends Relation
{
  public $assoc,$inner;

  function __construct($assoc,$inner)
  {
    $this->assoc = $assoc;
    $this->inner = $inner;
  }
  
  function attributes()
  {
    return array_keys($this->assoc);
  }

  function push_restrict()
  {
    return new Project($this->assoc,
                       $this->inner->push_restrict());
  }
  
  function push_restrict_when_outer_is_a_restrict($outer_formula)
  {
    $substed = new Restrict($outer_formula->subst_attrs($this->assoc),
                            $this->inner);
    return new Project($this->assoc,$substed->push_restrict());
  }
}