<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class ScheduleController
{
    /**
     * Wyświetl plan zajęć
     */
    public function index(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        // 1. Tablica godzin lekcyjnych
        $hours = [
            ['nr' => 1, 'start' => '7:50', 'end' => '8:35'],
            ['nr' => 2, 'start' => '8:40', 'end' => '9:25'],
            ['nr' => 3, 'start' => '9:35', 'end' => '10:20'],
            ['nr' => 4, 'start' => '10:25', 'end' => '11:10'],
            ['nr' => 5, 'start' => '11:25', 'end' => '12:10'],
            ['nr' => 6, 'start' => '12:15', 'end' => '13:00'],
            ['nr' => 7, 'start' => '13:05', 'end' => '13:50'],
            ['nr' => 8, 'start' => '14:00', 'end' => '14:45'],
            ['nr' => 9, 'start' => '14:50', 'end' => '15:35']
        ];

        // 2. Tablica nagłówków dni
        $days = [
            ['id' => 'pn', 'full' => 'Poniedziałek', 'short' => 'PN'],
            ['id' => 'wt', 'full' => 'Wtorek', 'short' => 'WT'],
            ['id' => 'sr', 'full' => 'Środa', 'short' => 'ŚR'],
            ['id' => 'cz', 'full' => 'Czwartek', 'short' => 'CZ'],
            ['id' => 'pt', 'full' => 'Piątek', 'short' => 'PT']
        ];

        // 3. Tablica zajęć
        $schedule = [
            'pn' => [
                null,
                null,
                ['subject' => 'AI', 'class' => '2tf', 'room' => 'gp'],
                ['subject' => 'TiDA', 'class' => '4pt5', 'room' => ''],
                null,
                ['subject' => 'WI', 'class' => '3tr', 'room' => 'g2'],
                ['subject' => 'AI', 'class' => '4pt5', 'room' => 'g1'],
                ['subject' => 'AI', 'class' => '4pt5', 'room' => 'g1'],
                null
            ],
            'wt' => [
                ['subject' => 'TAI', 'class' => '4dt5', 'room' => 'g1'],
                ['subject' => 'TAI', 'class' => '4dt5', 'room' => 'g1'],
                ['subject' => 'LW', 'class' => '3tr', 'room' => ''],
                ['subject' => 'PG', 'class' => '2tf', 'room' => 'gp'],
                ['subject' => 'TAI', 'class' => '2td', 'room' => 'g2'],
                ['subject' => 'TAI', 'class' => '2tf', 'room' => 'gi'],
                ['subject' => 'AI', 'class' => '2tf', 'room' => 'gp'],
                ['subject' => 'PG', 'class' => '3tp', 'room' => 'g2'],
                null
            ],
            'sr' => [
                ['subject' => 'TiDA', 'class' => '4pt5', 'room' => ''],
                ['subject' => 'CMS', 'class' => '3tr', 'room' => ''],
                ['subject' => 'WI', 'class' => '3tp', 'room' => 'g2'],
                ['subject' => 'PG', 'class' => '2tf', 'room' => 'gp'],
                ['subject' => 'PLSKiA', 'class' => '1td', 'room' => 'g1'],
                ['subject' => 'TiDA', 'class' => '3tp', 'room' => ''],
                null,
                ['subject' => 'CMS', 'class' => '3tp', 'room' => ''],
                ['subject' => 'Konsultacje', 'class' => '', 'room' => '', 'special' => true]
            ],
            'cz' => [
                null,
                ['subject' => 'AMiD', 'class' => '4et5', 'room' => ''],
                ['subject' => 'AMiD', 'class' => '4et5', 'room' => ''],
                ['subject' => 'AD', 'class' => '4pt5', 'room' => ''],
                ['subject' => 'AD', 'class' => '3tr', 'room' => ''],
                ['subject' => 'AD', 'class' => '3tr', 'room' => ''],
                ['subject' => 'TiDA', 'class' => '3tr', 'room' => ''],
                null,
                null
            ],
            'pt' => [
                ['subject' => 'AD', 'class' => '3tp', 'room' => ''],
                ['subject' => 'AD', 'class' => '3tp', 'room' => ''],
                ['subject' => 'TAI', 'class' => '2tf', 'room' => 'gi'],
                ['subject' => 'TAI', 'class' => '1td', 'room' => 'g2'],
                ['subject' => 'TAI', 'class' => '1tf', 'room' => 'gi'],
                ['subject' => 'ZAW', 'class' => '4pt5', 'room' => ''],
                ['subject' => 'ZAW', 'class' => '4pt5', 'room' => ''],
                null,
                null
            ]
        ];

        // Sprawdź aktualny dzień i godzinę
        $currentInfo = $this->getCurrentLessonInfo($hours, $days);

        return $view->render($response, 'schedule.twig', [
            'page_title' => 'Plan zajęć',
            'hours' => $hours,
            'days' => $days,
            'schedule' => $schedule,
            'current_day' => $currentInfo['day'],
            'current_day_name' => $currentInfo['day_name'],
            'current_lesson' => $currentInfo['lesson'],
            'current_time' => $currentInfo['time']
        ]);
    }

    /**
     * Sprawdź aktualny dzień i lekcję
     */
    private function getCurrentLessonInfo(array $hours, array $days): array
    {
        $now = new \DateTime();
        $dayOfWeek = (int)$now->format('N'); // 1=pon, 7=nie
        $currentTime = $now->format('H:i');

        // Mapuj dzień tygodnia na index (0=pon, 4=pią, -1=weekend)
        $currentDayIndex = $dayOfWeek - 1; // 0-6
        if ($currentDayIndex > 4) {
            $currentDayIndex = -1; // Weekend (sobota=5, niedziela=6 → -1)
        }

        // Znajdź aktualną lekcję
        $currentLessonIndex = -1;
        foreach ($hours as $index => $hour) {
            if ($currentTime >= $hour['start'] && $currentTime <= $hour['end']) {
                $currentLessonIndex = $index;
                break;
            }
        }

        return [
            'day' => $currentDayIndex,
            'lesson' => $currentLessonIndex,
            'time' => $currentTime,
            'day_name' => $currentDayIndex >= 0
                ? $days[$currentDayIndex]['full']
                : 'Weekend'
        ];
    }
}
