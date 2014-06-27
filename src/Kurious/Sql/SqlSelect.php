<?php
namespace Kurious\Sql;

class SqlSelect
{
  public $select,$from,$where;
  
  function __toString()
  {
    $foo = array();
    foreach ($this->select as $key => $value) {
      $foo[] = $key . ' AS ' . $value;
    }
    $attrs = implode(', ',$foo);
    $where = '';
    if (isset($this->where)) {
      $where = ' WHERE ' . (string) $this->where;
    }
    return 'SELECT ' . $attrs . ' FROM ' . $this->from .$where;
  }
}