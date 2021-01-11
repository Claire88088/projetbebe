<?php
namespace Model;

use \OCFram\Manager;
use \Entity\User;

abstract class UserManager extends Manager
{
  /**
   * Méthode permettant de récupérer un utilisateur
   * @param $login Le login saisi par l'utilisateur
   * @return $user User L'utilisateur correspondant au login
   */
  abstract protected function getUser($login);

  /**
   * Méthode permettant d'ajouter un utilisateur.
   * @param $user User L'utilisateur à ajouter
   * @return void
   */
  abstract protected function add(User $user);
  
  /**
   * Méthode permettant d'enregistrer un utilisateur.
   * @param $user User Le utilisateur à enregistrer
   * @see self::add()
   * @return void
   */
  public function save(User $user)
  { 
    if ($user->isValid()) {
      if ($user->isNew()) {
        $this->add($user);
      } else {
        throw new \RuntimeException('L\'utilisateur doit être nouveau pour être enregistré');
      }
    } else {
      throw new \RuntimeException('L\'utilisateur doit être validé pour être enregistré');
    }
  }
}