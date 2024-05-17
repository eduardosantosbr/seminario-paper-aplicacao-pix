<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php 
        session_start();
        require 'modulos.php';
        include 'menu.php';
        if ($_SESSION['logado'] == true) {
            header("Location: dashboard.php");
            exit();
        }
    ?>

    <div class="container">
        <h1>Abra sua conta!</h1>
    </div>

</body>

</html>