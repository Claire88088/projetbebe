<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Sleep;

abstract class SleepManager extends Manager
{
  /**
   * Méthode retournant une liste de sommeils demandée
   * @param $start int Le premier sommeil à selectionner
   * @param $limit int Le nombre de sommeils à sélectionner
   * @return array La liste des sommeils. Chaque entrée est une instance de Sleep.
   */
  abstract public function getSleepsList($start = -1, $limit = -1);


  /**
   * Méthode retournant une liste de sommeils sur une période donnée
   * @param $dates array Tableau comprenant les dates de début et de fin de la période.
   * @return array La liste des sommeils. Chaque entrée est une instance de Sleep.
   */
  abstract public function getSleeps(Array $dates);


  /**
   * Méthode renvoyant le nombre de sommeils sur une journée
   * @param $dates array Tableau comprenant les dates de début et de fin de la journée
   * @return int
   */
  abstract public function countSleeps(Array $dates);


  /**
   * Méthode renvoyant si le bébé est en train de dormir ou non
   * @return bool
   */
  abstract public function isBabySleep();

  
  /**
   * Méthode permettant d'ajouter un sommeil.
   * @param $sleep Sleep Le sommeil à ajouter
   * @return void
   */
  abstract protected function add(Sleep $sleep);


  /**
   * Méthode permettant d'ajouter la fin d'un sommeil
   * @param $sleep Sleep le sommeil auquel ajouter une heure de fin
   * @return void
   */
  abstract protected function addEnd(Sleep $sleep);
  
  
  /**
   * Méthode permettant d'enregistrer un sommeil.
   * @param $sleep Sleep Le sommeil à enregistrer
   * @see self::add()
   * @see self::addEnd()
   * @return void
   */
  public function save(Sleep $sleep)
  {
    if ($sleep->isValid()) {
      $sleep->isNew() ? $this->add($sleep) : $this->addEnd($sleep);
    } else {
      throw new \RuntimeException('Le sommeil doit être validé pour être enregistré');
    }
  }
}