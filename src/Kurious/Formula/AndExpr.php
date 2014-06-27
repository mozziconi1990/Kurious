<?php
namespace Kurious\Formula;

class AndExpr extends Binary
{
  function to_string()
  {
    return 'AND';
  }
}