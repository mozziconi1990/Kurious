<?php
namespace Kurious\Sql;

class SqlUnion
{
  public $left,$right;
  
  function __toString()
  {
    return '(' . (string) $this->left . ")\n" . " Union\n" . '(' . (string) $this->right . ')';
  }
} 