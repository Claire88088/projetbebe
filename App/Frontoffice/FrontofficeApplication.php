<?php
namespace App\Frontoffice;

use \OCFram\Application;


class FrontofficeApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Frontoffice';
  }

  public function run()
  {
    $controller = $this->getController();
    $controller->execute();
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}