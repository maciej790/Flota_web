<?php

class Person extends DatabaseConnection
{
    public function getUserByLoginAndPassword($login, $password)
    {
        $sql = 'SELECT id, login, imie, nazwisko, mail, rola 
        FROM "Użytkownicy" 
        WHERE login = :login AND password = :password';

        try {
            // Używamy odziedziczonego obiektu PDO, który jest dostępny od razu
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Błąd zapytania: " . $e->getMessage());
        }
    }
}
