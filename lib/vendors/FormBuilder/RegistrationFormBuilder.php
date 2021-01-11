<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\SubmitField;
use \OCFram\PasswordField;
use \OCFram\NotNullValidator;

class RegistrationFormBuilder extends FormBuilder
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
          new NotNullValidator('Merci de saisir un login'),
        ],
       ]))
       ->add(new PasswordField([
        'label' => 'Mot de passe',
        'name' => 'password',
        'id' => 'new-password',
        'maxLength' => 250,
        'required' => true,
        'validators' => [
          new NotNullValidator('Merci de saisir un mot de passe'),
        ],
       ]))
       ->add(new PasswordField([
        'label' => 'Confirmation du mot de passe',
        'name' => 'password',
        'id' => 'confirmation-password',
        'maxLength' => 250,
        'required' => true,
        'validators' => [
          new NotNullValidator('Merci de saisir un mot de passe'),
        ],
       ]));

       $this->form->addSubmitButton(new SubmitField([
        'value' => 'S\'inscrire',
        'id' => 'registration-submit-btn',
        'class' => 'btn btn-primary'
       ]));
  }
}