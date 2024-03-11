<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require 'connect.php';

// Consulta para obter todas as categorias
$query = "SELECT id, nome_categoria FROM categorias";
$result = mysqli_query($mysqli, $query);

$categorias = array();

// Verificar se há resultados
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categorias[] = array(
            'id' => $row['id'],
            'nome_categoria' => $row['nome_categoria']
        );
    }
}

// Fechar conexão
mysqli_close($mysqli);

// Retornar categorias no formato JSON
echo json_encode($categorias);
