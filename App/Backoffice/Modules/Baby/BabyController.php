<?php
namespace App\Backoffice\Modules\Baby;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\FormHandler;
use \Entity\Feeding;
use \Entity\BabyChange;
use \Entity\Sleep;
use \FormBuilder\FeedingFormBuilder;
use \FormBuilder\BabyChangeFormBuilder;
use \FormBuilder\StartSleepFormBuilder;
use \FormBuilder\EndSleepFormBuilder;

class BabyController extends BackController
{
  /**
   * Méthode permettant l'affichage de l'index
   */
  public function executeIndex()
  {
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Accueil appli bébé');
    
    // On récupère les managers de l'alimentation, du change et du sommeil
    $feedingManager = $this->managers->getManagerOf('Feeding');
    $babyChangeManager = $this->managers->getManagerOf('BabyChange');
    $sleepManager = $this->managers->getManagerOf('Sleep');
   
    // On récupère les listes des derniers allaitement, change et sommeil (listes de 1 seul élément)
    $feedingsList = $feedingManager->getFeedingsList(0, 1);
    $sleepsList = $sleepManager->getSleepsList(0, 1);
    $babyChangesList = $babyChangeManager->getBabyChangesList(0, 1);

    // On vérifie que les données existent
    $lastFeeding = (!empty($feedingsList)) ? $feedingsList[0] : null;
    $lastSleep = (!empty($sleepsList)) ? $sleepsList[0] : null;
    $lastBabyChange = (!empty($babyChangesList)) ? $babyChangesList[0] : null;
    
    // On ajoute les variables des derniers allaitement, change et sommeil à la vue.
    $this->page->addVar('lastBabyChange', $lastBabyChange);
    $this->page->addVar('lastFeeding', $lastFeeding);
    $this->page->addVar('lastSleep', $lastSleep);
  }

  public function executeInsertFeeding(HTTPRequest $request)
  { 
    // Si le formulaire a été envoyé, on créé un nouveau commentaire avec les valeurs du formulaire
    if ($request->method() == 'POST') {
      $feeding = new Feeding([
        'volume' => htmlspecialchars($request->postData('volume'))
      ]);
    } else {
      $feeding = new Feeding;
    }
    
    $formBuilder = new FeedingFormBuilder($feeding);
    $formBuilder->build();
   
    $form = $formBuilder->form();
    
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Feeding'), $request);

    if ($formHandler->process()) {
      $this->app->user()->setFlash('Le biberon a bien été ajouté, merci !');
      $this->app->httpResponse()->redirect(BASE_URL.'/admin/');
    } 

    $this->page->addVar('feeding', $feeding);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajouter un biberon');
  }

  public function executeInsertBabyChange(HTTPRequest $request)
  { 
    // Si le formulaire a été envoyé, on créé un nouveau commentaire avec les valeurs du formulaire
    if ($request->method() == 'POST') {
      $babyChange = new BabyChange([
        'changeType' => $request->postData('changeType')
      ]);
    } else {
      $babyChange = new BabyChange();
    }
    
    $formBuilder = new BabyChangeFormBuilder($babyChange);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('BabyChange'), $request);
    
    if ($formHandler->process()) {
      $this->app->user()->setFlash('Le change a bien été ajouté, merci !');
      $this->app->httpResponse()->redirect(BASE_URL.'/admin/'); 
    } 

    $this->page->addVar('babyChange', $babyChange);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajouter un change');
  }


  /**
   * Méthode permettant d'ajouter une nouvelle sieste (début ou fin de sieste)
   */
  public function executeInsertSleep(HTTPRequest $request)
  { 
    $sleepManager = $this->managers->getManagerOf('Sleep');
    
    // Si bébé est en train de dormir
    if ($sleepManager->isBabySleep()) {
      // On affiche le formulaire de fin de sieste
      $lastSleep = $sleepManager->getSleepsList(0, 1)[0];

      $formBuilder = new EndSleepFormBuilder($lastSleep);
      $formBuilder->build();
  
      $form = $formBuilder->form();
  
      $formHandler = new FormHandler($form, $this->managers->getManagerOf('Sleep'), $request);
      
      if ($formHandler->process()) {
        $this->app->user()->setFlash('L\'heure de réveil a bien été ajoutée, merci !');
        $this->app->httpResponse()->redirect(BASE_URL.'/admin/'); 
      }
      
      $this->page->addVar('title', 'Ajouter l\'heure de réveil de la sieste');  
      $this->page->addVar('form', $form->createView());
        
    } else {
      // Sinon (bébé s'endort juste)
      // On créé un nouveau sommeil (que le formulaire ait été envoyé ou non)  
      $sleep = new Sleep();

      $formBuilder = new StartSleepFormBuilder($sleep);
      $formBuilder->build();

      $form = $formBuilder->form();

      $formHandler = new FormHandler($form, $this->managers->getManagerOf('Sleep'), $request);
      
      if ($formHandler->process()) {
        $this->app->user()->setFlash('Une nouvelle sieste a bien été ajoutée, merci !');
        $this->app->httpResponse()->redirect(BASE_URL.'/admin/'); 
      } 

      $this->page->addVar('title', 'Ajouter une sieste'); 
      $this->page->addVar('form', $form->createView());  
    } 
  }


  public function executeRecapDay(HTTPRequest $request) 
  {
    $this->page->addVar('title', 'Récap du jour');
        
    // On récupère les managers de l'alimentation, du change et du sommeil
    $feedingManager = $this->managers->getManagerOf('Feeding');
    $babyChangeManager = $this->managers->getManagerOf('BabyChange');
    $sleepManager = $this->managers->getManagerOf('Sleep');
    
    // On récupère les dates correspondant à la période d'une journée
    $dates = $this->__createIntervalDates();
    
    $feedings = $feedingManager->getFeedings($dates);
    $babyChanges = $babyChangeManager->getBabyChanges($dates);
    $sleeps = $sleepManager->getSleeps($dates);

    // On récupère le nombre d'alimentations, changes et sommeils du jour
    $feedingsNumber = $feedingManager->countFeedings($dates);
    $babyChangesNumber = $babyChangeManager->countBabyChanges($dates);
    $sleepsNumber = $sleepManager->countSleeps($dates);
  
    //On ajoute les variables des derniers allaitement, change et sommeil à la vue.
    $this->page->addVar('feedings', $feedings);
    $this->page->addVar('babyChanges', $babyChanges);
    $this->page->addVar('sleeps', $sleeps);
    $this->page->addVar('feedingsNumber', $feedingsNumber);
    $this->page->addVar('babyChangesNumber', $babyChangesNumber);
    $this->page->addVar('sleepsNumber', $sleepsNumber);
  }


  /**
   * Méthode permettant de récupérer les deux dates définissant une période de 1 jour
   * @return $dates array Tableau avec la date du jour et la date J+1
   */
  public function __createIntervalDates()
  {
    // Récupération de la date du jour
    $day = date('Y-m-d', time());
    $dateInf = $day.' 00:00:00'; // on formate la date pour qu'elle corresponde à la date inférieure en BDD
    
    $dateSup = date_create_from_format('Y-m-d H:i:s',$dateInf);
    $dateSup = $dateSup->add(new \DateInterval('P1D')); // ajout d'un jour
    $dateSup = date_format($dateSup, 'Y-m-d H:i:s');

    $dates = [
      "dateInf" => $dateInf,
      "dateSup" => $dateSup];
    
    return $dates;
  } 
}