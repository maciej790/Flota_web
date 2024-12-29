<?php
require_once "../dataBase/DatabaseConnection.php";

class Employer extends DatabaseConnection
{

    public function getAssigments()
    {
        $id = $_SESSION['user']['id_osoby'];

        $sql = "
            SELECT w.*, p.marka, p.model 
            FROM wypozyczenia w 
            JOIN pojazdy p ON w.id_pojazdu = p.id_pojazdu 
            WHERE w.id_osoby = '$id';
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $assigments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $assigments;
    }

    public function getAvalibleCars()
    {
        $sql = "SELECT * FROM pojazdy WHERE status='dostępny';";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $avalibleCars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $avalibleCars;
    }

    function sendRequest($poczatek, $koniec, $uzasadnienie, $id_pojazdu)
    {
        $sql = "INSERT INTO public.zapytania (
	id_osoby, id_pojazdu, data_poczatek, data_koniec, uzasadnienie) VALUES (:id_osoby, :id_pojazdu, :data_poczatek, :data_koniec, :uzasadnienie)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_osoby' => $_SESSION['user']['id_osoby'],
            ':id_pojazdu' => $id_pojazdu,
            ':data_poczatek' => $poczatek,
            ':data_koniec' => $koniec,
            ':uzasadnienie' => $uzasadnienie,
        ]);
    }
}
