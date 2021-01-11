<?php
namespace OCFram;

class MinMaxValueValidator extends Validator
{
  protected $minValue;
  protected $maxValue;
  
  public function __construct($errorMessage, $minValue, $maxValue)
  {
    parent::__construct($errorMessage);
    
    $this->setMinValue($minValue);
    $this->setMaxValue($maxValue);
  }
  
  public function isValid($value)
  {
    return ($value >= $this->minValue AND $value <= $this->maxValue); 
  }
  

  public function setMinValue($minValue)
  {
    $minValue = (int) $minValue;
    
    if ($minValue >= 0) {
      $this->minValue = $minValue;
    } else {
      throw new \RuntimeException('La valeur minimale doit être un nombre supérieur ou égal à 0');
    }
  }

  public function setMaxValue($maxValue)
  {
    $maxValue = (int) $maxValue;
    
    if ($maxValue > 0) {
      $this->maxValue = $maxValue;
    } else {
      throw new \RuntimeException('La valeur maximale doit être un nombre supérieur à 0');
    }
  }
}