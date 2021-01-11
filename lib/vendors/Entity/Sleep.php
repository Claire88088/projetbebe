<?php
namespace Entity;

use \OCFram\Entity;

class Sleep extends Entity
{
  protected $creationStartDate,
            $updateStartDate,
            $creationEndDate,
            $updateEndDate,
            $isSleeping;


  public function isValid()
  {
    return true;
  }

  // setters
  public function setCreationStartDate(\DateTime $creationStartDate)
  {
    $this->creationStartDate = $creationStartDate;
  }

  public function setUpdateStartDate(\DateTime $updateStartDate)
  {
    $this->updateStartDate = $updateStartDate;
  }

  public function setCreationEndDate(\DateTime $creationEndDate)
  {
    $this->creationEndDate = $creationEndDate;
  }

  public function setUpdateEndDate(\DateTime $updateEndDate)
  {
    $this->updateEndDate = $updateEndDate;
  }

  public function setIsSleeping(bool $isSleeping)
  {
    $this->isSleeping = $isSleeping;
  }

  // getters
  public function creationStartDate()
  {
    return $this->creationStartDate;
  }

  public function updateStartDate()
  {
    return $this->updateStartDate;
  }

  public function creationEndDate()
  {
    return $this->creationEndDate;
  }

  public function updateEndDate()
  {
    return $this->updateEndDate;
  }

  public function isSleeping()
  {
    return $this->isSleeping;
  }
}