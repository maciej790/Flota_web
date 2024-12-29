<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['user']['rola'] !== 'serwisant') {
    header("Location: ../index.php");
    exit();
}
?>
<?php
require_once "../users/ServiceManager.php";
$employer = new ServiceManager();
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
                <li><a href="serwisant.php">Lista pojazdów floty</a></li>
            </ul>
        </aside>

        <!-- Górny pasek -->
        <header class="topbar">
            <h1>Panel Serwisanta</h1>
            <form action="" method="get">
                <input type="submit" name="logout" value="logout" />
            </form>
        </header>

        <?php
        if (isset($_GET['logout'])) {
            unset($_SESSION['user']);
            header("Location: ../index.php");
        }
        ?>

        <!-- Obszar roboczy -->
        <main class="content">

        </main>
    </div>

</body>

</html>






</html>