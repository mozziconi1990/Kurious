<?php
namespace Kurious\Unary;

abstract class Unary extends Formula
{
  private $inner;

  function __construct($inner)
  {
    $this->inner = $inner;
  }
}