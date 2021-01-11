<?php
namespace App\Backoffice;

use \OCFram\Application;

class BackofficeApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Backoffice';
  }

  public function run()
  { 
    $controller = $this->getController();
    $controller->execute();
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}