# System Zarządzania Treścią - Slim Framework + Twig

Aplikacja webowa zbudowana w architekturze MVC z wykorzystaniem Slim Framework 4 i systemu szablonów Twig.

## Technologie

- **PHP 8.0+**
- **Slim Framework 4** - routing, middleware
- **Twig** - system szablonów
- **PHPMailer** - obsługa emaili
- **JavaScript** - interaktywność
- **Swiper.js** - slider
- **Lightbox2** - galeria zdjęć
- **Leaflet** - mapy interaktywne

## Funkcjonalności

### Strony
- **Strona główna** - karuzela z informacjami
- **Galeria** - zdjęcia z lightbox
- **Pracownicy** - lista kadry z danymi kontaktowymi
- **Kontakt** - formularz z walidacją + mapa
- **Plan zajęć** - dynamiczny plan z transpozycją widoku
- **Szablony UI** - powiadomienia email, tabele

### Dodatkowe
- Architektura MVC (Controllers/Models/Views)
- Walidacja formularzy po stronie serwera
- POST/REDIRECT/GET pattern
- Responsywny design
- Globalne dane kontaktowe (config/data.php)
- Paginacja z wyszukiwarką
- Eksport CSV, drukowanie
- Automatyczne wykrywanie aktualnej lekcji

## Instalacja

```bash
# Klonuj repozytorium
git clone [url]

# Zainstaluj zależności
composer install

# Konfiguracja
cp .env.example .env
# Edytuj .env (SMTP, dane aplikacji)

# Uruchom
php -S localhost:8000 -t public
```

## Struktura

```
├── config/          # Routing, dane globalne
├── public/          # Assets (CSS, JS, biblioteki)
├── src/
│   ├── Controllers/ # Logika biznesowa
│   ├── Models/      # Modele danych
│   └── Services/    # Serwisy (mail)
├── templates/       # Szablony Twig
│   ├── emails/      # Szablony emaili
│   └── ui/          # Komponenty UI
└── vendor/          # Zależności
```

## Wymagania

- PHP 8.2+
- Composer
- mod_rewrite (Apache) lub odpowiednia konfiguracja (Nginx)
- SMTP (opcjonalnie, dla funkcji kontaktu)
