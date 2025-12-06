### MVP SaaS System - TODO Lista z terminami i szczegółami

---

## 1. Autoryzacja i użytkownicy (1-2 tygodnie)
- [ ] **Rejestracja użytkownika (email, hasło)** - 2 dni
  - Formularz rejestracji
  - Walidacja podstawowa (required, email format, hasło min 8 znaków)
  - Obsługa błędów walidacji w widoku
- [ ] **Walidacja danych (validator)** - 1 dzień
  - Klasa Validator z regułami
  - Integracja z modelem User
- [ ] **Sprawdzenie, czy email istnieje (User::exists)** - 0.5 dnia
  - Zapytanie do bazy danych
  - Obsługa zwracająca boolean
- [ ] **Hashowanie hasła (password_hash)** - 0.5 dnia
- [ ] **Potwierdzenie email (link aktywacyjny)** - 1 dzień
  - Generowanie tokenu aktywacyjnego
  - Wysyłanie maila z linkiem
  - Aktywacja konta po kliknięciu
- [ ] **Logowanie (password_verify + sesja / token)** - 1 dzień
- [ ] **Wylogowanie (logout)** - 0.5 dnia

## 2. Profile i firmy (1-2 tygodnie)
- [ ] **Profil użytkownika** - 2 dni
  - Edycja danych, zmiana hasła
- [ ] **Zakładanie firmy / zasobu** - 2 dni
  - Formularz zakładania firmy
  - Dane: nazwa, logo, godziny pracy
- [ ] **Zarządzanie zasobami** - 3 dni
  - Dodawanie/edycja pracowników, stanowisk, sprzętu
  - Przypisanie do firmy
- [ ] **Zarządzanie usługami** - 3 dni
  - Dodawanie/edycja usług: nazwa, czas, cena
  - Przypisywanie usług do zasobów
- [ ] **Przypisywanie usług do zasobów** - 1 dzień

## 3. Rezerwacje / Bookingi (2-3 tygodnie)
- [ ] **Tworzenie rezerwacji** - 2 dni
  - Formularz rezerwacji: wybór zasobu i usług
- [ ] **Automatyczne dopasowanie do wolnego slotu** - 3 dni
  - Algorytm sprawdzający dostępność zasobu
  - Obliczanie końca rezerwacji na podstawie czasu usług
- [ ] **Sprawdzenie kolizji w kalendarzu** - 2 dni
- [ ] **Podgląd rezerwacji** - 2 dni
  - Widok dzienny / tygodniowy
  - Kolorowanie bloków według statusu / zasobu
- [ ] **Zmiana / anulowanie rezerwacji** - 2 dni
  - Możliwość przesunięcia terminu
  - Aktualizacja kalendarza i powiadomień
- [ ] **Powiadomienia mailowe przy zmianach** - 2 dni

## 4. Validator i reguły (1 tydzień)
- [ ] **Validator ogólny** - 2 dni
  - Reguły: required, email, minLength, maxLength
- [ ] **Własne reguły** - 2 dni
  - Unikalny email, minimalna długość hasła
- [ ] **Integracja validatora z modelem** - 1 dzień

## 5. Mailingi (1 tydzień)
- [ ] **Wysyłanie maili** - 2 dni
  - Klasa Mailer do wysyłki maili
  - Obsługa linków aktywacyjnych i powiadomień
- [ ] **Szablony maili (HTML + tekst)** - 3 dni
  - Osobny folder z szablonami
  - Integracja z klasą Mailer

## 6. Widoki / Frontend (1-2 tygodnie)
- [ ] **Responsywne widoki** - 3 dni
  - Layout, CSS, podstawowy szablon
- [ ] **Formularze: rejestracja, logowanie, profil, firma, rezerwacje** - 3 dni
  - Walidacja po stronie frontu (opcjonalnie) + wyświetlanie błędów
- [ ] **Widok błędów (404, database error, validation errors)** - 1 dzień
- [ ] **Dashboard użytkownika** - 2 dni
  - Wyświetlanie rezerwacji, zasobów, usług, powiadomień

## 7. Backend / Core (1-2 tygodnie)
- [ ] **Klasa Database dziedzicząca po PDO + własny handler błędów** - 2 dni
- [ ] **Metody Database: fetchRow, fetchColumn, queryWithParams** - 1 dzień
- [ ] **Modele: User, Booking, Resource, Service** - 3 dni
  - CRUD i logika biznesowa
- [ ] **Kontrolery: AuthController, BookingController, ResourceController** - 3 dni
  - Obsługa żądań i integracja z widokami
- [ ] **Widoki: klasa View do renderowania szablonów** - 1 dzień
- [ ] **Autoloading klas (spl_autoload_register)** - 1 dzień

## 8. Inne funkcje MVP (1 tydzień)
- [ ] **Konfiguracja czasu pracy firmy / zasobów** - 2 dni
  - Godziny otwarcia, przerwy, dni wolne
- [ ] **Prosty system powiadomień mailowych** - 2 dni
- [ ] **Bezpieczeństwo: hash haseł, przygotowane zapytania SQL, sesje/tokeny** - 2 dni
- [ ] **Opcjonalnie: panel admina dla wszystkich firm, płatności / subskrypcje w kolejnej fazie** - 1 dzień

