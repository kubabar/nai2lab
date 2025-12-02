<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class HomeController
{
    public function index(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        $slides = [
            [
                'title' => 'Akademia im. Jakuba z Paradyża',
                'description' => 'Nowoczesna uczelnia w sercu Gorzowa Wielkopolskiego',
                'image' => '/images/slide1.jpg'
            ],
            [
                'title' => 'Kierunki studiów',
                'description' => 'Szeroka oferta programów kształcenia',
                'image' => '/images/slide2.jpg'
            ],
            [
                'title' => 'Życie studenckie',
                'description' => 'Bogata oferta kulturalna i sportowa',
                'image' => '/images/slide3.jpg'
            ],
            [
                'title' => 'Współpraca z biznesem',
                'description' => 'Praktyki i staże w renomowanych firmach',
                'image' => '/images/slide4.jpg'
            ]
        ];

        return $view->render($response, 'home.twig', [
            'page_title' => 'Strona główna',
            'slides' => $slides
        ]);
    }
}
