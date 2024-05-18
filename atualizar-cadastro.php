<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Cadastro</title>
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

        // Conectar ao banco de dados
        require 'conexao.php';

        
        if (isset($_SESSION['idUserLogado'])) {
            $id = $_SESSION['idUserLogado'];
            
            // Preparar a consulta para obter os dados do usuário
            $dados = $conexao->prepare("SELECT * FROM usuarios WHERE id = :id");
            $dados->bindParam(':id', $id, PDO::PARAM_INT);
            $dados->execute();
            
            // Verificar se algum resultado foi encontrado
            $usuario = $dados->fetch(PDO::FETCH_OBJ);

            if (!$usuario) {
                echo "Usuário não encontrado.";
                exit;
            }
        } else {
            echo "ID do usuário não fornecido.";
            exit;
        }
    ?>

    <div class="container container-cadastro">
        <h2>Atualização de cadastro</h2>
        <form action="" method="POST">
            <p><input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario->id); ?>"></p>
            <p>Nome:<input type="text" name="nome" placeholder="Digite novo nome" value="<?php echo htmlspecialchars($usuario->nome); ?>"></p>
            <p>Endereço:<input type="text" name="endereco" placeholder="Digite novo endereço" value="<?php echo htmlspecialchars($usuario->endereco); ?>"></p>
            <p>Telefone:<input type="text" name="telefone" placeholder="Digite novo número de telefone" value="<?php echo htmlspecialchars($usuario->telefone); ?>"></p>
            <p>Usuário: <input type="text" name="usuario" placeholder="Digite um novo" value="<?php echo htmlspecialchars($usuario->usuario); ?>"><span id='aviso-usuario'></span></p>
            <input type="submit" name="atualizar" value="Atualizar">
        </form>
    </div>

</body>
</html>

<?php
    if (isset($_POST['atualizar'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $usuario = $_POST['usuario'];
        
        // Verifica se o nome de usuário já existe, exceto pelo usuário atual
        if (existe_usuario($usuario, $usuario)) { 
            aviso_usuario_existente();
        } else {
            $atualizacao = $conexao->prepare("UPDATE usuarios SET nome=:nome, endereco=:endereco, telefone=:telefone, usuario=:usuario WHERE id=:id;");
            $atualizacao->bindValue(':nome', $nome);
            $atualizacao->bindValue(':endereco', $endereco);
            $atualizacao->bindValue(':telefone', $telefone);
            $atualizacao->bindValue(':usuario', $usuario);
            $atualizacao->bindValue(':id', $id);
            $atualizacao->execute();
            header('Location: listar-usuarios.php');
        }
    }
?>