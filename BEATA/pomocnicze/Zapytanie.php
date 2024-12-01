<?php

require_once "../Osoba.php";

class Zapytanie extends Osoba
{
    protected $id_zapytanie;
    protected $data_poczatku;
    protected $Okres;
    protected $Uzasadnienie;
    protected $Decyzja;

    public function Zgloszenie_zapytania() {}

    public function Rozpatrzenie_zapytania() {}
}
