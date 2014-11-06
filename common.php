<?php
// Variáveis de acesso ao bando de dados
$host = 'localhost';
$dbname = 'nome_do_banco_de_dados';
$user = 'usuario_do_banco';
$pass = 'senha_do_banco';

// Cria uma instancia da Super Classe PDO
// http://php.net/manual/en/book.pdo.php
$pdo = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

?>
