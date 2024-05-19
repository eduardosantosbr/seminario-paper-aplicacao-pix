<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Cadastrados</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
        session_start();
        require 'modulos.php';
        require 'conexao.php';
        include 'menu.php';
        
        if ($_SESSION['logado'] != true) {
            login_necessario();
        }
    ?>


    <div class="container container-listagem">

        <ul>

            <?php 
            if (isset($_SESSION['idUserLogado'])) {
                $id = $_SESSION['idUserLogado'];


                $dados = $conexao->prepare("SELECT * FROM lancamentos WHERE usuario_id = $id");
                $dados->execute();
                $lancamentos = $dados->fetchAll(PDO::FETCH_OBJ);
                foreach ($lancamentos as $lancamento) {
                    echo "
                    <li>
                        <div class='dados'>
                                <span class='titulo-item-listagem'>
                                    $lancamento->descricao
                                    $lancamento->valor
                                    Tipo: " . ($lancamento->tipo == 1 ? 'Receita' : 'Despesa') . "<br><br><br>
                                    $lancamento->dataCriacao
                                </span>
                        </div>

                        <div class='icone-lista'>
                                <img src='imagens/joinhaPositivo.png' alt=''>
                                
                        </div>

                    </li>";
                }
            } else {
                echo "Ops, não foi encontrado nenhum lançamento.";
                exit;
            }
            ?>

        </ul>

    </div>


</body>

</html>