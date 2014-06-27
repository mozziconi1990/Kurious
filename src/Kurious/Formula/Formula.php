<?php
namespace Kurious\Formula;

abstract class Formula
{
  function eq($right)
  {
    return new Eq($this,$right);
  }

  function lt($right)
  {
    return new Lt($this,$right);
  }

  function gt($right)
  {
    return new Gt($this,$right);
  }

  function le($right)
  {
    return new Le($this,$right);
  }

  function ge($right)
  {
    return new Ge($this,$right);
  }

  function in($right)
  {
    return new In($this,$right);
  }

  function __call($name,$args)
  {
    switch ($name) {
    case 'and':
      return new AndExpr($this,$args[0]);
    case 'or':
      return new OrExpr($this,$args[0]);
    }
  }

  abstract function subst_attrs($assoc);
}