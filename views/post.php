<?php
require '../backend/connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];

    $query = "SELECT posts.*, GROUP_CONCAT(categorias.nome_categoria) AS categorias, posts.titulo, categorias.id AS categoria_id, categorias.nome_categoria AS categoria_nome
          FROM posts
          LEFT JOIN postagens_categorias ON posts.post_id = postagens_categorias.postagem_id
          LEFT JOIN categorias ON postagens_categorias.categoria_id = categorias.id
          WHERE posts.post_id = $post_id
          GROUP BY posts.post_id";

    $post_result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($post_result) > 0) {
        $post = mysqli_fetch_assoc($post_result);

        $post_id = $post["post_id"];
        $post_titulo = $post["titulo"];
        $post_publicacao = $post["data_publicacao"];
        $post_autor = $post["autor"];
        $post_descricao = $post["descricao"];
        $post_image = $post["imagem"];
        $post_categorias = $post['categorias'];
        $post_categoria_id = $post['categoria_id'];
        $post_categoria_nome = $post['categoria_nome'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf8mb4">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>CiberBrasil</title>
    <link rel="stylesheet" href="../styles/post.css">
    <link rel="website icon" href="../imgs/ciber_logo_3.jpg" type="jpg">
    <script src="https://cdn.tiny.cloud/1/p9ybkm5opjsd0mh730o2fvtzvqe3gvpef5tyep0bjot7ptgj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../imgs/ciber_logo_2.png" alt="CiberBrasil" class="nav-logo" width="180">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <i class="bi bi-house-door-fill me-2"></i> Página Inicial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">
                            <i class="bi bi-info-circle-fill me-2"></i> Sobre Nós
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            <i class="bi bi-envelope-fill me-2"></i> Contato
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="search-container" style="position: relative; width: auto; text-align: right;">
                            <form id="searchForm" action="./search.php" method="get">
                                <input autocomplete="off" class="form-control me-2 textarea-form" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="q" style="width: auto;">
                            </form>
                            <button id="searchIcon" class="btn btn-outline-light" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5 mb-5">
            <!-- CAMINHO DE PÃO -->
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 15px;">
                    <i class="bi bi-house-door-fill"></i>
                    <li class="breadcrumb-item active">&nbsp;<a class="caminho-pao" href="../index.php">Início</a>
                    </li>
                    <li class="breadcrumb-item active"><a class="caminho-pao" href="category.php?id=<?php echo $post_categoria_id; ?>">
                            <?php echo $post_categoria_nome; ?>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <?php echo $post_titulo; ?>
                    </li>
                </ol>
            </nav>

            <!-- POSTAGEM ATUAL -->
            <div class="col-md-8">
                <div class="card mb-3 shadow rounded-0" style="border-top: 5px solid rgb(13,110,253);">
                    <div class="row g-0">
                        <div class="col">
                            <div class="cabecalho">
                                <div class="categorias" style="margin-bottom: 20px;">
                                    <?php
                                    $categorias = $post_categorias ? explode(",", $post_categorias) : array();
                                    $categorias_html = array();

                                    foreach ($categorias as $post_categoria) {
                                        $categoria_id = '';

                                        $categorias_postagem = mysqli_query($mysqli, "SELECT * FROM categorias WHERE nome_categoria = '$post_categoria'");

                                        if ($categoria_postagem_row = mysqli_fetch_assoc($categorias_postagem)) {
                                            $categoria_id = $categoria_postagem_row['id'];
                                        }

                                        $categorias_html[] = '<a href="category.php?id=' . $categoria_id . '">' . $post_categoria . '</a>';
                                    }

                                    echo implode(' ', $categorias_html);
                                    ?>
                                </div>

                                <div class="titulo">
                                    <h1 style="font-weight: 600;">
                                        <?php echo $post_titulo; ?>
                                    </h1>
                                </div>

                                <div class="post-infos">
                                    <span class="autor">
                                        <img src="../imgs/ciber_logo_3.jpg">
                                        <a>
                                            <?php echo $post_autor; ?>
                                        </a>
                                    </span>

                                    <span class="data">
                                        <i class="bi bi-calendar-date"></i>
                                        <?php echo date('d/m/Y', strtotime($post_publicacao)); ?>
                                    </span>

                                    <span class="comentarios">
                                        <?php
                                        $comentarios = mysqli_query($mysqli, "SELECT * FROM comentarios WHERE post_id = $post_id");
                                        $quant_comentarios = mysqli_num_rows($comentarios);
                                        ?>

                                        <i class="bi bi-chat-text-fill"></i> <a href="#comentarios">
                                            <?php echo $quant_comentarios; ?> Comentários
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="post-image">
                                    <img src="<?php echo $post_image; ?>" alt="<?php echo $post_titulo; ?>" class="img-fluid">
                                </div>

                                <div class="post-descricao" style="text-align: justify; line-height: 1;">
                                    <p>
                                        <?php echo $post_descricao; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD DO BLOG -->
            <div class="col-md-3">
                <!-- CARD DO BLOG -->
                <div class="card rounded-0 shadow mb-3">
                    <div class="position-relative py-3 px-4 text-bg-primary rounded-0 badge box-ciberbrasil">
                        CiberBrasil<svg width="1em" height="3em" viewBox="0 0 16 16" class="position-absolute top-100 start-50 translate-middle mt-1" fill="var(--bs-primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg></div>

                    <!-- IMAGEM DO CARD -->
                    <img class="card-blog-image" src="../imgs/ciber_logo_3.jpg">

                    <!-- CORPO DO CARD -->
                    <div class="card-body">
                        <div class="card-body d-flex align-items-center justify-content-center flex-column">
                            <p class="card-text text-center">Explorando o mundo da tecnologia e compartilhando
                                conhecimento para fortalecer sua jornada na programação.</p>
                            <a href="about.php" class="btn btn-primary text-center btn-animation">Saiba Mais <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- SELECT DAS CATEGORIAS -->
                <div class="card rounded-0 shadow mb-3" style="height: 150px;">
                    <div class="position-relative py-3 text-bg-primary rounded-0 badge box-categorias" style="font-size: 17px; text-align: center;">
                        Categorias<svg width="1em" height="3em" viewBox="0 0 16 16" class="position-absolute top-100 start-50 translate-middle mt-1" fill="var(--bs-primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </div>

                    <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                        <form action="category.php" id="categorySelectForm">
                            <select class="form-select select-categoria" name="id" onchange="redirectCategory()">
                                <option value="0" selected>Selecionar Categoria</option>
                                <?php
                                $categorias_select = mysqli_query($mysqli, "SELECT * FROM categorias ORDER BY nome_categoria ASC");

                                while ($categorias_select_row = mysqli_fetch_assoc($categorias_select)) {
                                    $id_categoria = $categorias_select_row["id"];
                                    $nome_categoria = $categorias_select_row["nome_categoria"];
                                ?>
                                    <option value="<?php echo $id_categoria; ?>">
                                        <?php echo $nome_categoria; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- BOTÕES DE VOLTAR/AVANÇAR -->
            <div class="col-md-8">
                <div class="card mb-3 shadow rounded-0">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-block -sub">
                                <div class="prev-next">
                                    <div class="prev">
                                        <?php
                                        $queryPostAnterior = "SELECT post_id, titulo FROM posts WHERE post_id = (SELECT MAX(post_id) FROM posts WHERE post_id < $post_id)";
                                        $postAnteriorResult = mysqli_query($mysqli, $queryPostAnterior);

                                        if (mysqli_num_rows($postAnteriorResult) > 0) {
                                            $postAnterior = mysqli_fetch_assoc($postAnteriorResult);
                                            $postAnteriorID = $postAnterior['post_id'];
                                            $postAnteriorTitulo = $postAnterior['titulo'];
                                        ?>
                                            <a href="post.php?id=<?php echo $postAnteriorID; ?>" class="btn btn-primary post-button"><i class="bi bi-caret-left-fill"></i>
                                                Voltar</a>

                                            <div class="post-titulo" style="font-size: 20px;">
                                                <a href="post.php?id=<?php echo $postAnteriorID; ?>">
                                                    <?php
                                                    $titulo = strip_tags($postAnteriorTitulo);
                                                    $max_caracteres = 30;

                                                    if (strlen($titulo) > $max_caracteres) {
                                                        $titulo = substr($titulo, 0, $max_caracteres) . "...";
                                                    }

                                                    echo $titulo;
                                                    ?>
                                                </a><br>
                                            </div>
                                        <?php } else { ?>
                                            <a href="#" class="btn btn-primary post-button disabled"><i class="bi bi-caret-left-fill"></i> Voltar</a>
                                            <div><br></div>
                                        <?php } ?>
                                    </div>

                                    <div class="next">
                                        <?php
                                        $postPosteriorID = $post_id + 1;
                                        $queryPostPosterior = "SELECT post_id, titulo FROM posts WHERE post_id = (SELECT MIN(post_id) FROM posts WHERE post_id > $post_id)";
                                        $postPosteriorResult = mysqli_query($mysqli, $queryPostPosterior);

                                        if (mysqli_num_rows($postPosteriorResult) > 0) {
                                            $postPosterior = mysqli_fetch_assoc($postPosteriorResult);
                                            $postPosteriorID = $postPosterior['post_id'];
                                            $postPosteriorTitulo = $postPosterior['titulo'];
                                        ?>
                                            <a href="post.php?id=<?php echo $postPosteriorID; ?>" class="btn btn-primary post-button">Avançar <i class="bi bi-caret-right-fill"></i></a>

                                            <div class="post-titulo" style="font-size: 20px;">
                                                <a href="post.php?id=<?php echo $postPosteriorID; ?>">
                                                    <?php
                                                    $titulo = strip_tags($postPosteriorTitulo);
                                                    $max_caracteres = 30;

                                                    if (strlen($titulo) > $max_caracteres) {
                                                        $titulo = substr($titulo, 0, $max_caracteres) . "...";
                                                    }

                                                    echo $titulo;
                                                    ?>
                                                </a><br>
                                            </div>
                                        <?php } else { ?>
                                            <a href="#" class="btn btn-primary post-button disabled">Avançar <i class="bi bi-caret-right-fill"></i></a>
                                            <div><br></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POSTS RELACIONADOS -->
            <div class="col-md-8">
                <div class="card mb-3 shadow rounded-0">
                    <div class="row g-0">
                        <div class="col">
                            <div id="posts-relacionados" class="card-block -sub">
                                <p class="titulo-relacionados">Posts Relacionados</p>

                                <div class="relacionados">
                                    <?php
                                    $words = explode(' ', $post_titulo);
                                    $like_conditions = array();

                                    foreach ($words as $word) {
                                        $like_conditions[] = "titulo LIKE '%$word%'";
                                    }

                                    $like_query = implode(' OR ', $like_conditions);

                                    $related_posts_query = "SELECT * FROM posts WHERE post_id != $post_id AND ($like_query) LIMIT 4";

                                    $related_posts_result = mysqli_query($mysqli, $related_posts_query);

                                    while ($related_post = mysqli_fetch_assoc($related_posts_result)) {
                                        $related_post_id = $related_post['post_id'];
                                        $related_post_title = $related_post['titulo'];
                                        $related_post_image = $related_post['imagem'];
                                    ?>
                                        <div class="item" style="font-size: 14px; margin: 0 1.25% 15px;">
                                            <a class="imagelink" href="post.php?id=<?php echo $related_post_id; ?>" style="position: relative; display: block;">
                                                <img style="max-width: 100%; height: 115px; vertical-align: middle;" src="<?php echo $related_post_image; ?>">
                                            </a>

                                            <a href="post.php?id=<?php echo $related_post_id; ?>" style="color: black; font-weight: 500; margin: 10px 0; line-height: 1.4; word-wrap: break-word;">
                                                <?php
                                                $titulo = strip_tags($related_post_title);
                                                $max_caracteres = 30;

                                                if (strlen($titulo) > $max_caracteres) {
                                                    $titulo = substr($titulo, 0, $max_caracteres) . "...";
                                                }

                                                echo $titulo;
                                                ?>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COMENTÁRIOS -->
            <div class="col-md-8">
                <div class="card mb-3 shadow rounded-0">
                    <div class="row g-0">
                        <div class="col">
                            <div id="comentarios" class="card-block -sub">
                                <p class="subtitulo-comentarios">
                                    <?php
                                    $comentarios = mysqli_query($mysqli, "SELECT * FROM comentarios WHERE post_id = $post_id");
                                    $quant_comentarios = mysqli_num_rows($comentarios);

                                    echo $quant_comentarios . " Comentários";
                                    ?>
                                </p>

                                <div class="reply-title">
                                    <h3>Deixe um comentário</h3>
                                </div>

                                <form action="../backend/submit_comment.php" method="post" id="commentForm" class="form-data" style="max-width: 400px;">
                                    <div class="comentario-form" style="margin-bottom: 16px; font-weight: 500;">
                                        <label for="comment-form" class="label-form">Comentário <span style="color: red;">*</span></label>
                                        <textarea class="textarea-form" name="comment-form" id="comment-form" cols="45" rows="8" required></textarea>
                                    </div>

                                    <div class="nome-form" style="margin-bottom: 16px; font-weight: 500;">
                                        <label for="name-form" class="label-form">Nome <span style="color: red;">*</span></label>
                                        <input name="name-form" id="name-form" class="textarea-form" type="text" size="30" maxlength="245" autocomplete="name" required>
                                    </div>

                                    <div class="email-form" style="margin-bottom: 16px; font-weight: 500;">
                                        <label for="email-form" class="label-form">Email <span style="color: red;">*</span></label>
                                        <input name="email-form" id="email-form" class="textarea-form" type="email" size="30" maxlength="200" autocomplete="email" required>
                                    </div>

                                    <div class="submit-form" style="margin: 15px 0;">
                                        <input name="submit" type="submit" id="submit" class="btn btn-primary post-button" value="Postar comentário">
                                        <input type="hidden" name="comment_post_ID" value="<?php echo $post_id; ?>" id="comment_post_ID">
                                    </div>
                                </form>

                                <hr>

                                <ol class="lista-comentarios" style="margin: 0; padding: 0; list-style: none;">
                                    <?php
                                    $comentarios = mysqli_query($mysqli, "SELECT * FROM comentarios WHERE post_id = $post_id ORDER BY data_publicacao DESC");

                                    if (mysqli_num_rows($comentarios) > 0) {
                                        while ($comentario = mysqli_fetch_assoc($comentarios)) {
                                    ?>
                                            <li id="comentario-<?php echo $comentario['comment_id'] ?>" class="comment mb-3">
                                                <article id="div-comentario-<?php echo $comentario['comment_id'] ?>" class="comment-body">
                                                    <footer class="comment-meta">
                                                        <div class="comment-author" data-author="<?php echo $comentario['nome_autor']; ?>" style="margin-bottom: 10px;">
                                                            <img src="https://www.brasilcode.com.br/wp-content/litespeed/avatar/3045dfbe983c09bf5a4e6729569bdaa3.jpg?ver=1698092771" style="border-radius: 50%;">
                                                            <b style="margin-left: 10px;">
                                                                <?php echo $comentario['nome_autor']; ?>
                                                            </b>
                                                        </div>

                                                        <div class="comment-metadata" style="font-size: 13px;">
                                                            Data da publicação: <b>
                                                                <?php echo date('d/m/Y', strtotime($comentario['data_publicacao'])); ?>
                                                            </b>
                                                        </div>
                                                    </footer>

                                                    <div class="comment-content">
                                                        <p>
                                                            <?php echo $comentario['comentario']; ?>
                                                        </p>
                                                    </div>

                                                    <div class="reply">
                                                        <a href="#" class="reply-link" data-commentid="<?php echo $comentario['comment_id']; ?>" data-replyto="<?php echo $comentario['nome_autor']; ?>">Responder</a>
                                                    </div>
                                                </article>

                                                <ul class="children" style="display: none; list-style: none;">
                                                    <?php
                                                    $respostas = mysqli_query($mysqli, "SELECT * FROM respostas WHERE comment_id = " . $comentario['comment_id'] . " ORDER BY data_publicacao DESC");

                                                    if (mysqli_num_rows($respostas) > 0) {
                                                        while ($resposta = mysqli_fetch_assoc($respostas)) {
                                                    ?>
                                                            <li id="resposta-<?php echo $resposta['resposta_id']; ?>" class="comment">
                                                                <article id="div-resposta-<?php echo $resposta['resposta_id'] ?>" class="comment-body">
                                                                    <footer class="comment-meta">
                                                                        <div class="comment-author" data-author="<?php echo $resposta['nome_autor']; ?>" style="margin-bottom: 10px;">
                                                                            <img src="https://www.brasilcode.com.br/wp-content/litespeed/avatar/3045dfbe983c09bf5a4e6729569bdaa3.jpg?ver=1698092771" style="border-radius: 50%;">
                                                                            <b style="margin-left: 10px;">
                                                                                <?php echo $resposta['nome_autor']; ?>
                                                                            </b> - <small>Respondendo para: <b>
                                                                                    <?php echo $resposta['destinatario']; ?>
                                                                                </b></small>
                                                                        </div>

                                                                        <div class="comment-metadata" style="font-size: 13px;">
                                                                            Data da publicação: <b>
                                                                                <?php echo date('d/m/Y', strtotime($resposta['data_publicacao'])); ?>
                                                                            </b>
                                                                        </div>
                                                                    </footer>

                                                                    <div class="comment-content">
                                                                        <p>
                                                                            <?php echo $resposta['resposta']; ?>
                                                                        </p>
                                                                    </div>

                                                                    <div class="reply">
                                                                        <a href="#" class="reply-link" data-commentid="<?php echo $resposta['resposta_id']; ?>" data-replyto="<?php echo $resposta['nome_autor']; ?>">Responder</a>
                                                                    </div>
                                                                </article>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>

                                                <div class="comment-respond" style="display: none; padding: 10px;">
                                                    <div class="comment-title">
                                                        <h3 class="reply-title" style="font-size: 20px;">Responder para
                                                            <?php echo $comentario['nome_autor']; ?>
                                                        </h3>
                                                    </div>

                                                    <form action="../backend/response_comment.php" method="post" id="commentForm" class="form-data" style="max-width: 400px;">
                                                        <div class="comentario-form" style="margin-bottom: 16px; font-weight: 500;">
                                                            <label for="comment-form" class="label-form">Comentário <span style="color: red;">*</span></label>
                                                            <textarea class="textarea-form" name="comment-form" id="comment-form" cols="45" rows="8" required></textarea>
                                                        </div>

                                                        <div class="nome-form" style="margin-bottom: 16px; font-weight: 500;">
                                                            <label for="name-form" class="label-form">Nome <span style="color: red;">*</span></label>
                                                            <input name="name-form" id="name-form" class="textarea-form" type="text" size="30" maxlength="245" autocomplete="name" required>
                                                        </div>

                                                        <div class="email-form" style="margin-bottom: 16px; font-weight: 500;">
                                                            <label for="email-form" class="label-form">Email <span style="color: red;">*</span></label>
                                                            <input name="email-form" id="email-form" class="textarea-form" type="email" size="30" maxlength="200" autocomplete="email" required>
                                                        </div>

                                                        <div class="submit-form" style="display: flex; margin: 15px 0;">
                                                            <input name="submit" type="submit" id="submit" class="btn btn-primary post-button" style="margin-right: 10px;" value="Postar comentário">
                                                            <input name="button" type="button" id="cancel-response" class="btn btn-primary post-button" value="Cancelar resposta">
                                                            <input type="hidden" name="responding_to" class="responding-to">
                                                            <input type="hidden" name="comment_ID" class="comment-id" value="<?php echo $comentario['comment_id']; ?>">
                                                            <input type="hidden" id="respondingTo" name="respondingTo">
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer-main">
        <div class="container">
            <div class="row align-items-start">
                <!-- Sobre -->
                <div class="col-md-3 mb-3 footer-alinhamento">
                    <h5 class="mb-4"><i class="bi bi-info-circle-fill"></i> Sobre</h5>
                    <img src="../imgs/ciber_logo_2.png" alt="CiberBrasil" class="footer-logo" width="120">
                    <p class="mt-2 text-start">Transformando sonhos em realidade através do poder da programação e
                        tecnologia. Junte-se a nós e descubra um universo de possibilidades ilimitadas.</p>
                </div>

                <!-- Site -->
                <div class="col-md-3 mb-3 footer-alinhamento">
                    <h5 class="mb-4"><i class="bi bi-house-door-fill"></i> Site</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.php" class="site">Início</a></li>
                        <li><a href="about.php" class="site">Sobre</a></li>
                        <li><a href="contact.php" class="site">Contato</a></li>
                    </ul>
                </div>

                <!-- Redes Sociais -->
                <div class="col-md-3 footer-alinhamento">
                    <h5 class="mb-4"><i class="bi bi-instagram"></i> Redes Sociais</h5>
                    <ul class="list-unstyled d-flex align-items-center justify-content-center" style="gap: 20px;">
                        <li class="item-rede-social instagram"><a href="https://www.instagram.com/ciber.brasil/" target="_blank"><i class="bi bi-instagram instagram"></i></a></li>
                    </ul>
                </div>

                <!-- Desenvolvedor -->
                <div class="col-md-3 footer-alinhamento">
                    <h5 class="mb-4"><i class="bi bi-code-slash"></i> Desenvolvedor</h5>
                    <ul class="list-unstyled d-flex align-items-center justify-content-center" style="gap: 20px;">
                        <li class="item-rede-social instagram"><a href="https://www.instagram.com/ofc_nathan_lucca/" target="_blank"><i class="bi bi-instagram instagram"></i></a>
                        </li>
                        <li class="item-rede-social github"><a href="https://github.com/nathan-lucca" target="_blank"><i class="bi bi-github"></i></a>
                        </li>
                        <li class="item-rede-social linkedin"><a href="https://www.linkedin.com/in/nathan-lucca-covre-358078266/" target="_blank"><i class="bi bi-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="text-center">&copy;
                <?php echo date("Y"); ?> CiberBrasil. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../js/responder_comentarios.js"></script>
    <script src="../js/redirectCategory.js"></script>
    <script src="../js/searchPost.js"></script>
</body>

</html>