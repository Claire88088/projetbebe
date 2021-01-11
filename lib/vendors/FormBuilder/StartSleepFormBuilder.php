<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use OCFram\SubmitField;

class StartSleepFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->addSubmitButton(new SubmitField([
      'value' => 'Ajouter',
      'class' => 'btn btn-primary addSleep__button'
     ]));
  }
}