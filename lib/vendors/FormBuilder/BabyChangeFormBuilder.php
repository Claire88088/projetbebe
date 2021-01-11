<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\RadioField;
use \OCFram\NotNullValidator;

class BabyChangeFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new RadioField([
        'label' => 'Urine',
        'name' => 'changeType',
        'value' => 'urine',
        'required' => true,
        'checked' => true,
        'validators' => [
          new NotNullValidator('Merci de spécifier le type de change'),
        ],
       ]))
       ->add(new RadioField([
        'label' => 'Selle',
        'name' => 'changeType',
        'value' => 'selle',
        'required' => true,
        'validators' => [
          new NotNullValidator('Merci de spécifier le type de change'),
        ],
       ]))
       ->add(new RadioField([
        'label' => 'Les deux',
        'name' => 'changeType',
        'value' => 'urine et selle',
        'required' => true,
        'validators' => [
          new NotNullValidator('Merci de spécifier le type de change'),
        ],
       ]));
  }
}