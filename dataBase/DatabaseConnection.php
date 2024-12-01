<?php

class DatabaseConnection
{
    public $pdo;
    public $uri = "postgres://avnadmin:AVNS_nwE4HaCLlsPnTIqF0Xt@pg-31dd3fb6-student-d817.b.aivencloud.com:26836/defaultdb?sslmode=require";

    // Konstruktor inicjujący połączenie z bazą danych
    public function __construct($dbname = "flota")
    {
        $fields = parse_url($this->uri);

        // Tworzenie DSN (Data Source Name)
        $dsn = "pgsql:";
        $dsn .= "host=" . $fields["host"];
        $dsn .= ";port=" . $fields["port"];
        $dsn .= ";dbname=" . $dbname;

        try {
            // Inicjalizujemy połączenie PDO w momencie tworzenia obiektu
            $this->pdo = new PDO($dsn, $fields["user"], $fields["pass"]);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Nie udało się połączyć z bazą danych: " . $e->getMessage());
        }
    }
}
