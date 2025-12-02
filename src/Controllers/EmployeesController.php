<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Models\Employee;

class EmployeesController
{
    public function index(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        $employeeModel = new Employee();
        $employees = $employeeModel->getAll();

        return $view->render($response, 'employees.twig', [
            'page_title' => 'Pracownicy',
            'employees' => $employees
        ]);
    }
}
