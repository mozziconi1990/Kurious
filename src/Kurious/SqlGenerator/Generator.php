<?php
namespace Kurious\SqlGenerator;
use Kurious\Sql\SqlSelect;
use Kurious\Sql\SqlUnion;

class Generator
{
  private $sql_expr = null;

  function __construct($sql_expr)
  {
    $this->sql_expr = $sql_expr;
  }

  function translate_table($table)
  {
    if (is_null($this->sql_expr)) {
      $this->sql_expr = new SqlSelect();
    }

    $this->sql_expr->from = $table->name;
    return $this->sql_expr;
  }

  function translate_project($project)
  {
    if (is_null($this->sql_expr)) {
      $this->sql_expr = new SqlSelect();
    }

    $select = array();
    foreach ($project->assoc as $key => $value) {
      $select[$value->name()] = $key;
    }
    $this->sql_expr->select = $select;
    return $project->inner->to_sql($this);
  }

  function translate_restrict($restrict)
  {
    if (is_null($this->sql_expr)) {
      $this->sql_expr = new SqlSelect();
    }

    $this->sql_expr->where = $restrict->formula;
    return $restrict->inner->to_sql($this);
  }

  function translate_union($union)
  {
    $this->sql_expr = new SqlUnion();
    $this->sql_expr->left = $union->left->to_sql();
    $this->sql_expr->right = $union->right->to_sql();
    return $this->sql_expr;
  }
}