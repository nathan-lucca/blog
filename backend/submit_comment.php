<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_autor = mysqli_real_escape_string($mysqli, $_POST['name-form']);
    $comentario = mysqli_real_escape_string($mysqli, $_POST['comment-form']);
    $post_id = mysqli_real_escape_string($mysqli, $_POST['comment_post_ID']);

    $query = "INSERT INTO comentarios (post_id, nome_autor, comentario) VALUES ('$post_id', '$nome_autor', '$comentario')";

    if (!mysqli_query($mysqli, $query)) {
        echo "Erro: " . mysqli_error($mysqli);
        mysqli_close($mysqli);
    } else {
        mysqli_close($mysqli);
        header("Location: ../index.php");
    }
}
