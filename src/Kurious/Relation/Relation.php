<?php
namespace Kurious\Relation;
use Kurious\Formula\Attribute;
use Kurious\SqlGenerator\Generator;

abstract class Relation implements \ArrayAccess, \Iterator
{
  function select($attribute)
  {
    return new Attribute($attribute);
  }

  function offsetExists($offset) {}
  function offsetGet($attribute)
  {
    return $this->select($attribute);
  }
  function offsetSet($offset,$value) {}
  function offsetUnset($offset) {}

  private $result = array(array('id'=>1,'name'=>'mark','gender'=>'male'),
                          array('id'=>2,'name'=>'tom', 'gender'=>'male'));
  function current()
  {
    return current($this->result);
  }
  function key()
  {
    return key($this->result);
  }
  function next()
  {
    return next($this->result);
  }
  function rewind()
  {
    reset($this->result);
  }
  function valid()
  {
    $key = key($this->result);
    return $key !== NULL && $key !== FALSE;
  }

  abstract function attributes();

  static function table($name,$attributes)
  {
    return new Table($name,$attributes);
  }

  function project()
  {
    $attributes = func_get_args();
    $assoc = array();
    foreach ($attributes as $attr) {
      if (is_a($attr,'Kurious\Formula\Attribute')) {
        $assoc[$attr->name()] = $attr;
      } elseif (is_array($attr)) {
        $assoc[$attr[0]] = $attr[1];
      }
    }
    return new Project($assoc,$this);
  }

  function restrict($formula)
  {
    return new Restrict($formula,$this);
  }

  function union($right)
  {
    return new Union($this,$right);
  }
  
  function optimize()
  {
    return $this->push_restrict();
  }

  abstract function push_restrict();
  abstract function push_restrict_when_outer_is_a_restrict($outer_formula);
  
  function to_sql($generator = null)
  {
    if (is_null($generator)) {
      $generator = new Generator(null);
    }
    $class = array_pop(explode('\\',strtolower(get_called_class())));
    $translate = 'translate_' . $class;
    return $generator->$translate($this);
  }
}