<?php

class DatabaseConnection
{
    public $pdo;

    // Konstruktor inicjujący połączenie z bazą danych
    public function __construct()
    {
        // Dane do połączenia z lokalną bazą danych
        $host = "localhost";
        $port = "5432";
        $dbname = "flota_utf8_win1250";
        $user = "postgres";
        $password = "3291282002";

        // Tworzenie DSN (Data Source Name)
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

        try {
            // Inicjalizujemy połączenie PDO w momencie tworzenia obiektu
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Nie udało się połączyć z bazą danych: " . $e->getMessage());
        }
    }
}
