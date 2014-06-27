<?php
namespace Kurious\Relation;
use Kurious\Formula\AndExpr;

class Restrict extends Relation
{
  public $formula,$inner;

  function __construct($formula,$inner)
  {
    $this->formula = $formula;
    $this->inner = $inner;
  }
  
  function attributes() { return $this->inner->attributes(); }

  function push_restrict()
  {
    return $this->inner->push_restrict_when_outer_is_a_restrict($this->formula);
  }

  function push_restrict_when_outer_is_a_restrict($outer_formula)
  {
    $merged = new Restrict(new AndExpr($this->formula,
                                       $outer_formula),
                           $this->inner);
    return $merged->push_restrict();
  }
}