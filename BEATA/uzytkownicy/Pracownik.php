<?php

require_once "../Baza.php";
require_once "../Osoba.php";

class Pracownik extends Osoba
{
    protected $id_pracownik;
    protected $imie;
    protected $nazwisko;
    protected $pesel;

    function __construct()
    {
        $sql = "SELECT *
                FROM pracownicy
                LEFT JOIN osoby
                ON pracownicy.id_admin = pracownicy.id_osoby";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        $this->id_pracownik = $result['id_admin'];
        $this->imie = $result['imie'];
        $this->nazwisko = $result['nazwisko'];
        $this->pesel = $result['pesel'];
    }

    public function podglad_przydzialu() {}
}
