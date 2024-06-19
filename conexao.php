<?php 

    try {
        $conexao = new PDO('mysql: host = localhost; dbname=seminario-app-web', 'root', '');
    }  catch (Exception $erro) {
        echo $erro -> getMessage();
        echo "<br>";
        echo $erro -> getCode();
    }

?>