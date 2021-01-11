<?php
namespace Model;

class WeatherManager
{
    /**
     * Méthode permettant de récupérer les prévisions météo du jour pour une ville donnée via l'API MétéoConcept
     * @param $token Le token de l'API MétéConcept
     * @param $insee N°insee de la ville
     * @return $forecasts Prévisions météo
     */
    public function getForecasts($token, $insee)
    {
        $data = file_get_contents('https://api.meteo-concept.com/api/forecast/daily/0?token='.$token.'&insee='.$insee);

        if ($data !== false) {      
            $decoded = json_decode($data);
        } 
        
        return $decoded->forecast;
    }

    /**
     * Méthode permettant de récupérer le n°insee d'une ville à partir de son code postal
     * @param $cp Code postal
     * @return $insee Numéro insee correspondant
     */
    public function getInsee($cp)
    {
        $data = file_get_contents('https://geo.api.gouv.fr/communes?codePostal='.$cp);
        
        if ($data !== false) {
            $decoded = json_decode($data);
            $insee = $decoded[0]->code;
        }

        return $insee;
    }      

    /**
     * Méthode permettant de récupérer la description du temps à partir de son code
     * @param $code Code du temps
     * @return $description Description du temps
     */
    public function getWeatherDescription($code)
    {
        $weatherDescriptions = [
            0 => 'Soleil',
            1 => 'Peu nuageux', 
            2 => 'Ciel voilé',
            3 => 'Nuageux',
            4 => 'Très nuageux',
            5 => 'Couvert',
            6 => 'Brouillard',
            7 => 'Brouillard givrant',
            10 => 'Pluie faible',
            11 => 'Pluie modérée',
            12 => 'Pluie forte',
            13 => 'Pluie faible verglaçante',
            14 => 'Pluie modérée verglaçante',
            15 => 'Pluie forte verglaçante',
            16 => 'Bruine',
            20 => 'Neige faible',
            21 => 'Neige modérée',
            22 => 'Neige forte',
            30 => 'Pluie et neige mêlées faibles',
            31 => 'Pluie et neige mêlées modérées',
            32 => 'Pluie et neige mêlées fortes',
            40 => 'Averses de pluie locales et faibles',
            41 => 'Averses de pluie locales',
            42 => 'Averses locales et fortes',
            43 => 'Averses de pluie faibles',
            44 => 'Averses de pluie',
            45 => 'Averses de pluie fortes',
            46 => 'Averses de pluie faibles et fréquentes',
            47 => 'Averses de pluie fréquentes',
            48 => 'Averses de pluie fortes et fréquentes',
            60 => 'Averses de neige localisées et faibles',
            61 => 'Averses de neige localisées',
            62 => 'Averses de neige localisées et fortes',
            63 => 'Averses de neige faibles',
            64 => 'Averses de neige',
            65 => 'Averses de neige fortes',
            66 => 'Averses de neige faibles et fréquentes',
            67 => 'Averses de neige fréquentes',
            68 => 'Averses de neige fortes et fréquentes',
            70 => 'Averses de pluie et neige mêlées localisées et faibles',
            71 => 'Averses de pluie et neige mêlées localisées',
            72 => 'Averses de pluie et neige mêlées localisées et fortes',
            73 => 'Averses de pluie et neige mêlées faibles',
            74 => 'Averses de pluie et neige mêlées',
            75 => 'Averses de pluie et neige mêlées fortes',
            76 => 'Averses de pluie et neige mêlées faibles et nombreuses',
            77 => 'Averses de pluie et neige mêlées fréquentes',
            78 => 'Averses de pluie et neige mêlées fortes et fréquentes',
            100 => 'Orages faibles et locaux',
            101 => 'Orages locaux',
            102 => 'Orages fort et locaux',
            103 => 'Orages faibles',
            104 => 'Orages',
            105 => 'Orages forts',
            106 => 'Orages faibles et fréquents',
            107 => 'Orages fréquents',
            108 => 'Orages forts et fréquents',
            120 => 'Orages faibles et locaux de neige ou grésil',
            121 => 'Orages locaux de neige ou grésil',
            122 => 'Orages locaux de neige ou grésil',
            123 => 'Orages faibles de neige ou grésil',
            124 => 'Orages de neige ou grésil',
            125 => 'Orages de neige ou grésil',
            126 => 'Orages faibles et fréquents de neige ou grésil',
            127 => 'Orages fréquents de neige ou grésil',
            128 => 'Orages fréquents de neige ou grésil',
            130 => 'Orages faibles et locaux de pluie et neige mêlées ou grésil',
            131 => 'Orages locaux de pluie et neige mêlées ou grésil',
            132 => 'Orages fort et locaux de pluie et neige mêlées ou grésil',
            133 => 'Orages faibles de pluie et neige mêlées ou grésil',
            134 => 'Orages de pluie et neige mêlées ou grésil',
            135 => 'Orages forts de pluie et neige mêlées ou grésil',
            136 => 'Orages faibles et fréquents de pluie et neige mêlées ou grésil',
            137 => 'Orages fréquents de pluie et neige mêlées ou grésil',
            138 => 'Orages forts et fréquents de pluie et neige mêlées ou grésil',
            140 => 'Pluies orageuses',
            141 => 'Pluie et neige mêlées à caractère orageux',
            142 => 'Neige à caractère orageux',
            210 => 'Pluie faible intermittente',
            211 => 'Pluie modérée intermittente',
            212 => 'Pluie forte intermittente',
            220 => 'Neige faible intermittente',
            221 => 'Neige modérée intermittente',
            222 => 'Neige forte intermittente',
            230 => 'Pluie et neige mêlées',
            231 => 'Pluie et neige mêlées',
            232 => 'Pluie et neige mêlées',
            235 => 'Averses de grêle',
        ];

        return $weatherDescriptions[$code];
    }

    /**
     * Méthode permettant de récupérer la classe CSS de l'icône du temps à partir de son code
     * @param $code Code du temps
     * @return $iconClass La classe CSS de l'icône du temps
     */
    public function getWeatherIconClass($code)
    {
        switch ($code) {
            case 0:
                return $iconClass ='wi-day-sunny';
                break;
            case 1:
            case 5:
                return $iconClass = 'wi-day-sunny-overcast';
                break;
            case 2:
                return $iconClass = 'wi-day-haze';
                break;
            case 3:
                return $iconClass = 'wi-day-cloudy';
                break;
            case 4:
                return $iconClass = 'wi-day-cloudy-high';
                break;
            case 6:
            case 7:
                return $iconClass = 'wi-day-fog';
                break;
            case 10:
            case 11:
            case 13:
            case 14:
            case 16:
            case 40:
            case 41:
            case 43:
            case 44:
            case 46:
            case 47:
            case 210:
            case 211:
                return $iconClass = 'wi-day-showers';
                break;
            case 12:
            case 15:
            case 42:
            case 45:
            case 48:
            case 212:
                return $iconClass = 'wi-day-rain';
                break;
            case 20:
            case 21:
            case 22:
            case 60:
            case 61:
            case 62:
            case 63:
            case 64:
            case 65:
            case 66:
            case 67:
            case 68:
            case 220:
            case 221:
            case 222:
                return $iconClass = 'wi-day-snow';
                break;
            case 30:
            case 31:
            case 32:
            case 70:
            case 71:
            case 72:
            case 73:
            case 74:
            case 75:
            case 76:
            case 77:
            case 78:
            case 230:
            case 231:
            case 232:
                return $iconClass = 'wi-day-sleet';
                break;
            case 100:
            case 103:
            case 106:
                return $iconClass = 'wi-day-lightning';
                break;
            case 101:
            case 102:
            case 104:
            case 105:
            case 107:
            case 108:
                return $iconClass = 'wi-day-thunderstorm';
                break;
            case 120:
            case 121:
            case 122:
            case 123:
            case 124:
            case 125:
            case 126:
            case 127:
            case 128:
            case 142:
                return $iconClass = 'wi-day-snow-thunderstorm';
                break;
            case 130:
            case 131:
            case 132:
            case 133:
            case 134:
            case 135:
            case 136:
            case 137:
            case 138:
            case 141:
                return $iconClass = 'wi-day-sleet-storm';
                break;
            case 140:
                return $iconClass = 'wi-day-storm-showers';
                break;
            case 235:
                return $iconClass = ' wi-day-hail';
                break;
            default:
                return $iconClass = '';
        };
    }
}