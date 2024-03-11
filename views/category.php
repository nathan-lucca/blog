<?php
require '../backend/connect.php';

$resultados_por_pagina = 6;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $pagina_atual = $_GET['page'];
} else {
    $pagina_atual = 1;
}

$offset = ($pagina_atual - 1) * $resultados_por_pagina;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoria_id = $_GET['id'];

    $total_postagens_categoria_query = "SELECT COUNT(*) AS total FROM postagens_categorias WHERE categoria_id = $categoria_id";
    $total_postagens_categoria_result = mysqli_query($mysqli, $total_postagens_categoria_query);
    $total_postagens_categoria_row = mysqli_fetch_assoc($total_postagens_categoria_result);
    $total_postagens_categoria = $total_postagens_categoria_row['total'];

    $query = "SELECT p.*, GROUP_CONCAT(c.nome_categoria) AS categorias
              FROM posts p
              LEFT JOIN postagens_categorias pc ON p.post_id = pc.postagem_id
              LEFT JOIN categorias c ON pc.categoria_id = c.id
              WHERE p.post_id IN (
                    SELECT pc.postagem_id
                    FROM postagens_categorias pc
                    WHERE pc.categoria_id = $categoria_id
              )
              GROUP BY p.post_id
              LIMIT $resultados_por_pagina OFFSET $offset";

    $posts = mysqli_query($mysqli, $query);
} else {
    header('Location: ../index.php');
    exit;
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
    <link rel="stylesheet" href="../styles/category.css">
    <link rel="website icon" href="../imgs/ciber_logo_3.jpg" type="jpg">
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
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l 4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 15px;">
                    <i class="bi bi-house-door-fill"></i>
                    <li class="breadcrumb-item active">&nbsp;<a class="caminho-pao" href="../index.php">Início</a></li>
                    <li class="breadcrumb-item">Categoria</li>
                    <?php
                    $categoria_query = "SELECT nome_categoria FROM categorias WHERE id = $categoria_id";
                    $categoria_result = mysqli_query($mysqli, $categoria_query);
                    $categoria_row = mysqli_fetch_assoc($categoria_result);
                    $nome_categoria = $categoria_row['nome_categoria'];
                    ?>
                    <li class="breadcrumb-item active">&nbsp;
                        <?php echo $nome_categoria; ?>
                    </li>
                </ol>
            </nav>

            <!-- LISTA DAS POSTAGENS -->
            <div class="col-md-8 mb-3">
                <?php
                if (mysqli_num_rows($posts) > 0) {
                    while ($row = mysqli_fetch_assoc($posts)) {
                        $post_id = $row['post_id'];
                        $post_image = $row['imagem'];
                        $categorias = $row['categorias'];
                        $titulo = $row['titulo'];
                        $autor = $row['autor'];
                        $data_publicacao = $row['data_publicacao'];
                        $descricao = $row['descricao'];
                ?>
                        <div class="card mb-3 shadow rounded-0 cartao">
                            <div class="row g-0">
                                <!-- IMAGEM DO POST -->
                                <div class="col-md-4">
                                    <img src="<?php echo $post_image; ?>" class="img-fluid" style="height: 100%; width: 100%;">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <!-- CATEGORIAS DO POST -->
                                        <div class="category mb-2">
                                            <i class="bi bi-folder-fill me-2"></i>
                                            <?php
                                            $post_categorias = $categorias ? explode(",", $categorias) : array();
                                            $categorias_html = array();

                                            foreach ($post_categorias as $post_categoria) {
                                                $categoria_id = '';

                                                $categorias_postagem = mysqli_query($mysqli, "SELECT id FROM categorias WHERE nome_categoria = '$post_categoria'");

                                                if ($categoria_postagem_row = mysqli_fetch_assoc($categorias_postagem)) {
                                                    $categoria_id = $categoria_postagem_row['id'];
                                                }

                                                $categorias_html[] = '<a href="category.php?id=' . $categoria_id . '" class="categoria-post">' . $post_categoria . '</a>';
                                            }

                                            echo implode(' | ', $categorias_html);
                                            ?>
                                        </div>

                                        <!-- TÍTULO DO POST -->
                                        <h5 class="card-title titulo-post">
                                            <a href="post.php?id=<?php echo $post_id; ?>" class="titulos">
                                                <?php
                                                $titulo = strip_tags($titulo);
                                                $max_caracteres = 25;

                                                if (strlen($titulo) > $max_caracteres) {
                                                    $titulo = substr($titulo, 0, $max_caracteres) . "...";
                                                }

                                                echo $titulo;
                                                ?>
                                            </a>
                                        </h5>

                                        <!-- INFOS DO POST -->
                                        <div class="infos mt-2 mb-2">
                                            <span class="card-text"><i class="bi bi-person-fill"></i>
                                                <?php echo $autor; ?>
                                            </span>
                                            <span class="card-text"><i class="bi bi-calendar-date"></i>
                                                <?php echo date('d/m/Y', strtotime($data_publicacao)); ?>
                                            </span>
                                            <?php
                                            $comentarios = mysqli_query($mysqli, "SELECT * FROM comentarios WHERE post_id = $post_id");
                                            $quant_comentarios = mysqli_num_rows($comentarios);
                                            ?>
                                            <span class="card-text"><i class="bi bi-chat-text-fill"></i>
                                                <?php echo $quant_comentarios; ?> Comentários
                                            </span>
                                        </div>

                                        <!-- DESCRIÇÃO DO POST -->
                                        <div class="descricao mb-3">
                                            <p class="card-text descricao-texto">
                                                <?php
                                                $descricao = strip_tags($descricao);
                                                if (strlen($descricao) > 250) {
                                                    $descricao = substr($descricao, 0, 250) . " [...]";
                                                }
                                                echo $descricao;
                                                ?>
                                            </p>
                                        </div>

                                        <!-- LEIA MAIS DO POST -->
                                        <span class="leia-mais">
                                            <a href="post.php?id=<?php echo $post_id; ?>">Leia Mais <i class="bi bi-arrow-right-circle-fill"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p class="text-center"><b>Nenhuma Postagem foi encontrada!</b></p>
                <?php } ?>
            </div>

            <!-- CARD DO BLOG -->
            <div class="col-md-3 mb-3">
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

            <!-- PAGINAÇÃO -->
            <div class="col-md-8">
                <div class="pagination-block" style="display: block; width: 100%;">
                    <ul class="list" style="margin: 0; padding: 0; list-style: none;">
                        <?php
                        $total_paginas = ceil($total_postagens_categoria / $resultados_por_pagina);

                        if ($pagina_atual > 1) {
                            echo '<li class="item"><a class="page-numbers" href="category.php?id=' . $categoria_id . '&page=' . ($pagina_atual - 1) . '"><i class="bi bi-caret-left-fill"></i></a></li>';
                        }

                        for ($i = 1; $i <= $total_paginas; $i++) {
                            echo '<li class="item">';
                            if ($i == $pagina_atual) {
                                echo '<a class="page-numbers current" href="category.php?id=' . $categoria_id . '&page=' . $i . '">' . $i . '</a>';
                            } else {
                                echo '<a class="page-numbers" href="category.php?id=' . $categoria_id . '&page=' . $i . '">' . $i . '</a>';
                            }
                            echo '</li>';
                        }

                        if ($pagina_atual < $total_paginas) {
                            echo '<li class="item"><a class="page-numbers" href="category.php?id=' . $categoria_id . '&page=' . ($pagina_atual + 1) . '"><i class="bi bi-caret-right-fill"></i></a></li>';
                        }
                        ?>
                    </ul>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../js/redirectCategory.js"></script>
    <script src="../js/searchPost.js"></script>
</body>

</html>