<?php
namespace App\Backoffice\Modules\Weather;

use OCFram\BackController;
use OCFram\Config;
use OCFram\HTTPRequest;
use Model\WeatherManager;


class WeatherController extends BackController
{
    public function executeWeatherIndex(HTTPRequest $request) 
  {
    $departements = $this->__getDepartements();
     
    $this->page->addVar('title', 'Météo');
    $this->page->addVar('departements', $departements);

    // Si on a choisi un département
    if ($request->method() == 'POST') {
      $this->app->httpResponse()->redirect(BASE_URL.'/admin/forecasts.html'); 
    }
  }

  public function executeForecasts()
  {
    $departement = $_POST['departement'];

    $weatherManager = new WeatherManager;
    $config = new Config($this->app());
    $weatherToken = $config->get('weather_token');
    
    switch ($departement) {
      case '13':
        $cp = '13100';
        break;
      case '2A':
        $cp = '20000';
        break;
      case '2B':
        $cp = '20200';
        break;
      case '75':
        $insee = '75107'; // bug pour Paris avec le cp (ajout du numéro insee directement)
        break;
      default :
        $cp = $departement.'000';
    }

    if (empty($insee)) {
      $insee = $weatherManager->getInsee($cp);
    }
    
    $forecasts = $weatherManager->getForecasts($weatherToken, $insee);

    $weather = $weatherManager->getWeatherDescription($forecasts->weather);
    $iconClass = $weatherManager->getWeatherIconClass($forecasts->weather);
    $tmin = $forecasts->tmin;
    $tmax = $forecasts->tmax;
    
    $this->page->addVar('weather', $weather);
    $this->page->addVar('tmin', $tmin);
    $this->page->addVar('tmax', $tmax);
    $this->page->addVar('iconClass', $iconClass);
  }

  /**
   * Méthode permettant de récupérer un tableau avec les départements français
   * @return Array $departements Les départements français
   */
  public function __getDepartements()
  {
    $departements = array(); 

    $departements['01'] = 'Ain'; 
    $departements['02'] = 'Aisne'; 
    $departements['03'] = 'Allier'; 
    $departements['04'] = 'Alpes de Haute Provence'; 
    $departements['05'] = 'Hautes Alpes'; 
    $departements['06'] = 'Alpes Maritimes'; 
    $departements['07'] = 'Ardèche'; 
    $departements['08'] = 'Ardennes'; 
    $departements['09'] = 'Ariège'; 
    $departements['10'] = 'Aube'; 
    $departements['11'] = 'Aude'; 
    $departements['12'] = 'Aveyron'; 
    $departements['13'] = 'Bouches du Rhône'; 
    $departements['14'] = 'Calvados'; 
    $departements['15'] = 'Cantal'; 
    $departements['16'] = 'Charente'; 
    $departements['17'] = 'Charente Maritime'; 
    $departements['18'] = 'Cher'; 
    $departements['19'] = 'Corrèze'; 
    $departements['2A'] = 'Corse du Sud'; 
    $departements['2B'] = 'Haute Corse'; 
    $departements['21'] = 'Côte d\'Or'; 
    $departements['22'] = 'Côtes d\'Armor'; 
    $departements['23'] = 'Creuse'; 
    $departements['24'] = 'Dordogne'; 
    $departements['25'] = 'Doubs';
    $departements['26'] = 'Drôme'; 
    $departements['27'] = 'Eure'; 
    $departements['28'] = 'Eure et Loir'; 
    $departements['29'] = 'Finistère'; 
    $departements['30'] = 'Gard'; 
    $departements['31'] = 'Haute Garonne'; 
    $departements['32'] = 'Gers'; 
    $departements['33'] = 'Gironde'; 
    $departements['34'] = 'Hérault'; 
    $departements['35'] = 'Ille et Vilaine'; 
    $departements['36'] = 'Indre'; 
    $departements['37'] = 'Indre et Loire'; 
    $departements['38'] = 'Isère'; 
    $departements['39'] = 'Jura'; 
    $departements['40'] = 'Landes'; 
    $departements['41'] = 'Loir et Cher'; 
    $departements['42'] = 'Loire'; 
    $departements['43'] = 'Haute Loire'; 
    $departements['44'] = 'Loire Atlantique'; 
    $departements['45'] = 'Loiret'; 
    $departements['46'] = 'Lot'; 
    $departements['47'] = 'Lot et Garonne'; 
    $departements['48'] = 'Lozère'; 
    $departements['49'] = 'Maine et Loire'; 
    $departements['50'] = 'Manche'; 
    $departements['51'] = 'Marne'; 
    $departements['52'] = 'Haute Marne'; 
    $departements['53'] = 'Mayenne'; 
    $departements['54'] = 'Meurthe et Moselle'; 
    $departements['55'] = 'Meuse'; 
    $departements['56'] = 'Morbihan'; 
    $departements['57'] = 'Moselle'; 
    $departements['58'] = 'Nièvre'; 
    $departements['59'] = 'Nord'; 
    $departements['60'] = 'Oise'; 
    $departements['61'] = 'Orne'; 
    $departements['62'] = 'Pas de Calais'; 
    $departements['63'] = 'Puy de Dôme'; 
    $departements['64'] = 'Pyrénées Atlantiques'; 
    $departements['65'] = 'Hautes Pyrénées'; 
    $departements['66'] = 'Pyrénées Orientales'; 
    $departements['67'] = 'Bas Rhin'; 
    $departements['68'] = 'Haut Rhin'; 
    $departements['69'] = 'Rhône-Alpes'; 
    $departements['70'] = 'Haute Saône'; 
    $departements['71'] = 'Saône et Loire'; 
    $departements['72'] = 'Sarthe'; 
    $departements['73'] = 'Savoie'; 
    $departements['74'] = 'Haute Savoie'; 
    $departements['75'] = 'Paris'; 
    $departements['76'] = 'Seine Maritime'; 
    $departements['77'] = 'Seine et Marne'; 
    $departements['78'] = 'Yvelines'; 
    $departements['79'] = 'Deux Sèvres'; 
    $departements['80'] = 'Somme'; 
    $departements['81'] = 'Tarn'; 
    $departements['82'] = 'Tarn et Garonne'; 
    $departements['83'] = 'Var'; 
    $departements['84'] = 'Vaucluse'; 
    $departements['85'] = 'Vendée'; 
    $departements['86'] = 'Vienne'; 
    $departements['87'] = 'Haute Vienne'; 
    $departements['88'] = 'Vosges'; 
    $departements['89'] = 'Yonne'; 
    $departements['90'] = 'Territoire de Belfort'; 
    $departements['91'] = 'Essonne'; 
    $departements['92'] = 'Hauts de Seine'; 
    $departements['93'] = 'Seine St Denis'; 
    $departements['94'] = 'Val de Marne'; 
    $departements['95'] = 'Val d\'Oise'; 
    
    return $departements;
  }
}