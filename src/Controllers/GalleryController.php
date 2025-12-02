<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GalleryController
{
    public function index(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        $photos = [
            [
                'thumb' => 'https://lokeshdhakar.com/projects/lightbox2/images/thumb-1.jpg',
                'full' => 'https://lokeshdhakar.com/projects/lightbox2/images/image-1.jpg',
                'title' => 'Budynek główny AJP'
            ],
            [
                'thumb' => 'https://lokeshdhakar.com/projects/lightbox2/images/thumb-2.jpg',
                'full' => 'https://lokeshdhakar.com/projects/lightbox2/images/image-2.jpg',
                'title' => 'Sala wykładowa'
            ],
            [
                'thumb' => 'https://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg',
                'full' => 'https://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg',
                'title' => 'Biblioteka'
            ],
            [
                'thumb' => 'https://lokeshdhakar.com/projects/lightbox2/images/thumb-4.jpg',
                'full' => 'https://lokeshdhakar.com/projects/lightbox2/images/image-4.jpg',
                'title' => 'Laboratorium komputerowe'
            ],
            [
                'thumb' => 'https://lokeshdhakar.com/projects/lightbox2/images/thumb-5.jpg',
                'full' => 'https://lokeshdhakar.com/projects/lightbox2/images/image-5.jpg',
                'title' => 'Aula'
            ],
            [
                'thumb' => 'https://lokeshdhakar.com/projects/lightbox2/images/thumb-6.jpg',
                'full' => 'https://lokeshdhakar.com/projects/lightbox2/images/image-6.jpg',
                'title' => 'Kampus'
            ]
        ];

        return $view->render($response, 'gallery.twig', [
            'page_title' => 'Galeria zdjęć',
            'photos' => $photos
        ]);
    }
}
