<?php
namespace Entity;

use \OCFram\Entity;

class BabyChange extends Entity
{
  protected $creationDate,
            $updateDate,
            $changeType;
          

  const INVALID_CHANGETYPE = 1;
  
  public function isValid()
  {
    return !(empty($this->changeType));
  }


  // setters
  public function setChangeType($changeType)
  {
    if (empty($changeType)) {
      $this->erreurs[] = self::INVALID_CHANGETYPE;
    }

    $this->changeType = $changeType;
  }

  public function setCreationDate(\DateTime $creationDate)
  {
    $this->creationDate = $creationDate;
  }
  
  public function setUpadteDate(\DateTime $updateDate)
  {
    $this->updateDate = $updateDate;
  }


  // getters
  public function changeType()
  {
    return $this->changeType;
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