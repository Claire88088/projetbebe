<?php
namespace Model;

use \Entity\User;

class UserManagerPDO extends UserManager
{
    public function getUser($login)
    {
        $request = $this->dao->prepare('SELECT id, password FROM user WHERE login = :login');
        $request->bindValue(':login', $login);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        $user = $request->fetch();
        $request->closeCursor();
        
        return $user;
    }
    
    protected function add(User $user)
    {
        $request = $this->dao->prepare('INSERT INTO user SET login = :login, password = :password');
        $request->bindValue(':login', $user->login());
        $request->bindValue(':password', $user->password());

        $request->execute();
    }
}