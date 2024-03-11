<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_autor = mysqli_real_escape_string($mysqli, $_POST['name-form']);
    $resposta = mysqli_real_escape_string($mysqli, $_POST['comment-form']);
    $comment_id = mysqli_real_escape_string($mysqli, $_POST['comment_ID']);
    $destinatario = mysqli_real_escape_string($mysqli, $_POST['respondingTo']);

    $query = "INSERT INTO respostas (comment_id, nome_autor, resposta, destinatario) VALUES ('$comment_id', '$nome_autor', '$resposta', '$destinatario')";

    if (mysqli_query($mysqli, $query)) {
        mysqli_close($mysqli);
        header("Location: ../index.php");
    } else {
        echo "Erro: " . mysqli_error($mysqli);
        mysqli_close($mysqli);
    }
}
