<?php

require_once './dataBase/DatabaseConnection.php';
require_once './users/Person.php';

try {
    // Tworzenie obiektu klasy Person, który dziedziczy po DatabaseConnection
    $person = new Person(); // Połączenie z bazą danych jest nawiązywane automatycznie przez konstruktor

    // Logowanie użytkownika
    $login = 'admin_user';
    $password = 'admin_pass';

    $user = $person->getUserByLoginAndPassword($login, $password);

    if ($user) {
        echo "Zalogowano użytkownika: " . $user['imie'] . " " . $user['nazwisko'];
    } else {
        echo "Nieprawidłowy login lub hasło.";
    }
} catch (Exception $e) {
    echo "Błąd: " . $e->getMessage();
}
