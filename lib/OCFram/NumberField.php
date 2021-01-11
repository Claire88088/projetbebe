<?php
namespace OCFram;

/**
 * Représente un champ de nombre (input type =  number) dans un formulaire
 */
class NumberField extends Field
{
  protected $minValue;
  protected $maxValue;
  protected $step;
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage)) {
      $widget .= '<div class="alert alert-danger">'.$this->errorMessage.'</div>';
    }
    
    $widget .= '<div class="form-group"><label>'.$this->label.'</label> <input type="number" class="form-control" name="'.$this->name.'"';
    
    if (!empty($this->value)) {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->minValue)) {
      $widget .= ' min="'.$this->minValue.'"';
    }

    if (!empty($this->maxValue)) {
      $widget .= ' max="'.$this->maxValue.'"';
    }

    if (!empty($this->step)) {
      $widget .= ' step="'.$this->step.'"';
    }

    if (!empty($this->placeholder)) {
      $widget .= ' placeholder="'.$this->placeholder.'"';
    }

    if (!empty($this->required)) {
      $widget .= ' required ';
    }

    if (!empty($this->autofocus)) {
      $widget .= ' autofocus ';
    }
    
    return $widget .= ' /></div>';
  }
  
  // setter
  public function setMaxValue($maxValue)
  {
    $maxValue = (int) $maxValue;
    
    if ($maxValue > 0) {
      $this->maxValue = $maxValue;
    } else {
      throw new \RuntimeException('La valeur maximale doit être un nombre supérieur à 0');
    }
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

  public function setStep($step)
  {
      $step = (int) $step;

      if ($step >= 0) {
        $this->step = $step;
      } else {
          throw new \RuntimeException('Le pas doit être un nombre supérieur ou égal à 0');
      }
  }
}