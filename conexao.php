<?php 

    try {
        $conexao = new PDO('mysql: host = localhost; dbname=seminario-pix', 'root', '');
    }  catch (Exception $erro) {
        try {
            $conexao = new PDO('mysql: host = www.db4free.net; dbname=seminario-pix', '', '');
        } catch (Exception $e) {
            echo $erro -> getMessage();
            echo "<br>";
            echo $erro -> getCode();
        }

    }

?>