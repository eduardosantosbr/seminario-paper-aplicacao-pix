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

                $dados = $conexao->prepare("SELECT * FROM lancamentos WHERE usuario_id = :id");
                $dados->bindValue(':id', $id, PDO::PARAM_INT);
                $dados->execute();
                $lancamentos = $dados->fetchAll(PDO::FETCH_OBJ);
                foreach ($lancamentos as $lancamento) {
                    $imagem = $lancamento->tipo == 1 ? 'imagens/joinhaPositivo.png' : 'imagens/joinhaNegativo.png';
                    $valor = $lancamento->tipo == 1 ? "R$ " . $lancamento->valor : "R$ " . "-" . $lancamento->valor;

                    echo "
                    <li>
                        <div class='dados'>
                            <div class='dados-descricao'>
                                    <span class='titulo-item-listagem-descricao'>
                                        $lancamento->descricao
                                    </span>
                            </div>
                            <div class='dados-valor'>
                                    <span class='titulo-item-listagem-valor'>
                                        $valor<br><br>
                                    </span>
                            </div>
                            <div class='icone-lista'>
                                    <img src='$imagem' alt=''>
                            </div>
                        </div>
                        <div>
                            $lancamento->dataCriacao
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