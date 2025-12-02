<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Models\ContactForm;
use App\Services\MailService;

class ContactController
{
    public function index(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        // Sprawdź czy jest parametr success w URL
        $queryParams = $request->getQueryParams();
        $success = isset($queryParams['success']) && $queryParams['success'] == '1'
            ? 'Wiadomość została wysłana pomyślnie!'
            : null;

        return $view->render($response, 'contact.twig', [
            'page_title' => 'Kontakt',
            'success' => $success
        ]);
    }

    public function send(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $contactForm = new ContactForm($data);
        $errors = $contactForm->validate();

        if (empty($errors)) {
            $mailService = new MailService();
            $sent = $mailService->sendContactMessage(
                $contactForm->getName(),
                $contactForm->getEmail(),
                $contactForm->getSubject(),
                $contactForm->getMessage()
            );

            if ($sent) {
                // Przekierowanie po udanym wysłaniu (POST/REDIRECT/GET pattern)
                // Parametr success zostanie obsłużony przez GET
                return $response
                    ->withHeader('Location', '/kontakt?success=1')
                    ->withStatus(302);
            } else {
                $errors[] = 'Wystąpił błąd podczas wysyłania wiadomości.';
            }
        }

        // Jeśli są błędy, renderuj formularz z błędami
        $view = Twig::fromRequest($request);
        return $view->render($response, 'contact.twig', [
            'page_title' => 'Kontakt',
            'errors' => $errors,
            'old' => $data
        ]);
    }
}
