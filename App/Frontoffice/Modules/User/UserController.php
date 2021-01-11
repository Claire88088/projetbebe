<?php
namespace App\Frontoffice\Modules\User;

use \OCFram\BackController;
use FormBuilder\ConnectionFormBuilder;
use FormBuilder\RegistrationFormBuilder;
use \OCFram\FormHandler;
use OCFram\HTTPRequest;
use Entity\User;

class UserController extends BackController
{
  /**
   * Méthode permettant l'affichage de l'index
   */
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion Appli Bébé');

    // Si le formulaire a déjà été envoyé
    if ($request->method() == 'POST') {
      $formLogin = htmlspecialchars($request->postData('login'));
      $formPassword = htmlspecialchars($request->postData('password'));
      
      $userManager = $this->managers->getManagerOf('User');
      $user = $userManager->getUser($formLogin);
      
      if (is_object($user)) { // Si l'utilisateur est enregistré en BDD
        $password = $user->password(); // On récupère le mot de passe haché stocké en BDD

        // On vérifie que le mot de passe stocké et celui saisi sont identiques
        if ($formLogin == $formLogin && password_verify($formPassword, $password)) {
          $this->app->user()->setAuthenticated(true);
          $this->app->user()->setId($user->id()); // On met le userId stocké en BDD comme variable de Session
          $this->app->httpResponse()->redirect(BASE_URL.'/admin/');
        } else {
          $this->app->user()->setFlash('Login ou mot de passe incorrect.');
          
          // On réinitilise l'objet User en gardant le login
          $user->setLogin($formLogin);
          $user->setPassword('');
        }
      } else {
        $this->app->user()->setFlash('Vous n\'êtes pas encore inscrit.');
        $user = new User;
      }
    } else {
      $user = new User;
    }
    
    // Création du formulaire
    $connectionFormBuilder = new ConnectionFormBuilder($user);
    $connectionFormBuilder->build();
    $connectionForm = $connectionFormBuilder->form();

    $this->page->addVar('form', $connectionForm->createView());
  }


  public function executeInsertNewUser(HTTPRequest $request)
  {
    $this->page->addVar('title', 'S\'inscrire');

    if ($request->method() == 'POST') {
      // On vérifie que le login n'est pas déjà utilisé
      $formLogin = htmlspecialchars($request->postData('login'));
      $userManager = $this->managers->getManagerOf('User');
      $user = $userManager->getUser($formLogin);

      if (is_object($user)) {// Si le login est déjà pris
        $this->app->user()->setFlash('Ce login est déjà utilisé.');

        // On réinitilise l'objet User
        $user->setLogin('');
        $user->setPassword(''); 
               
      } else {
        $user = new User([
          'login' => $formLogin,
          'password' => htmlspecialchars(password_hash($request->postData('password'), PASSWORD_DEFAULT))
        ]);
      }
    } else {
      $user = new User;
    }

    $registrationFormBuilder = new RegistrationFormBuilder($user);
    $registrationFormBuilder->build();
    $registrationForm = $registrationFormBuilder->form();

    $formHandler = new FormHandler($registrationForm, $this->managers->getManagerOf('User'), $request);

    if ($formHandler->process()) {
      $this->app->user()->setFlash('Vous êtes inscrit !');
      $this->app->httpResponse()->redirect(BASE_URL.'/');
    } 

    $this->page->addVar('form', $registrationForm->createView());
  }
}