<?php

use App\Controllers\HomeController;
use App\Controllers\GalleryController;
use App\Controllers\EmployeesController;
use App\Controllers\ContactController;

// Strona glowna
$app->get('/', [HomeController::class, 'index'])->setName('home');

// Galeria
$app->get('/galeria', [GalleryController::class, 'index'])->setName('gallery');

// Pracownicy
$app->get('/pracownicy', [EmployeesController::class, 'index'])->setName('employees');

// Kontakt
$app->get('/kontakt', [ContactController::class, 'index'])->setName('contact');
$app->post('/kontakt', [ContactController::class, 'send'])->setName('contact.send');
