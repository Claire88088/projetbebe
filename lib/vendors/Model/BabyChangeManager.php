<?php
namespace Model;

use \OCFram\Manager;
use \Entity\BabyChange;

abstract class BabyChangeManager extends Manager
{
  /**
   * Méthode retournant une liste de changes demandée
   * @param $start int Le premier change à selectionner
   * @param $limit int Le nombre de changes à sélectionner
   * @return array La liste des changes. Chaque entrée est une instance de BabyChange.
   */
  abstract public function getBabyChangesList($start = -1, $limit = -1);

  /**
   * Méthode retournant une liste de changes sur une période donnée
   * @param $dates array Tableau comprenant les dates de début et de fin de la journée
   * @return array La liste des changes. Chaque entrée est une instance de BabyChange
   */
  abstract public function getBabyChanges(Array $dates);


  /**
   * Méthode renvoyant le nombre de changes sur une journée
   * @param $dates array Tableau comprenant les dates de début et de fin de la journée
   * @return int
   */
  abstract public function countBabyChanges(Array $dates);

  
  /**
   * Méthode permettant d'ajouter un change.
   * @param $babyChange Babychange Le change à ajouter
   * @return void
   */
  abstract protected function add(BabyChange $babyChange);
  

  /**
   * Méthode permettant d'enregistrer un change.
   * @param $babyChange BabyChange Le change à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(BabyChange $babyChange)
  {
    if ($babyChange->isValid()) {
      if ($babyChange->isNew()) {
        $this->add($babyChange);
      } else {
        throw new \RuntimeException('Le change doit être nouveau pour être enregistré');
      } 
    } else {
      throw new \RuntimeException('Le change doit être validé pour être enregistré');
    }
  }
}