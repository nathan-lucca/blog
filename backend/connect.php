<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco_de_dados = 'blog';

// $host = 'sql305.byethost18.com';
// $usuario = 'b18_35470400';
// $senha = 'Nlclcs*1910';
// $banco_de_dados = 'b18_35470400_blog';

$mysqli = new mysqli($host, $usuario, $senha, $banco_de_dados);
$mysqli->set_charset('utf8mb4');

if ($mysqli->connect_error) {
    die('Erro de conexão: ' . $mysqli->connect_error);
}
