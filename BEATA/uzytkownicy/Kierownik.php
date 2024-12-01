<?php

require_once "../Baza.php";
require_once "../Osoba.php";

class Kierownik extends Osoba
{
    protected $id_kierownik;
    protected $imie;
    protected $nazwisko;
    protected $pesel;

    function __construct()
    {
        $sql = "SELECT *
                FROM kierownicy
                LEFT JOIN osoby
                ON kierownicy.id_admin = osoby.id_osoby";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        $this->id_kierownik = $result['id_admin'];
        $this->imie = $result['imie'];
        $this->nazwisko = $result['nazwisko'];
        $this->pesel = $result['pesel'];
    }

    public function dodanie_pracownika($login, $haslo, $imie, $nazwisko, $pesel)
    {
        $sql = "INSERT INTO osoby.pracownicy VALUES($login, $haslo, $imie, $nazwisko, $pesel)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    public function edycja_danych_pracownika($id, $login, $haslo, $imie, $nazwisko, $pesel)
    {
        $sql = "UPDATE osoby.pracownicy SET login=$login, haslo=$haslo, imie=$imie, nazwisko=$nazwisko, pese=$pesel WHERE id=$id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    public function usuniecie_pracownika($id)
    {
        $sql = "DELETE * FROM osoby.pracownicy WHERE id=$id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
}
