<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\PasswordField;
use \OCFram\NotNullValidator;

class ConnectionFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Login',
        'name' => 'login',
        'maxLength' => 250,
        'required' => true,
        'autofocus' => true,
        'validators' => [
          new NotNullValidator('Merci de saisir votre login'),
        ],
       ]))
       ->add(new PasswordField([
        'label' => 'Mot de passe',
        'name' => 'password',
        'maxLength' => 250,
        'required' => true,
        'validators' => [
          new NotNullValidator('Merci de saisir votre mot de passe'),
        ],
       ]));
  }
}