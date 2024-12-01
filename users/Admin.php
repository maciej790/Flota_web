<?php
require_once "../dataBase/DatabaseConnection.php";
class Admin extends DatabaseConnection
{
    public function getAllManagers()
    {
        $sql = "SELECT * FROM users WHERE rola='kierownik'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $managers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $managers;
    }
}
