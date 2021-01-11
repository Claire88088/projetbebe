<?php
namespace Model;

use \Entity\Feeding;

class FeedingManagerPDO extends FeedingManager
{
  public function getFeedingsList($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, creationDate, volume FROM feeding WHERE fk_userId = '.(int) $_SESSION['userId'].' ORDER BY id DESC';
    
    if ($start != -1 || $limit != -1) {
      $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
    }
    
    $request = $this->dao->query($sql);
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Feeding');
    
    $feedingsList = $request->fetchAll();

    foreach ($feedingsList as $feeding) {
      $feeding->setCreationDate(new \DateTime($feeding->creationDate()));
    }
    
    $request->closeCursor();
    
    return $feedingsList;
  }

 
  public function getFeedings($dates)
  {
    $request = $this->dao->prepare('SELECT creationDate, volume FROM feeding WHERE fk_userId = :userId AND creationDate >= :dateInf AND creationDate < :dateSup ORDER BY creationDate ASC');
    
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT); 
    $request->bindValue(':dateInf', $dates['dateInf']);
    $request->bindValue(':dateSup', $dates['dateSup']);
    
    $request->execute();
    
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Feeding');
    
    $feedings = $request->fetchAll();
    
    foreach ($feedings as $feeding) {
      $feeding->setCreationDate(new \DateTime($feeding->creationDate()));
    }
    
    $request->closeCursor();
    
    return $feedings;
  }


  public function countFeedings(Array $dates)
  {
    return $this->dao->query('SELECT COUNT(*) FROM feeding WHERE fk_userId ='.(int) $_SESSION['userId'].' AND creationDate >= "'.$dates['dateInf'].'" AND creationDate < "'.$dates['dateSup'].'"')->fetchColumn();
  }


  protected function add(Feeding $feeding)
  {
    $request = $this->dao->prepare('INSERT INTO feeding SET volume = :volume, creationDate = NOW(), fk_userId = :userId');
    $request->bindValue(':volume', $feeding->volume());
    $request->bindValue(':userId', (int) $_SESSION['userId'], \PDO::PARAM_INT);
  
    $request->execute();
  }

}