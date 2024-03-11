<?php
require '../backend/connect.php';
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
    <link rel="stylesheet" href="../styles/about.css">
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
                        <a class="nav-link active" href="sobre.php">
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
                    <li class="breadcrumb-item active">&nbsp;<a class="caminho-pao" href="../index.php">Início</a></li>
                </ol>
            </nav>

            <!-- SOBRE NÓS -->
            <div class="col-md-8 mb-3">
                <div class="card mb-3 shadow rounded-0" style="border-top: 5px solid rgb(13,110,253);">
                    <div class="row g-0">
                        <div class="col">
                            <div class="cabecalho">
                                <div class="titulo">
                                    <h1 style="font-weight: 600;">Sobre Nós</h1>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="post-descricao" style="text-align: justify; line-height: 1; padding: 20px; font-size: 18px;">
                                    <p>Você é <b>apaixonado</b> por <b>tecnologia</b> e <b>programação</b>? Você quer <b>aprender</b> mais sobre esse universo fascinante e se tornar um <b>profissional de sucesso</b>? Então você está no lugar certo! Bem-vindo ao <b>blog</b> da <b>CiberBrasil</b>, a empresa de tecnologia que vai te <b>ensinar</b>, <b>inspirar</b> e <b>acompanhar</b> na sua jornada de aprendizado.</p><br>
                                    <p>A <b>CiberBrasil</b> é uma empresa de tecnologia que foi fundada em 15/10/2023 com a visão de <b>incentivar jovens</b> e pessoas no geral a se interessarem pela área de tecnologia, <b>ensinar</b>, <b>ajudar</b>, dar dicas e conteúdos exclusivos sobre programação, T.I. e tudo o que envolve o mundo digital.</p><br>
                                    <p>Neste <b>blog</b>, nós vamos compartilhar com vocês o nosso <b>conhecimento</b>, as nossas <b>experiências</b>, as nossas <b>novidades</b> e as nossas <b>paixões</b>. Nós queremos que este blog seja uma plataforma de aprendizado na área de tecnologia e programação em geral, de forma didática, prática e aconchegante.</p><br>
                                    <p>Aqui você vai encontrar <b>artigos</b>, <b>tutoriais</b>, <b>vídeos</b>, <b>podcasts</b>, <b>cursos</b>, <b>projetos</b>, <b>desafios</b> e muito mais sobre os mais diversos temas relacionados à tecnologia e programação. Você vai aprender desde o básico até o avançado, desde o front-end até o back-end, desde o web até o mobile, desde o Python até o Java, e muito mais.</p><br>
                                    <p>O nosso objetivo é que você se sinta parte da nossa <b>comunidade</b>, que você interaja conosco, que você nos dê o seu <b>feedback</b>, que você nos faça perguntas, que você nos sugira temas, que você nos envie os seus trabalhos, que você se divirta e que você se apaixone pela tecnologia e programação como nós.</p><br>
                                    <p>A nossa missão é que você se torne um <b>profissional qualificado</b>, <b>criativo</b>, <b>inovador</b> e capaz de resolver problemas reais com soluções tecnológicas. Queremos que você se destaque no mercado de trabalho, que você realize os seus sonhos, que você faça a diferença no mundo.</p><br>
                                    <p>Somos a <b>CiberBrasil</b>, e estamos aqui para te ajudar a se tornar um ciber-cidadão. Seja bem-vindo ao nosso blog!</p>
                                </div>
                                <img src="../imgs/sobre_nos.jpg" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD DO BLOG -->
            <div class="col-md-3 mb-3">
                <!-- CARD DO BLOG -->
                <div class="card rounded-0 shadow mb-3">
                    <div class="position-relative py-3 px-4 text-bg-primary rounded-0 badge box-ciberbrasil">CiberBrasil<svg width="1em" height="3em" viewBox="0 0 16 16" class="position-absolute top-100 start-50 translate-middle mt-1" fill="var(--bs-primary)" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg></div>

                    <!-- IMAGEM DO CARD -->
                    <img class="card-blog-image" src="../imgs/ciber_logo_3.jpg">

                    <!-- CORPO DO CARD -->
                    <div class="card-body">
                        <div class="card-body d-flex align-items-center justify-content-center flex-column">
                            <p class="card-text text-center">Explorando o mundo da tecnologia e compartilhando conhecimento para fortalecer sua jornada na programação.</p>
                            <a href="sobre.php" class="btn btn-primary text-center btn-animation">Saiba Mais <i class="bi bi-arrow-right"></i></a>
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
                                    <option value="<?php echo $id_categoria; ?>"><?php echo $nome_categoria; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </form>
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
                    <p class="mt-2 text-start">Transformando sonhos em realidade através do poder da programação e tecnologia. Junte-se a nós e descubra um universo de possibilidades ilimitadas.</p>
                </div>

                <!-- Site -->
                <div class="col-md-3 mb-3 footer-alinhamento">
                    <h5 class="mb-4"><i class="bi bi-house-door-fill"></i> Site</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.php" class="site">Início</a></li>
                        <li><a href="sobre.php" class="site">Sobre</a></li>
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
            <p class="text-center">&copy; <?php echo date("Y"); ?> CiberBrasil. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../js/redirectCategory.js"></script>
    <script src="../js/searchPost.js"></script>
</body>

</html>