<?php
namespace Kurious\Formula;

class Constant extends Formula
{
  private $constant;

  function __construct($constant)
  {
    $this->constant = $constant;
  }

  function subst_attrs($assoc)
  {
    return $this;
  }
  
  function __toString()
  {
    if (is_array($this->constant)) {
      return '(' . implode(',',$this->constant) . ')';
    } else {
      return (string) $this->constant;
    }
  }
}