<?php
namespace Kurious\Relation;

class Union extends Binary
{
  function attributes()
  {
    return $this->left->attributes();
  }
}