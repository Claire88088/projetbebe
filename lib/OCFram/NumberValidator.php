<?php
namespace OCFram;

class NumberValidator extends Validator
{
  public function isValid($value)
  {
    return is_int((int) $value);
  }
}