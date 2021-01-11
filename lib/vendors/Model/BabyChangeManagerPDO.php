<?php
namespace Model;

use \Entity\BabyChange;

class BabyChangeManagerPDO extends BabyChangeManager
{
  public function getBabyChangesList($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, creationDate, changeType FROM babychange WHERE fk_userId = '.(int) $_SESSION['userId'].' ORDER BY id DESC ';
    
    if ($start != -1 || $limit != -1) {
      $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
    }
    
    $request = $this->dao->query($sql);
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\BabyChange');
    
    $babyChangesList = $request->fetchAll();
   
    foreach ($babyChangesList as $babyChange) {
      $babyChange->setCreationDate(new \DateTime($babyChange->creationDate()));
    }
    
    $request->closeCursor();
    
    return $babyChangesList;
  }

 
  public function getBabyChanges($dates)
  {
    $request = $this->dao->prepare('SELECT creationDate, changeType FROM babychange WHERE fk_userId = :userId AND creationDate >= :dateInf AND creationDate < :dateSup ORDER BY creationDate ASC');
    
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT);    
    $request->bindValue(':dateInf', $dates['dateInf']);    
    $request->bindValue(':dateSup', $dates['dateSup']);
    
    $request->execute();
    
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\BabyChange');
    
    $babyChanges = $request->fetchAll();
    
    foreach ($babyChanges as $babyChange) {
      $babyChange->setCreationDate(new \DateTime($babyChange->creationDate()));
    }
    
    $request->closeCursor();
    
    return $babyChanges;
  }


  public function countBabyChanges(Array $dates)
  {    
    return $this->dao->query('SELECT COUNT(*) FROM babychange WHERE fk_userId ='.(int) $_SESSION['userId'].' AND creationDate >= "'.$dates['dateInf'].'" AND creationDate < "'.$dates['dateSup'].'"')->fetchColumn();
  }


  protected function add(BabyChange $babyChange)
  {
    $request = $this->dao->prepare('INSERT INTO babychange SET changeType = :changeType, creationDate = NOW(), fk_userId = :userId');
    
    $request->bindValue(':changeType', $babyChange->changeType());
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT);
    
    $request->execute();
  }
}