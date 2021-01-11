<?php
namespace Model;

use \Entity\Sleep;

class SleepManagerPDO extends SleepManager
{
  public function getSleepsList($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, creationStartDate, creationEndDate, isSleeping FROM sleep WHERE fk_userId = '.(int) $_SESSION['userId'].' ORDER BY id DESC';
    
    if ($start != -1 || $limit != -1) {
      $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
    }
    
    $request = $this->dao->query($sql);
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Sleep');
    
    $sleepsList = $request->fetchAll();
    
    foreach ($sleepsList as $sleep) {
      $sleep->setCreationStartDate(new \DateTime($sleep->creationStartDate()));
      $sleep->setCreationEndDate(new \DateTime($sleep->creationEndDate()));
    }
    
    $request->closeCursor();
    
    return $sleepsList;
  }

 
  public function getSleeps(Array $dates)
  {
    $request = $this->dao->prepare('SELECT creationStartDate, creationEndDate, isSleeping FROM sleep WHERE fk_userId = :userId AND creationStartDate >= :dateInf AND creationStartDate < :dateSup ORDER BY creationStartDate ASC');
    
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT); 
    $request->bindValue(':dateInf', $dates['dateInf']);
    $request->bindValue(':dateSup', $dates['dateSup']);
    
    $request->execute();
    
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Sleep');
    
    $sleeps = $request->fetchAll();
    
    foreach ($sleeps as $sleep) {
      $sleep->setCreationStartDate(new \DateTime($sleep->creationStartDate()));
      $sleep->setCreationEndDate(new \DateTime($sleep->creationEndDate()));
    }
    
    $request->closeCursor();
    
    return $sleeps;
  }


  public function countSleeps(Array $dates)
  {
    return $this->dao->query('SELECT COUNT(*) FROM sleep WHERE fk_userId ='.(int) $_SESSION['userId'].' AND creationStartDate >= "'.$dates['dateInf'].'" AND creationStartDate < "'.$dates['dateSup'].'"')->fetchColumn();
  }


  public function isBabySleep()
  {
    $sleepsList = $this->getSleepsList(0, 1);
    $lastSleep = (!empty($sleepsList)) ? $sleepsList[0] : null;
    if (!empty($lastSleep) AND $lastSleep->isSleeping() == 1) {
      return true;
    }
  }


  protected function add(Sleep $sleep)
  {
    $request = $this->dao->prepare('INSERT INTO sleep SET creationStartDate = NOW(), creationEndDate = NOW(), isSleeping = 1, fk_userId = :userId');
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT);
    $request->execute();
  }


  protected function addEnd(Sleep $sleep)
  {
    $request = $this->dao->prepare('UPDATE sleep SET creationEndDate = NOW(), isSleeping = 0 WHERE fk_userId = :userId AND id = :id');
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT);
    $request->bindValue(':id', $sleep->id(), \PDO::PARAM_INT);
    
    $request->execute();
  }
}