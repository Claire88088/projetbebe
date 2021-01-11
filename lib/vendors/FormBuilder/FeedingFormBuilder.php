<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\NumberField;
use OCFram\MinMaxValueValidator;
use \OCFram\NotNullValidator;
use OCFram\NumberValidator;

class FeedingFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new NumberField([
        'label' => 'Volume pris :',
        'name' => 'volume',
        'minValue' => 0,
        'maxValue' => 300,
        'step' => 10,
        'required' => true,
        'autofocus' => true,
        'placeholder' => 'ex : 100',
        'validators' => [
          new MinMaxValueValidator('Le volume saisi doit être compris entre 0 et 300', 0, 300),
          new NotNullValidator('Merci de spécifier le volume pris'),
          new NumberValidator('Le volume saisi doit être un nombre entier'),
        ],
       ]));
  }
}