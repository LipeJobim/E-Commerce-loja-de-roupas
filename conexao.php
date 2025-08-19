<?php
    $Servidor = 'localhost';
    $Usuario = 'root';
    $Senha = 'root';
    $BD = 'db_streetwear';
    $cn = new PDO("mysql:host=$Servidor; dbname=$BD", $Usuario, $Senha);
?>
