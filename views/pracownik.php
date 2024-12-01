<?php
session_start();
if (!isset($_SESSION['user']) or $_SESSION['user']['rola'] !== 'pracownik') {
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
</head>

<body>
    <h1>Panel pracownika</h1>
    <form action="" method="get">
        <input type="submit" name="logout" value="logout" />
    </form>
</body>

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

</html>