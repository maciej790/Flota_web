<?php
require_once "../users/Admin.php";
$admin = new Admin();
session_start();
if (!isset($_SESSION['user']) or $_SESSION['user']['rola'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin-dashboard.css">
</head>



<body>
    <div class="dashboard">
        <!-- Lewa kolumna -->
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#">Dodaj kierownika floty</a></li>
            </ul>
        </aside>

        <!-- Górny pasek -->
        <header class="topbar">
            <h1>Panel Administratora</h1>
        </header>

        <!-- Obszar roboczy -->
        <main class="content">
            <?php
            if (isset($_GET['logout'])) {
                unset($_SESSION['user']);
                header("Location: ../index.php");
            }

            echo '<table border="1" cellpadding="10" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Imię</th>';
            echo '<th>Nazwisko</th>';
            echo '<th>Login</th>';
            echo '<th>Mail</th>';
            echo '<th>Pesel</th>';
            echo '<th>Akcje</th>'; // Kolumna dla opcji
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $managers = $admin->getAllManagers();

            if (!empty($managers)) {
                foreach ($managers as $manager) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($manager['imie']) . '</td>';
                    echo '<td>' . htmlspecialchars($manager['nazwisko']) . '</td>';
                    echo '<td>' . htmlspecialchars($manager['login']) . '</td>';
                    echo '<td>' . htmlspecialchars($manager['mail']) . '</td>';
                    echo '<td>' . htmlspecialchars($manager['pesel']) . '</td>';
                    echo '<td>';
                    echo '<a href="admin.php?id=' . htmlspecialchars($manager['id']) . '" class="edit">Edytuj</a> | ';
                    echo '<a href="admin.php?id=' . htmlspecialchars($manager['id']) . '" class="delete">Usuń</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">Brak kierowników do wyświetlenia</td></tr>';
            }

            echo '</tbody>';
            echo '</table>';
            ?>
            <form action="" method="get">
                <input type="submit" name="logout" value="logout" />
            </form>
        </main>


    </div>

</body>

</html>






</html>