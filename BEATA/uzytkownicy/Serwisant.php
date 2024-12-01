<?php

require_once "../Baza.php";
require_once "../Osoba.php";

class Pracownik extends Osoba
{
    protected $id_serwisant;
    protected $imie;
    protected $nazwisko;
    protected $pesel;

    function __construct()
    {
        $sql = "SELECT *
                FROM serwisanci
                LEFT JOIN osoby
                ON serwisanci.id_admin = serwisanci.id_osoby";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        $this->id_serwisant = $result['id_admin'];
        $this->imie = $result['imie'];
        $this->nazwisko = $result['nazwisko'];
        $this->pesel = $result['pesel'];
    }

    public function aktualizacja_danych_serwisowych_pojazdu() {}
}
