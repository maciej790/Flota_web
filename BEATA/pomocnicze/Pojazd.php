<?php

require_once "./Wypozyczenie.php";


class Pojazd extends Wypozyczenie
{
    protected $id_pojazd;
    protected $marka;
    protected $model;
    protected $paliwo;
    protected $naped;
    protected $dane_serwisowe;
    protected $status;
    protected $przebieg;
    protected $dane_przegladu;

    public function Dodanie_pojazdu() {}

    public function Usuniecie_pojazdu() {}

    public function Edycja_danych_pojazdu() {}

    public function Edycja_statusu_pojazdu() {}
}
