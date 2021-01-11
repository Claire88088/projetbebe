<?php
namespace Entity;

use \OCFram\Entity;

class Feeding extends Entity
{
  protected $creationDate,
            $updateDate,
            $volume;
          

  const INVALID_VOLUME = 1;
  
  public function isValid()
  {
    return !(empty($this->volume));
  }


  // setters
  public function setVolume($volume)
  {
    if (!is_int($volume) OR empty($volume)) {
      $this->erreurs[] = self::INVALID_VOLUME;
    }

    $this->volume = $volume;
  }

  public function setCreationDate(\DateTime $creationDate)
  {
    $this->creationDate = $creationDate;
  }

  public function setUpdateDate(\DateTime $updateDate)
  {
    $this->updateDate = $updateDate;
  }


  // getters
  public function volume()
  {
    return $this->volume;
  }

  public function creationDate()
  {
    return $this->creationDate;
  }

  public function updateDate()
  {
    return $this->updateDate;
  }
}