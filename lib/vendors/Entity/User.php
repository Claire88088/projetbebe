<?php
namespace Entity;

use \OCFram\Entity;

class User extends Entity
{
  protected $login,
            $password;
          
  const INVALID_LOGIN = 1;
  const INVALID_PASSWORD = 2;
  
  public function isValid()
  {
    return (!(empty($this->login)) AND (!(empty($this->password))));
  }


  // setters
  public function setLogin($login)
  {
    if (empty($login)) {
      $this->erreurs[] = self::INVALID_LOGIN;
    }
    $this->login = $login;
  }

  public function setPassword($password)
  {
    if (empty($password)) {
      $this->erreurs[] = self::INVALID_PASSWORD;
    }
    $this->password = $password; 
  }


  // getters
  public function login()
  {
    return $this->login;
  }

  public function password()
  {
    return $this->password;
  }
}