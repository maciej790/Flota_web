<?php

require_once "Baza.php";

class Osoba extends Baza
{
    protected $id_osoba;
    protected $login;
    protected $haslo;

    function __construct($login, $haslo) // formularz
    {
        $this->login = $login;
        $this->haslo = $haslo;
    }

    public function logowanie()
    {
        $sql = "SELECT * FROM osoby WHERE login = '$this->login' and haslo = '$this->haslo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count != 0) {
            echo "Zalogowany!";
            // tutaj bedzie logika sesji dla zalogowanego usera na podstawie id_osoba
        } else {
            echo "Nie ma takiego uzytkowanika!";
            // tutaj bedzie logika dla wygenerowania wyjatku dla blednych danych logowania
        }
    }
}
