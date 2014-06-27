<?php
namespace Kurious\Formula;

class Eq extends Binary
{
  function to_string()
  {
    return '=';
  }
}