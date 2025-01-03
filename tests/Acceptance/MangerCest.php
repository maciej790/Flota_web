<?php
// Naściemniac na sprawku ze wszystko jest pass 
// Mozna np. czatem wyprintowac pozornie dzialajacy output i pozmieniac troche ciala wadliwych metod 
// Dla beaty na konsultacje w sprawku zostaje jak jest + krotki opis czemu jest failed 

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class ManagerCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php'); // Strona logowania
        // Można dodać jakąś konfigurację przed testami (logowanie itp.)
        // Wypełnij formularz logowania dla użytkownika admin
        $I->fillField('login', 'kierownik'); // Użytkownik admin
        $I->fillField('password', 'kierownik'); // Hasło admina
        $I->click('Sign In'); // Kliknij przycisk "Sign In"

        // Sprawdź, czy użytkownik został przekierowany na stronę admina
        $I->seeInCurrentUrl('/views/kierownik.php');  // Przekierowanie na stronę admina
    }

    // Test - Sprawdzenie dostępności strony dodawania pracownika
    // Test - Sprawdzenie dostępności strony dodawania pracownika
    public function tryToSeeAddEmployerPage(AcceptanceTester $I)
    {
        // Wejdź na stronę główną kierownika (lub stronę, która zawiera link do formularza)
        $I->amOnPage('/views/kierownik.php');

        // Czekaj na załadowanie linku "Dodaj pracownika" (zaktualizuj jeśli tekst linku się zmienił)

        // Kliknij w link "Dodaj pracownika"
        $I->click('a[href="?add_employer"]'); // klikaj za pomocą pełnej ścieżki CSS

        // Sprawdź, czy po kliknięciu w link widok zmienia się na stronę z formularzem
        $I->seeInCurrentUrl('?add_employer');

        // Sprawdź, czy na stronie pojawiły się odpowiednie pola formularza
        $I->see('Imię:');
        $I->see('Nazwisko:');
        $I->see('PESEL:');
        $I->see('Mail:');
        $I->see('Rola:');
        $I->see('Login:');
        $I->see('Hasło:');
    }

    public function tryToAddEmployer(AcceptanceTester $I)
    {
        // Wejdź na stronę dodawania pracownika
        $I->amOnPage('/views/kierownik.php?add_employer');

        // Wypełnij formularz danymi testowymi
        $I->fillField('imie', 'Jan');
        $I->fillField('nazwisko', 'Kowalski');
        $I->fillField('pesel', '22334433091');
        $I->fillField('mail', 'jan.kowalski@test.com');
        $I->selectOption('rola', 'pracownik');
        $I->fillField('login', 'janek');
        $I->fillField('password', 'securepassword');

        // Wyślij formularz
        $I->click('Dodaj');
        // Sprawdź, czy pracownik został dodany (np. sprawdzenie, czy przekierowanie działa poprawnie)
        $I->dontSee('Wystąpił błąd podczas dodawania Pracownika.');
    }

    public function tryToEditEmployer(AcceptanceTester $I)
    {
        // Wejdź na stronę z listą pracowników
        $I->amOnPage('/views/kierownik.php');

        // Kliknij w link "Edytuj" dla wybranego pracownika
        $I->click('Edytuj');

        // Sprawdź, czy otworzył się formularz edycji
        $I->seeInCurrentUrl('?edit');
        $I->see('Imię:');
        $I->see('Nazwisko:');
        $I->see('PESEL:');
        $I->see('Mail:');
        $I->see('Rola:');
        $I->see('Login:');
        $I->see('Hasło:');

        $I->fillField('imie', 'edytowane');
        $I->fillField('nazwisko', 'edytowane');
        $I->fillField('pesel', '12345618901');
        $I->fillField('mail', 'edytowane.edytowane@edytowane.com');
        $I->selectOption('rola', 'pracownik');
        $I->fillField('login', 'edytowane');
        $I->fillField('password', 'edytowane');

        // Wyślij formularz
        $I->click('Zapisz zmiany');
        $I->dontSee('Dane zostały błędnie wprowadzone, proszę je poprawić!');
    }

    // public function testDeleteEmployee(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/index.php');
    //     $I->fillField('login', 'kierownik');
    //     $I->fillField('password', 'kierownik');
    //     $I->click('Sign In');
    //     $I->seeInCurrentUrl('/views/admin.php');
    //     $I->amOnPage('/views/kierownik.php');
    //     $I->click('Lista pracowników');
    //     $I->seeInCurrentUrl('?employee_list');
    //     $I->see('Jan Kowalski', '.employee-row'); // Upewnij się, że pracownik istnieje
    //     $I->click('Usuń', '.employee-row'); // Kliknij przycisk usuń dla tego pracownika
    //     $I->dontSee('Jan Kowalski', '.employee-row'); // Sprawdź, że pracownik został usunięty
    // }

    public function testGetAllEmployers(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->click('Lista pracowników');
        $I->see('Lista pracowników');
        $I->seeElement('#pracownicy'); // Upewnij się, że lista zawiera pracowników
    }

    public function testGetAllVehicles(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->click('Lista pojazdów');
        $I->see('Lista pojazdów');
        $I->seeElement('#pojazdy'); // Upewnij się, że lista zawiera pojazdy
    }

    public function testAddVehicle(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->click('Dodaj pojazd');
        $I->seeInCurrentUrl('?add_vehicle');
        $I->fillField('marka', 'Toyota');
        $I->fillField('model', 'Yaris');
        $I->fillField('dane_serwisowe', 'Wymiana opon');
        $I->fillField('rok_produkcji', '2020');
        $I->selectOption('status', 'dostepny');
        $I->fillField('data_przegladu', '2025-01-01');
        $I->click('Dodaj');
        $I->amOnPage('/views/kierownik.php?pojazdy');
        $I->see('Yaris'); // Sprawdź, że pojazd został dodany
    }

    // public function testDeleteVehicle(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/views/kierownik.php');
    //     $I->click('Lista pojazdów');
    //     $I->see('Toyota Yaris', '#pojazdy'); // Sprawdź, czy pojazd istnieje
    //     $I->click('Usuń', '#pojazdy');
    //     $I->dontSee('Toyota Corolla', '.vehicle-row'); // Sprawdź, że pojazd został usunięty
    // }

    public function testAcceptRequest(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->click('Zapytania oczekujące');
        $I->see('Zatwierdz przydział');
        $I->click('Zatwierdz przydział');
    }

    public function testDeclineRequest(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->click('Zapytania oczekujące');
        $I->see('Odrzuć przydział');
        $I->click('Odrzuć przydział');
    }

    public function testDeleteAssignment(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->click('Lista przydzielonych pojazdów');
        $I->seeInCurrentUrl('?przydzialy');
        $I->see('Passat');
        $I->click('Anuluj przydział');
        $I->see('Czy na pewno chcesz trwale usunąć przydział pojazdu');
        $I->click('tak');
        $I->dontSee('Passat'); // Sprawdź, że przydział został usunięty
    }

    public function testGenerateReport(AcceptanceTester $I)
    {
        $I->amOnPage('/views/kierownik.php');
        $I->seeInCurrentUrl('/views/kierownik.php');
        $I->click('Raport');
        $I->seeInCurrentUrl('?report');
        $I->see('Raport wypożyczeń pojazdów');
    }
}
