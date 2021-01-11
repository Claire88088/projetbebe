<?php
namespace OCFram;

/**
 * Représente un champ de soumission (input type =  submit) dans un formulaire
 */
class SubmitField extends Field
{ 
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage)) {
      $widget .= '<div class="alert alert-danger">'.$this->errorMessage.'</div>';
    }
    
    if (!empty($this->class)) {
    $widget .= '<input type="submit" class="'.$this->class.'"';
    }

    if (!empty($this->id)) {
      $widget .= ' id="'.$this->id.'"';
    }

    if (!empty($this->value)) {
      $widget .= ' value="'.$this->value.'"';
    }
     
    return $widget .= ' />';
  }
}