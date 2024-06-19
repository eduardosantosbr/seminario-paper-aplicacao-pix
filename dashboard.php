<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
    .dados-valor {
        font-size: 16px;
    }
    .tipo-1 {
        color: black;
    }
    .tipo-0 {
        color: red;
    }
</style>
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

        $id = $_SESSION['idUserLogado'];

        $dados = $conexao->prepare("SELECT SUM(CASE WHEN tipo = 1 THEN valor ELSE 0 END) AS entradas,
                                        SUM(CASE WHEN tipo = 0 THEN valor ELSE 0 END) AS saidas,
                                        SUM(CASE WHEN tipo = 1 THEN valor ELSE -valor END) AS saldo_total
                                    FROM lancamentos WHERE usuario_id = :id");
        $dados->bindValue(':id', $id, PDO::PARAM_INT);
        $dados->execute();
        $objSaldo = $dados->fetchAll(PDO::FETCH_OBJ);


        $dadosUltimosLancamentos = $conexao->prepare("SELECT descricao, valor, tipo FROM `lancamentos` WHERE usuario_id = :id LIMIT 0,5");
        $dadosUltimosLancamentos->bindValue(':id', $id, PDO::PARAM_INT);
        $dadosUltimosLancamentos->execute();
        $objDadosUltimosLancamentos = $dadosUltimosLancamentos->fetchAll(PDO::FETCH_OBJ);

    ?>

    <div class="container">
        <h1>Seja bem vindo <?php if (isset($_COOKIE['nome'])) { echo htmlspecialchars($_COOKIE['nome']); }?>!</h1>
    </div>

    <div class="dashboard">
        <div class="div-criar">
            <div class="div-criar-despesa">
                <form action="cadastro-lancamento.php?id=0" method="post">
                    <button id="criarLancamento" class="btn-criar-despesa" onclick="">Despesa</button>
                </form>
            </div>

            <div class="div-criar-receita">
                <form action="cadastro-lancamento.php?id=1" method="post">
                    <button id="criarLancamento" class="btn-criar-receita" onclick="">Receita</button>
                </form>
            </div>

            <!-- <div class="div-criar-pagar">
                <form action="pagar.php" method="post">
                    <button id="criarLancamento" class="btn-criar-pagar" onclick="">Pagar</button>
                </form>
            </div>

            <div class="div-criar-receber">
                <form action="receber.php" method="post">
                    <button id="criarLancamento" class="btn-criar-receber" onclick="">Receber</button>
                </form>
            </div> -->
        </div>

        <div class="div-card">
            <div class="card-saldo">
                <h2>Saldo atual</h2>
                <p>R$ <?php echo number_format($objSaldo[0]->saldo_total, 2, ',', '.'); ?></p>
            </div>
            <div class="card-saldo">
                <h2>Receita</h2>
                <p>R$ <?php echo number_format($objSaldo[0]->entradas, 2, ',', '.'); ?></p>
                <h2>Despesa</h2>
                <p>R$ <?php echo number_format($objSaldo[0]->saidas, 2, ',', '.'); ?></p>
            </div>
            <div class="card-ultimos-lancamentos">
                <h2>Ultimos lançamentos</h2>
                <ul>
                <?php
                    foreach ($objDadosUltimosLancamentos as $lancamento) {
                        $descricao = $lancamento->descricao;
                        if (strlen($descricao) > 5) {
                            $descricao = substr($descricao, 0, 10) . '...';
                        }
                        $valorFormatado = number_format($lancamento->valor, 2, ',', '.');
                        $valorClass = $lancamento->tipo == 1 ? 'tipo-1' : 'tipo-0';
                        echo "
                        <li>
                            <div class='dados'>
                                <div class='dados-descricao'>
                                    $descricao
                                </div>
                                <div class='dados-valor $valorClass'>
                                    $valorFormatado
                                </div>
                            </div>
                        </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>