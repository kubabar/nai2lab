<?php

/**
 * Plik konfiguracyjny z danymi kontaktowymi i innymi stałymi
 * Dane są dostępne globalnie we wszystkich szablonach Twig
 */

return [
    // Dane kontaktowe uczelni
    'contact' => [
        'name' => 'Akademia im. Jakuba z Paradyża',
        'short_name' => 'AJP Gorzów Wielkopolski',
        'street' => 'ul. Chopina 52',
        'postal_code' => '66-400',
        'city' => 'Gorzów Wielkopolski',
        'phone' => '+48 95 727 95 10',
        'email' => 'rekrutacja@ajp.edu.pl',
        'website' => 'https://www.ajp.edu.pl',
    ],
    
    // Lokalizacja GPS dla mapy
    'location' => [
        'latitude' => 52.7335,
        'longitude' => 15.2266,
        'map_zoom' => 16,
    ],
    
    // Social media
    'social' => [
        'facebook' => 'https://www.facebook.com/ajpgorzow',
        'instagram' => 'https://www.instagram.com/ajpgorzow',
        'youtube' => 'https://www.youtube.com/@akademiaim.jakubazparadyza9666',
    ],
    
    // Godziny pracy
    'office_hours' => [
        'monday_friday' => 'Poniedziałek - Piątek: 8:00 - 15:00',
        'saturday' => 'Sobota: 9:00 - 13:00',
        'sunday' => 'Niedziela: Nieczynne',
    ],
    
    // Dodatkowe dane
    'site' => [
        'title' => 'Akademia im. Jakuba z Paradyża',
        'description' => 'Nowoczesna uczelnia w sercu Gorzowa Wielkopolskiego',
        'copyright_year_start' => 2000,
    ],
];