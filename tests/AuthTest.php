<?php

// Ręczne załadowanie klas
require_once __DIR__ . '/../dataBase/dataBaseConnection.php'; // Załaduj połączenie z bazą danych
require_once __DIR__ . '/../users/User.php'; // Załaduj klasę User

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $user;
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class); // Mockowanie PDO
        $this->user = new User($this->pdo); // Tworzenie instancji klasy User
    }

    public function testSignIn_SuccessfulLogin()
    {
        $mockData = [
            'id' => 1,
            'login' => 'user1',
            'password' => 'hashed_password',
            'rola' => 'admin'
        ];

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetch')->willReturn($mockData);

        $this->pdo->method('prepare')->willReturn($stmt);

        $this->user->signIn('user1', 'password');

        $this->assertEquals($mockData, $this->user->userData);
        $this->assertTrue(isset($_SESSION['user']));
    }

    public function testSignIn_FailedLogin()
    {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetch')->willReturn(false);

        $this->pdo->method('prepare')->willReturn($stmt);

        $this->user->signIn('user1', 'wrongpassword');
        $this->assertNull($this->user->userData);
        $this->assertNull($_SESSION['user'] ?? null);
    }

    public function testSignIn_ThrowsExceptionOnDatabaseError()
    {
        $this->expectException(Exception::class);

        $this->pdo->method('prepare')->willThrowException(new PDOException('Database error'));

        $this->user->signIn('user1', 'password');
    }
}
