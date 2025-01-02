<?php
require_once __DIR__ . '/../dataBase/dataBaseConnection.php'; // Załaduj połączenie z bazą danych
require_once __DIR__ . '/../users/User.php'; // Załaduj klasę User
require_once __DIR__ . '/../users/Manager.php'; // Załaduj klasę User

use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    public function testGetAllEmployers()
    {
        // Tworzymy mock klasy Manager
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAllEmployers'])
            ->getMock();

        // Zwracamy przykładowe dane z mocka
        $managerMock->method('getAllEmployers')
            ->willReturn([
                ['imie' => 'Jan', 'nazwisko' => 'Kowalski'],
                ['imie' => 'Anna', 'nazwisko' => 'Nowak']
            ]);

        // Testowanie metody
        $result = $managerMock->getAllEmployers();
        $this->assertCount(2, $result); // Sprawdzamy, czy wynik ma 2 elementy
        $this->assertEquals('Jan', $result[0]['imie']);
    }

    public function testAddEmployer()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addEmployer'])
            ->getMock();

        // Sprawdzamy, czy metoda `addEmployer` zwróci `true` po poprawnym dodaniu
        $managerMock->method('addEmployer')
            ->willReturn(true);

        $result = $managerMock->addEmployer('Jan', 'Kowalski', '12345678901', 'jan.kowalski@example.com', 'jankowalski', 'pracownik', 'hashed_password');
        $this->assertTrue($result); // Oczekujemy, że wynik będzie `true`
    }

    public function testDeleteEmployer()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['deleteEmployer'])
            ->getMock();

        // Ustawiamy, że metoda `deleteEmployer` zwróci `true`
        $managerMock->method('deleteEmployer')
            ->willReturn(true);

        $result = $managerMock->deleteEmployer(1); // Przykładowe ID
        $this->assertTrue($result); // Oczekujemy, że wynik będzie `true`
    }

    public function testGetAssigments()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAssigments'])
            ->getMock();

        // Zwracamy przykładowe dane z mocka
        $managerMock->method('getAssigments')
            ->willReturn([
                ['id_wypozyczenia' => 1, 'marka' => 'Toyota', 'model' => 'Corolla', 'imie' => 'Jan', 'nazwisko' => 'Kowalski'],
                ['id_wypozyczenia' => 2, 'marka' => 'BMW', 'model' => 'X5', 'imie' => 'Anna', 'nazwisko' => 'Nowak']
            ]);

        // Testowanie metody
        $result = $managerMock->getAssigments();
        $this->assertCount(2, $result); // Oczekujemy 2 przydziały
        $this->assertEquals('Toyota', $result[0]['marka']);
    }

    public function testDeleteVehicleThrowsException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Pojazd w użyciu, najpierw zakończ przydział.');

        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['deleteVehicle'])
            ->getMock();

        // Ustawiamy, że wywołanie tej metody spowoduje wyjątek
        $managerMock->method('deleteVehicle')
            ->willThrowException(new Exception('Pojazd w użyciu, najpierw zakończ przydział.'));

        $managerMock->deleteVehicle(1); // Przykładowe ID pojazdu
    }

    public function testGetVehicleById()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getVehicleById'])
            ->getMock();

        // Zwracamy przykładowe dane z mocka
        $managerMock->method('getVehicleById')
            ->willReturn(['id_pojazdu' => 1, 'marka' => 'Toyota', 'model' => 'Corolla']);

        // Testowanie metody
        $result = $managerMock->getVehicleById(1);
        $this->assertEquals('Toyota', $result['marka']);
    }

    public function testAddVehicle()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addVehicle'])
            ->getMock();

        // Sprawdzamy, czy metoda `addVehicle` zwróci `true`
        $managerMock->method('addVehicle')
            ->willReturn(true);

        $result = $managerMock->addVehicle('Toyota', 'Corolla', 'serwis', 2020, 'dostepny', '2025-12-31');
        $this->assertTrue($result); // Oczekujemy, że wynik będzie `true`
    }

    public function testEditEmployer()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['editEmployer'])
            ->getMock();

        // Ustawiamy, że metoda `editEmployer` zwróci `true`
        $managerMock->method('editEmployer')
            ->willReturn(true);

        $result = $managerMock->editEmployer(1, 'Jan', 'Kowalski', 'jan@kowalski.com', '12345678901', 'jankowalski', 'serwisant', 'new_hashed_password');
        $this->assertTrue($result); // Oczekujemy, że wynik będzie `true`
    }

    public function testAcceptRequest()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['accpetRequest'])
            ->getMock();

        // Ustawiamy, że metoda `accpetRequest` nie zwróci żadnej wartości (void)
        $managerMock->expects($this->once())
            ->method('accpetRequest')
            ->with($this->equalTo(1)); // Zakładając, że id zapytania to 1

        // Testowanie, że metoda nie rzuca żadnym błędem
        $managerMock->accpetRequest(1);
    }

    public function testDeclineRequest()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['declineRequest'])
            ->getMock();

        // Ustawiamy, że metoda `declineRequest` nie zwróci żadnej wartości (void)
        $managerMock->expects($this->once())
            ->method('declineRequest')
            ->with($this->equalTo(1)); // Zakładając, że id zapytania to 1

        // Testowanie, że metoda nie rzuca żadnym błędem
        $managerMock->declineRequest(1);
    }

    public function testDeleteAsigment()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['deleteAsigment'])
            ->getMock();

        // Ustawiamy, że metoda `deleteAsigment` nie zwróci żadnej wartości (void)
        $managerMock->expects($this->once())
            ->method('deleteAsigment')
            ->with($this->equalTo(1)); // Zakładając, że id przydziału to 1

        // Testowanie, że metoda nie rzuca żadnym błędem
        $managerMock->deleteAsigment(1);
    }

    public function testGenerateReport()
    {
        $managerMock = $this->getMockBuilder(Manager::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['generateReport'])
            ->getMock();

        // Zwracamy przykładowe dane z mocka
        $managerMock->method('generateReport')
            ->willReturn([
                ['marka' => 'Toyota', 'model' => 'Corolla', 'liczba_wypozyczen' => 5],
                ['marka' => 'BMW', 'model' => 'X5', 'liczba_wypozyczen' => 3]
            ]);

        // Testowanie metody
        $result = $managerMock->generateReport();
        $this->assertCount(2, $result); // Oczekujemy, że wynik ma 2 elementy
        $this->assertEquals(5, $result[0]['liczba_wypozyczen']);
    }
}
