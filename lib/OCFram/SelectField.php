<?php
namespace OCFram;

/**
 * Représente une liste d'options (select) dans un formulaire
 */
class SelectField extends Field
{
  protected $optionsNumber;
  protected $id;
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage)) {
      $widget .= '<div class="alert alert-danger">'.$this->errorMessage.'</div>';
    }
    
    $widget .= '<div class="form-group"><label for='.$this->id.'>'.$this->label.'</label><select class="form-control" name="'.$this->name.' id='.$this->id.'">';
    
    
    if (!empty($this->value)) {
      $widget .= '<option value="'.$this->value.'">'.$this->text.'</option>';
    }
    
    return $widget .= '<select/></div>';
  }
  
  // setter
  public function setOptionsNumber($optionsNumber)
  {
    $optionsNumber = (int) $optionsNumber;
    
    if ($optionsNumber > 0) {
      $this->optionsNumber = $optionsNumber;
    } else {
      throw new \RuntimeException('Le nombre d\'options doit être un nombre supérieur à 0');
    }
  }
}