<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <center>
        <div class="barra-superior">    
            <ul>
                <li><a href="pagina-inicial.php">Home</a></li>
                <?php
                if ($_SESSION['logado'] == true) {
                    echo '
                    <li><a href="lancamentos.php">Lançamentos</a></li>
                    <li><a href="atualizar-cadastro.php">Atualizar dados</a></li>
                    <li><a href="sair.php">Sair</a></li>';
                } else {
                    echo '<li><a href="cadastro.php">Abra sua conta</a></li> 
                          <li><a href="login.php">Acesse sua conta</a></li> ';
                }
                ?>
            </ul>
        </div>
    </center>

</body>

</html>