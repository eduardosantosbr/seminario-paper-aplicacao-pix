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
                $dados = $conexao->prepare("SELECT * FROM usuarios");
                $dados->execute();
                $usuarios = $dados->fetchAll(PDO::FETCH_OBJ);
                foreach ($usuarios as $usuario) {
                    echo "
                    <li>
                        <div class='dados'>
                            <a href='atualizar-usuarios.php?id=$usuario->id&nome=$usuario->nome&endereco=$usuario->endereco&telefone=$usuario->telefone&usuario=$usuario->usuario'>
                                <span class='titulo-item-listagem'>
                                    $usuario->nome
                                </span> <br>
                                <div class='descricao-item-listagem'>
                                    <ul>
                                        <li>Telefone: $usuario->telefone</li>
                                        <li>Endereço: $usuario->endereco</li>
                                        <li>Usuário: $usuario->usuario</li>
                                    </ul>

                                </div>
                            </a>
                        </div>

                        <div class='icone-lista'>
                            <a href='excluir.php?id=$usuario->id' onclick=\"return confirm('Tem certeza que deseja excluir $usuario->nome?'); return false;\">
                                <img src='imagens/excluir.png' alt='Excluir'>
                            </a>
                        </div>

                    </li>";
                }
            ?>

        </ul>

    </div>


</body>

</html>