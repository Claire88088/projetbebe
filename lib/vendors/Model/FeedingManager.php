<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Feeding;

abstract class FeedingManager extends Manager
{
  /**
   * Méthode retournant une liste d'allaitements demandée
   * @param $start int Le premier allaitement à selectionner
   * @param $limit int Le nombre d'allaitements à sélectionner
   * @return array La liste des allaitements. Chaque entrée est une instance de Feeding.
   */
  abstract public function getFeedingsList($start = -1, $limit = -1);


  /**
   * Méthode retournant une liste d'allaitements sur une période donnée
   * @param $dates array Tableau comprenant les dates de début et de fin de la période
   * @return array La liste des allaitements. Chaque entrée est une instance de Feeding.
   */
  abstract public function getFeedings(Array $dates);


  /**
   * Méthode renvoyant le nombre d'allaitements sur une journée
   * @param $dates array Tableau comprenant les dates de début et de fin de la journée
   * @return int
   */
  abstract public function countFeedings(Array $dates);


  /**
   * Méthode permettant d'ajouter un allaitement.
   * @param $feeding Feeding L'allaitement à ajouter
   * @return void
   */
  abstract protected function add(Feeding $feeding);
  

  /**
   * Méthode permettant d'enregistrer un allaitement.
   * @param $feeding Feeding L'allaitement à enregistrer
   * @see self::add()
   * @return void
   */
  public function save(Feeding $feeding)
  {
    if ($feeding->isValid()) {
      if ($feeding->isNew()) {
        $this->add($feeding);
      } else {
        throw new \RuntimeException('L\'allaitement doit être nouveau pour être enregistré');
      }
    } else {
      throw new \RuntimeException('L\'allaitement doit être validé pour être enregistré');
    }
  }
}