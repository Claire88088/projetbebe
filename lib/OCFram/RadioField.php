<?php
namespace OCFram;

/**
 * Représente une zone d'option (input type =  radio) dans un formulaire
 */
class RadioField extends Field
{
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage)) {
      $widget .= '<div class="alert alert-danger">'.$this->errorMessage.'</div>';
    }
    
    $widget .= '<div class="form-check">
          <input type="radio" class="form-check-input" name="'.$this->name.'"';
    
    if (!empty($this->value)) {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }

    if (!empty($this->required)) {
      $widget .= ' required ';
    }

    if (!empty($this->checked)) {
      $widget .= ' checked ';
    }

    $widget .= '/> <label class="form-check-label">'.$this->label.'</label></div>';
    
    return $widget;
  }
  
}