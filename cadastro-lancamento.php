<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php 
        session_start();
        require 'modulos.php';
        include 'menu.php';
    ?>

    <div class="container container-cadastro">

        <h2>Cadastro</h2>
        <form action="" method="POST">
            <p>Descrição:<input type="text" name="descricao" placeholder="Digite a descrição"></p>
            <p>Valor:<input type="text" name="valor" placeholder="Digite o valor"></p>
            <p>Tipo: 
                <select name="tipo">
                    <option value="1">Receita</option>
                    <option value="0">Despesa</option>
                </select>
            </p>
            <p>Categoria: 
                <select name="categoria">
                    <?php
                    // Conexão com o banco de dados
                    require 'conexao.php';

                    // Consulta SQL para selecionar todas as categorias
                    $query = "SELECT * FROM categorias";

                    // Preparando e executando a consulta
                    $stmt = $conexao->query($query);

                    // Loop através de todas as categorias
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>{$row['descricao']}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Data:<input type="date" name="dataLancamento" placeholder="Informe a data"></p>
            <input type="submit" name="cadastrar" value="Cadastrar">
        </form>

    </div>

</body>

</html>

<?php 

    $cadastrado = false;
    $usuario_existente = false;
    require 'conexao.php';

    $id = $_SESSION['idUserLogado'];
    $dataCriacao = date("Y-m-d");
    
    if (isset($_POST['cadastrar'])) {
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $tipo = $_POST['tipo'];
            $categoria = $_POST['categoria'];
            $dataLancamento = $_POST['dataLancamento'];
            $usuario_id = $id;
            $cadastro = $conexao->prepare(
                "INSERT INTO lancamentos (descricao, valor, usuario_id, dataCriacao, tipo, dataLancamento, categoria_id) VALUES (:descricao, :valor, :usuario_id, :data_criacao, :tipo, :data_lancamento, :categoria_id);"
            );
            $cadastro->bindValue(":descricao", $descricao);
            $cadastro->bindValue(":valor", $valor);
            $cadastro->bindValue(":tipo", $tipo);
            $cadastro->bindValue(":categoria_id", $categoria);
            $cadastro->bindValue(":data_criacao", $dataCriacao);
            $cadastro->bindValue(":data_lancamento", $dataLancamento);
            $cadastro->bindValue(":usuario_id", $usuario_id);
            $cadastro->execute();
            $cadastrado = true;
    }

    if ($cadastrado):
?>

<script>
alert('Cadastrado com sucesso!')
</script>


<?php 
    endif
?>