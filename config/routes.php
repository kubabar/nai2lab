<?php

use App\Controllers\HomeController;
use App\Controllers\GalleryController;
use App\Controllers\EmployeesController;
use App\Controllers\ContactController;
use App\Controllers\UIController;
use App\Controllers\ScheduleController;

// Strona główna
$app->get('/', [HomeController::class, 'index'])->setName('home');

// Galeria
$app->get('/galeria', [GalleryController::class, 'index'])->setName('gallery');

// Pracownicy
$app->get('/pracownicy', [EmployeesController::class, 'index'])->setName('employees');

// Kontakt
$app->get('/kontakt', [ContactController::class, 'index'])->setName('contact');
$app->post('/kontakt', [ContactController::class, 'send'])->setName('contact.send');

// Szablony UI
$app->get('/ui', [UIController::class, 'index'])->setName('ui.index');
$app->get('/ui/email-notification', [UIController::class, 'emailNotification'])->setName('ui.email');
$app->get('/ui/people-table', [UIController::class, 'peopleTable'])->setName('ui.people');

// Plan zajęć
$app->get('/plan-zajec', [ScheduleController::class, 'index'])->setName('schedule');

// CKEditor
$app->get('/ckeditor', [UIController::class, 'ckeditor'])->setName('ui.ckeditor');