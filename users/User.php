<?php

class User extends DatabaseConnection
{
    public $userData;
    public $pdo;

    public function __construct($pdo = null)
    {
        // Możliwość wstrzyknięcia PDO dla testów
        $this->pdo = $pdo ?: parent::__construct();
    }

    public function signIn($login, $password)
    {
        $sql = "SELECT * FROM osoby WHERE login = :login AND password = :password";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':login' => $login, ':password' => $password]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                $this->userData = $userData;
                $_SESSION['user'] = $this->userData;

                switch ($this->userData['rola']) {
                    case "admin":
                        header("Location: ./views/admin.php");
                        break;
                    case "kierownik":
                        header("Location: ./views/kierownik.php");
                        break;
                    case "serwisant":
                        header("Location: ./views/serwisant.php");
                        break;
                    case "pracownik":
                        header("Location: ./views/pracownik.php");
                        break;
                }
            } else {
                // echo "Błędny login lub hasło!"; //zakomentowane, bo w testach sie wyswietla ten log
                unset($_SESSION['user']);
            }
        } catch (PDOException $e) {
            throw new Exception("Błąd zapytania: " . $e->getMessage());
        }
    }
}
