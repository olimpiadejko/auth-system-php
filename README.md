# System logowania i rejestracji użytkowników (PHP)

Prosta aplikacja webowa umożliwiająca rejestrację i logowanie użytkowników z uwzględnieniem podstawowych zasad bezpieczeństwa.

## Funkcjonalności

- Rejestracja użytkownika
- Logowanie użytkownika
- Haszowanie haseł
- Zarządzanie sesją
- Strona chroniona (dostęp tylko po zalogowaniu)
- Wylogowanie użytkownika

## Technologie

- PHP
- MySQL
- HTML
- CSS

## Bezpieczeństwo

W projekcie zastosowano podstawowe mechanizmy zwiększające bezpieczeństwo:

- Haszowanie haseł przy użyciu `password_hash()`
- Weryfikacja haseł przez `password_verify()`
- Ochrona przed SQL Injection (prepared statements)
- Kontrola dostępu do zasobów przy użyciu sesji


## Cel projektu

Projekt został wykonany w celach edukacyjnych jako część nauki tworzenia aplikacji webowych oraz podstaw cyberbezpieczeństwa.
