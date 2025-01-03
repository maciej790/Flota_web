<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class LoginRoleRedirectCest
{
    // Akcja wykonywana przed każdym testem - przejście na stronę logowania
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php'); // Strona logowania
    }

    // Test: Logowanie jako admin
    public function tryToLoginAsAdmin(AcceptanceTester $I)
    {
        // Wypełnij formularz logowania dla użytkownika admin
        $I->fillField('login', 'admin'); // Użytkownik admin
        $I->fillField('password', 'admin'); // Hasło admina
        $I->click('Sign In'); // Kliknij przycisk "Sign In"

        // Sprawdź, czy użytkownik został przekierowany na stronę admina
        $I->seeInCurrentUrl('/views/admin.php');  // Przekierowanie na stronę admina
    }

    // Test: Logowanie jako kierownik
    public function tryToLoginAsKierownik(AcceptanceTester $I)
    {
        // Wypełnij formularz logowania dla użytkownika kierownika
        $I->fillField('login', 'kierownik'); // Użytkownik kierownik
        $I->fillField('password', 'kierownik'); // Hasło kierownika
        $I->click('Sign In'); // Kliknij przycisk "Sign In"

        // Sprawdź, czy użytkownik został przekierowany na stronę kierownika
        $I->seeInCurrentUrl('/views/kierownik.php');  // Przekierowanie na stronę kierownika
    }

    // Test: Logowanie jako serwisant
    public function tryToLoginAsSerwisant(AcceptanceTester $I)
    {
        // Wypełnij formularz logowania dla użytkownika serwisanta
        $I->fillField('login', 'serwisant'); // Użytkownik serwisant
        $I->fillField('password', 'serwisant'); // Hasło serwisanta
        $I->click('Sign In'); // Kliknij przycisk "Sign In"

        // Sprawdź, czy użytkownik został przekierowany na stronę serwisanta
        $I->seeInCurrentUrl('/views/serwisant.php');  // Przekierowanie na stronę serwisanta
    }

    // Test: Logowanie jako pracownik
    public function tryToLoginAsPracownik(AcceptanceTester $I)
    {
        // Wypełnij formularz logowania dla użytkownika pracownika
        $I->fillField('login', 'pracownik1'); // Użytkownik pracownik
        $I->fillField('password', 'pracownik1'); // Hasło pracownika
        $I->click('Sign In'); // Kliknij przycisk "Sign In"

        // Sprawdź, czy użytkownik został przekierowany na stronę pracownika
        $I->seeInCurrentUrl('/views/pracownik.php');  // Przekierowanie na stronę pracownika
    }

    // Test: Logowanie z błędnym loginem i hasłem
    public function tryToLoginWithInvalidCredentials(AcceptanceTester $I)
    {
        // Wypełnij formularz błędnymi danymi
        $I->fillField('login', 'invaliduser');
        $I->fillField('password', 'invalidpassword');
        $I->click('Sign In');

        // Sprawdź, czy pojawił się komunikat o błędnym loginie
        $I->see('Błędny login lub hasło!');
    }

    public function tryToLoginWithValidCredentials(AcceptanceTester $I)
    {
        // Wypełnij formularz błędnymi danymi
        $I->fillField('login', 'admin');
        $I->fillField('password', 'admin');
        $I->click('Sign In');

        $I->seeInCurrentUrl('/views/admin.php');  // Możesz zmienić na odpowiednią rolę

    }
}
