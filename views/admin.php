<?php
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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Layout</title>
        <link rel="stylesheet" href="dashboard.css">
    </head>

    <body>
        <div class="dashboard">
            <!-- Lewa kolumna -->
            <aside class="sidebar">
                <h2>Menu</h2>
                <ul>
                    <li><a href="#">Dodaj kierownika floty</a></li>
                    <li><a href="#">Edytuj dane kierownika floty</a></li>
                    <li><a href="#">Usuń kierownika floty</a></li>
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



                echo $_SESSION['user']['imie'];
                echo "<br>";
                echo $_SESSION['user']['nazwisko'];
                echo "<br>";
                echo $_SESSION['user']['mail'];
                echo "<br>";
                echo $_SESSION['user']['pesel'];
                echo "<br>";
                echo $_SESSION['user']['rola'];

                ?>
                <form action="" method="get">
                    <input type="submit" name="logout" value="logout" />
                </form>
            </main>

        </div>

    </body>

    </html>






</html>