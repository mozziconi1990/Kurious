<?php
namespace Kurious\Formula;

class Attribute extends Formula
{
  private $attribute;

  function __construct($attribute)
  {
    $this->attribute = $attribute;
  }

  function __call($func,$args)
  {
    switch ($func) {
    case 'as': return array($args[0],$this);
    }
  }

  function name()
  {
    return $this->attribute;
  }
  
  function subst_attrs($assoc)
  {
    if (array_key_exists($this->attribute,$assoc)) {
      return $assoc[$this->attribute];
    } else {
      return $this;
    }
  }
  
  function __toString()
  {
    return $this->attribute;
  }
}