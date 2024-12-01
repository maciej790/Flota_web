<?php

require_once "../Baza.php";
require_once "../Osoba.php";

class Administrator extends Osoba
{
    protected $id_admin;
    protected $imie;
    protected $nazwisko;
    protected $pesel;

    function __construct()
    {
        $sql = "SELECT *
                FROM administratorzy
                LEFT JOIN osoby
                ON administratorzy.id_admin = osoby.id_osoby";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        $this->id_admin = $result['id_admin'];
        $this->imie = $result['imie'];
        $this->nazwisko = $result['nazwisko'];
        $this->pesel = $result['pesel'];
    }

    public function dodanie_kierownika_floty($login, $haslo, $imie, $nazwisko, $pesel)
    {
        $sql = "INSERT INTO osoby.administratorzy VALUES($login, $haslo, $imie, $nazwisko, $pesel)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    public function edycja_danych_kierownika_floty($id, $login, $haslo, $imie, $nazwisko, $pesel)
    {
        $sql = "UPDATE SET osoby.administratorzy login=$login, haslo=$haslo, imie=$imie, nazwisko=$nazwisko, pese=$pesel WHERE id=$id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    public function usuniecie_kierownika_floty($id)
    {
        $sql = "DELETE * FROM osoby.administratorzy WHERE id=$id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
}
