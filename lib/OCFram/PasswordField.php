<?php
namespace OCFram;

/**
 * Représente un champ de mot de passe (input type =  password) dans un formulaire
 */
class PasswordField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage)) {
      $widget .= '<div class="alert alert-danger">'.$this->errorMessage.'</div>';
    }
    
    $widget .= '<div class="form-group"><label>'.$this->label.'</label> <input type="password" class="form-control" name="'.$this->name.'"';
    
    if (!empty($this->id)) {
      $widget .= ' id="'.$this->id.'"';
    }

    if (!empty($this->value)) {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->maxLength)) {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }

    if (!empty($this->required)) {
      $widget .= ' required ';
    }

    if (!empty($this->autofocus)) {
      $widget .= ' autofocus ';
    }
    
    return $widget .= ' /><div class="alert alert-warning" role="alert"></div></div>';
  }
  
  // setter
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0) {
      $this->maxLength = $maxLength;
    } else {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}