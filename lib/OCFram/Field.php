<?php
namespace OCFram;

abstract class Field
{
  // On utilise le trait Hydrator afin que nos objets Field puissent être hydratés
  use Hydrator;
  
  protected $errorMessage;
  protected $label;
  protected $name;
  protected $value;
  protected $class;
  protected $id;
  protected $placeholder;
  protected $autofocus;
  protected $required;
  protected $checked;
  protected $validators = [];
  
  public function __construct(array $options = []) // $options = la liste des attributs avec leur valeur
  {
    if (!empty($options)) {
      $this->hydrate($options);
    }
  }
  
  /**
   * Méthode permettant de renvoyer le code HTML du champ
   */
  abstract public function buildWidget();
  

  public function isValid()
  {
    foreach ($this->validators as $validator) {
        if (!$validator->isValid($this->value)) {
            $this->errorMessage = $validator->errorMessage();
            return false;
        }
    }

    return true;
  }
  

  // getters
  public function label()
  {
    return $this->label;
  }
  
  public function name()
  {
    return $this->name;
  }
  
  public function value()
  {
    return $this->value;
  }

  public function validators()
  {
    return $this->validators;
  }

  public function required()
  {
    return $this->required;
  }

  public function placeholder()
  {
    return $this->placeholder;
  }

  public function autofocus()
  {
    return $this->autofocus;
  }

  public function checked()
  {
    return $this->checked;
  }
  
  public function class()
  {
    return $this->class;
  }

  public function id()
  {
    return $this->id;
  }
  

  // setters
  public function setLabel($label)
  {
    if (is_string($label)) {
      $this->label = $label;
    }
  }
  
  public function setName($name)
  {
    if (is_string($name)) {
      $this->name = $name;
    }
  }
  
  public function setValue($value)
  {
    if (is_string($value)) {
      $this->value = $value;
    }
  }

  public function setValidators(array $validators)
  {
    foreach ($validators as $validator) {
        if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
            $this->validators[] = $validator;
        }
    } 
  }

  public function setRequired(bool $required)
  {
    if ($required === true) {
      $this->required = 'required';
    }
  }

  public function setPlaceholder($placeholder)
  {
    if (is_string($placeholder)) {
      $this->placeholder = $placeholder;
    }
  }

  public function setAutofocus(bool $autofocus)
  {
    if ($autofocus === true) {
      $this->autofocus = 'autofocus';
    }
  }

  public function setChecked(bool $checked)
  {
    if ($checked === true) {
      $this->checked = 'checked';
    }
  
  }

  public function setClass($class)
  {
    if (is_string($class)) {
      $this->class = $class;
    }
  }

  public function setId($id)
  {
    if (is_string($id)) {
      $this->id = $id;
    }
  }
}