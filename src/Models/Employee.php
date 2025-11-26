<?php

namespace App\Models;

class Employee
{
    private array $employees = [];
    
    public function __construct()
    {
        // Przykładowe dane - w prawdziwej aplikacji pobierałbyś z bazy danych
        $this->employees = [
            [
                'id' => 1,
                'name' => 'prof. dr hab. Elżbieta Skorupska-Raczyńska',
                'position' => 'Rektor',
                'department' => 'Uczelnia / Władze AJP',
                'email' => 'rektor@ajp.edu.pl',
                'phone' => '+48 95 721 60 22',
                'photo' => ''
            ],
            [
                'id' => 2,
                'name' => 'dr hab. Jarosław Becker, prof. AJP',
                'position' => 'Dziekan',
                'department' => 'Wydział Techniczny',
                'email' => 'jbecker@ajp.edu.pl',
                'phone' => '+48 95 72 79 536',
                'photo' => ''
            ],
            [
                'id' => 3,
                'name' => 'dr inż. Łukasz Lemieszewski',
                'position' => 'Prodziekan',
                'department' => 'Wydział Techniczny',
                'email' => 'llemieszewski@ajp.edu.pl',
                'phone' => '+48 95 72 79 536',
                'photo' => ''
            ],
            [
                'id' => 4,
                'name' => 'prof. AJP dr hab. Agnieszka Niekrewicz',
                'position' => 'Dziekan',
                'department' => 'Wydział Humanistyczny',
                'email' => 'aniekrewicz@ajp.edu.pl',
                'phone' => '508 266 089',
                'photo' => ''
            ],
            [
                'id' => 5,
                'name' => 'prof. AJP dr hab. Jolanta Gebreselassie',
                'position' => 'Prodziekan',
                'department' => 'Wydział Humanistyczny',
                'email' => 'jgebreselassie@ajp.edu.pl',
                'phone' => '',
                'photo' => ''
            ],
            [
                'id' => 6,
                'name' => 'dr Renata Janicka-Szyszko',
                'position' => 'Kierownik Zakładu Języka Polskiego i Komunikacji Medialnej',
                'department' => 'Wydział Humanistyczny',
                'email' => 'rjanicka-szyszko@ajp.edu.pl',
                'phone' => '',
                'photo' => ''
            ],
            [
                'id' => 7,
                'name' => 'dr Bożena Majewicz',
                'position' => 'Kierownik Zakładu Edukacji',
                'department' => 'Wydział Humanistyczny',
                'email' => 'bmajewicz@ajp.edu.pl',
                'phone' => '',
                'photo' => ''
            ],
            [
                'id' => 8,
                'name' => 'prof. AJP dr hab. Renata Nadobnik',
                'position' => 'Kierownik Zakładu Języków Obcych',
                'department' => 'Wydział Humanistyczny',
                'email' => 'rnadobnik@ajp.edu.pl',
                'phone' => '',
                'photo' => ''
            ],
            [
                'id' => 9,
                'name' => 'prof. AJP dr hab. Arkadiusz Wołoszyn',
                'position' => 'Kierownik Zakładu Turystyki i Wychowania Fizycznego',
                'department' => 'Wydział Humanistyczny',
                'email' => 'awoloszyn@ajp.edu.pl',
                'phone' => '',
                'photo' => ''
            ]
        ];

    }
    
    public function getAll(): array
    {
        return $this->employees;
    }
    
    public function getById(int $id): ?array
    {
        foreach ($this->employees as $employee) {
            if ($employee['id'] === $id) {
                return $employee;
            }
        }
        return null;
    }
    
    public function getByDepartment(string $department): array
    {
        return array_filter($this->employees, function($employee) use ($department) {
            return $employee['department'] === $department;
        });
    }
}