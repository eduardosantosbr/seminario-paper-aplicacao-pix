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
        if ($_SESSION['logado'] != true) {
            login_necessario();
        }
    ?>

    <div class="container">
        <h1>Seja bem vindo <?php if (isset($_COOKIE['nome'])) { echo $_COOKIE['nome']; }?>!</h1>
    </div>

</body>

</html>