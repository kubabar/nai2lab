<?php

namespace App\Models;

class ContactForm
{
    private ?string $name;
    private ?string $email;
    private ?string $subject;
    private ?string $message;
    
    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->subject = $data['subject'] ?? null;
        $this->message = $data['message'] ?? null;
    }
    
    public function validate(): array
    {
        $errors = [];
        
        if (empty($this->name)) {
            $errors[] = 'Imię i nazwisko jest wymagane.';
        } elseif (strlen($this->name) < 3) {
            $errors[] = 'Imię i nazwisko musi mieć co najmniej 3 znaki.';
        }
        
        if (empty($this->email)) {
            $errors[] = 'Adres email jest wymagany.';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Podaj poprawny adres email.';
        }
        
        if (empty($this->subject)) {
            $errors[] = 'Temat wiadomości jest wymagany.';
        } elseif (strlen($this->subject) < 5) {
            $errors[] = 'Temat musi mieć co najmniej 5 znaków.';
        }
        
        if (empty($this->message)) {
            $errors[] = 'Treść wiadomości jest wymagana.';
        } elseif (strlen($this->message) < 10) {
            $errors[] = 'Wiadomość musi mieć co najmniej 10 znaków.';
        }
        
        return $errors;
    }
    
    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function getSubject(): ?string
    {
        return $this->subject;
    }
    
    public function getMessage(): ?string
    {
        return $this->message;
    }
}