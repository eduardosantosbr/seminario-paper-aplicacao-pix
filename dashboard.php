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

        $id = $_SESSION['idUserLogado'];

        $dados = $conexao->prepare("SELECT SUM(CASE WHEN tipo = 1 THEN valor ELSE 0 END) AS entradas,
                                        SUM(CASE WHEN tipo = 0 THEN valor ELSE 0 END) AS saidas,
                                        SUM(CASE WHEN tipo = 1 THEN valor ELSE -valor END) AS saldo_total
                                    FROM lancamentos; WHERE usuario_id = $id");
                $dados->execute();
                $objSaldo = $dados->fetchAll(PDO::FETCH_OBJ);
    ?>

    <div class="container">
        <h1>Seja bem vindo <?php if (isset($_COOKIE['nome'])) { echo $_COOKIE['nome']; }?>!</h1>
    </div>

     <div>   
        <div class="dashboard">
            <div class="div-criar">
                <form action="cadastro-lancamento.php" method="post">
                    <button id="criarLancamento" class="btn-criar" onclick="">Despesa</button>
                </form>
            </div>

            <div class="div-criar">
                <form action="cadastro-lancamento.php" method="post">
                    <button id="criarLancamento" class="btn-criar" onclick="">Receita</button>
                </form>
            </div>
            
            <div class="div-criar">
                <form action="pagar.php" method="post">
                    <button id="criarLancamento" class="btn-criar" onclick="">Pagar</button>
                </form>
            </div>

            <div class="div-criar">
                <form action="receber.php" method="post">
                    <button id="criarLancamento" class="btn-criar" onclick="">Receber</button>
                </form>
            </div>



            <div class="card-saldo">
                <h2>Saldo atual</h2>
                <p>R$ <?php echo number_format($objSaldo[0]->saldo_total, 2, ',', '.'); ?></p>
            </div>
            <div class="card-ultimos-lancamentos">
                <h2>Ultimos lançamentos</h2>
                <ul>
                    <li>R$ 1.234,56...</li>
                    <li>R$ 1.234,56...</li>
                    <li>R$ 1.234,56...</li>
                    <li>R$ 1.234,56...</li>
                    <li>R$ 1.234,56...</li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>