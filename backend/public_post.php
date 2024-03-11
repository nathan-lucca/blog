<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($mysqli, $_POST['titulo'] ?? 'Sem Título.');
    $descricao = mysqli_real_escape_string($mysqli, $_POST['descricao'] ?? 'Sem Descrição.');
    $autor = mysqli_real_escape_string($mysqli, $_POST['autor']);
    $categorias = $_POST['categorias'];

    $sql = "INSERT INTO posts (titulo, descricao, autor, imagem) VALUES ('$titulo', '$descricao', '$autor', 'https://img.freepik.com/vetores-gratis/blogar-divertido-criacao-de-conteudo-streaming-online-videoblog-jovem-fazendo-selfie-para-rede-social-compartilhando-feedback-estrategia-de-autopromocao-ilustracao-vetorial-de-metafora-de-conceito_335657-855.jpg')";

    if (!mysqli_query($mysqli, $sql)) {
        echo "Erro ao inserir post: " . mysqli_error($mysqli);
        mysqli_close($mysqli);
        header("Location: ../index.php");
    } else {
        $post_id = mysqli_insert_id($mysqli);

        foreach ($categorias as $categoria_id) {
            $categoria_id = mysqli_real_escape_string($mysqli, $categoria_id);
            $sql = "INSERT INTO postagens_categorias (postagem_id, categoria_id) VALUES ('$post_id', '$categoria_id')";

            if (!mysqli_query($mysqli, $sql)) {
                echo "Erro ao inserir categoria: " . mysqli_error($mysqli);
                mysqli_close($mysqli);
                header("Location: ../index.php");
            }
        }

        mysqli_close($mysqli);
        header("Location: ../index.php");
    }
}
