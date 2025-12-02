<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class UIController
{
    /**
     * Wyświetl szablon powiadomienia email
     */
    public function emailNotification(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        // Przykładowe dane wydarzenia
        $eventData = [
            'event_name' => 'Konferencja Naukowa "Innowacje w Edukacji 2025"',
            'event_date' => 'Piątek, 15 marca 2025, godz. 10:00',
            'event_location' => 'Aula Magna, budynek A, Akademia im. Jakuba z Paradyża',
            'first_name' => 'Jan',
            'last_name' => 'Kowalski'
        ];

        return $view->render($response, 'emails/notification.twig', $eventData);
    }

    /**
     * Wyświetl tabelę osób
     */
    public function peopleTable(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        // Przykładowe dane osób - rozszerzona lista
        $people = [
            [
                'first_name' => 'Jan',
                'last_name' => 'Kowalski',
                'position' => 'Rektor',
                'email' => 'j.kowalski@ajp.edu.pl',
                'badge' => 'rektor',
                'badge_text' => 'Zarząd'
            ],
            [
                'first_name' => 'Anna',
                'last_name' => 'Nowak',
                'position' => 'Prorektor ds. Nauki',
                'email' => 'a.nowak@ajp.edu.pl',
                'badge' => 'prorektor',
                'badge_text' => 'Zarząd'
            ],
            [
                'first_name' => 'Piotr',
                'last_name' => 'Wiśniewski',
                'position' => 'Kierownik Katedry Informatyki',
                'email' => 'p.wisniewski@ajp.edu.pl',
                'badge' => 'kierownik',
                'badge_text' => 'Kierownik'
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Lewandowska',
                'position' => 'Wykładowca',
                'email' => 'm.lewandowska@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Katarzyna',
                'last_name' => 'Kamińska',
                'position' => 'Adiunkt',
                'email' => 'k.kaminska@ajp.edu.pl',
                'badge' => 'adiunkt',
                'badge_text' => 'Adiunkt'
            ],
            [
                'first_name' => 'Tomasz',
                'last_name' => 'Zieliński',
                'position' => 'Wykładowca',
                'email' => 't.zielinski@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Magdalena',
                'last_name' => 'Dąbrowska',
                'position' => 'Asystent',
                'email' => 'm.dabrowska@ajp.edu.pl',
                'badge' => 'asystent',
                'badge_text' => 'Asystent'
            ],
            [
                'first_name' => 'Marek',
                'last_name' => 'Wójcik',
                'position' => 'Wykładowca',
                'email' => 'm.wojcik@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Agnieszka',
                'last_name' => 'Kowalczyk',
                'position' => 'Adiunkt',
                'email' => 'a.kowalczyk@ajp.edu.pl',
                'badge' => 'adiunkt',
                'badge_text' => 'Adiunkt'
            ],
            [
                'first_name' => 'Paweł',
                'last_name' => 'Jankowski',
                'position' => 'Asystent',
                'email' => 'p.jankowski@ajp.edu.pl',
                'badge' => 'asystent',
                'badge_text' => 'Asystent'
            ],
            [
                'first_name' => 'Elżbieta',
                'last_name' => 'Mazur',
                'position' => 'Kierownik Katedry Pedagogiki',
                'email' => 'e.mazur@ajp.edu.pl',
                'badge' => 'kierownik',
                'badge_text' => 'Kierownik'
            ],
            [
                'first_name' => 'Grzegorz',
                'last_name' => 'Krawczyk',
                'position' => 'Wykładowca',
                'email' => 'g.krawczyk@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Joanna',
                'last_name' => 'Piotrowska',
                'position' => 'Adiunkt',
                'email' => 'j.piotrowska@ajp.edu.pl',
                'badge' => 'adiunkt',
                'badge_text' => 'Adiunkt'
            ],
            [
                'first_name' => 'Krzysztof',
                'last_name' => 'Grabowski',
                'position' => 'Wykładowca',
                'email' => 'k.grabowski@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Beata',
                'last_name' => 'Pawlak',
                'position' => 'Asystent',
                'email' => 'b.pawlak@ajp.edu.pl',
                'badge' => 'asystent',
                'badge_text' => 'Asystent'
            ],
            [
                'first_name' => 'Michał',
                'last_name' => 'Michalski',
                'position' => 'Wykładowca',
                'email' => 'm.michalski@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Iwona',
                'last_name' => 'Sikora',
                'position' => 'Adiunkt',
                'email' => 'i.sikora@ajp.edu.pl',
                'badge' => 'adiunkt',
                'badge_text' => 'Adiunkt'
            ],
            [
                'first_name' => 'Andrzej',
                'last_name' => 'Baran',
                'position' => 'Asystent',
                'email' => 'a.baran@ajp.edu.pl',
                'badge' => 'asystent',
                'badge_text' => 'Asystent'
            ],
            [
                'first_name' => 'Dorota',
                'last_name' => 'Rutkowska',
                'position' => 'Wykładowca',
                'email' => 'd.rutkowska@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Marcin',
                'last_name' => 'Lis',
                'position' => 'Kierownik Katedry Ekonomii',
                'email' => 'm.lis@ajp.edu.pl',
                'badge' => 'kierownik',
                'badge_text' => 'Kierownik'
            ],
            [
                'first_name' => 'Monika',
                'last_name' => 'Kubiak',
                'position' => 'Adiunkt',
                'email' => 'm.kubiak@ajp.edu.pl',
                'badge' => 'adiunkt',
                'badge_text' => 'Adiunkt'
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Makowski',
                'position' => 'Wykładowca',
                'email' => 'r.makowski@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Sylwia',
                'last_name' => 'Szczepańska',
                'position' => 'Asystent',
                'email' => 's.szczepanska@ajp.edu.pl',
                'badge' => 'asystent',
                'badge_text' => 'Asystent'
            ],
            [
                'first_name' => 'Jacek',
                'last_name' => 'Urbański',
                'position' => 'Wykładowca',
                'email' => 'j.urbanski@ajp.edu.pl',
                'badge' => 'wykladowca',
                'badge_text' => 'Wykładowca'
            ],
            [
                'first_name' => 'Ewa',
                'last_name' => 'Kucharska',
                'position' => 'Adiunkt',
                'email' => 'e.kucharska@ajp.edu.pl',
                'badge' => 'adiunkt',
                'badge_text' => 'Adiunkt'
            ]
        ];

        return $view->render($response, 'ui/people-table.twig', [
            'page_title' => 'Lista pracowników',
            'table_title' => 'Kadra naukowo-dydaktyczna',
            'table_description' => 'Pełna lista pracowników Akademii im. Jakuba z Paradyża z podziałem na stanowiska',
            'people' => $people
        ]);
    }

    /**
     * Wyświetl przykłady wszystkich szablonów UI
     */
    public function index(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'ui/index.twig', [
            'page_title' => 'Szablony UI'
        ]);
    }
}
