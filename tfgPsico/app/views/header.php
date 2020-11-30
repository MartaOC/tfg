<!doctype html>
<html lang="es">

<head>
    <!-- Metadatos -->
    <meta charset="utf-8">
    <meta name="description" content="Inicio">
    <meta name="author" content="Marta O">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="includes/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">


    <title> Alicia Oltra Psicología </title>
</head>

<body>
    <div class="container-fluid fixed-top" style="background-color: #e3f2fd;">
        <nav class="navbar navbar-expand-lg container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php?url=HomeController/display/">Alicia Oltra Psicología</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?url=HomeController/display/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=HomeController/display/#quiensoy">¿Quién soy?</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Terapias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#adultos">Adultos</a>
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#ninos">Niños</a>
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#adolescentes">Adolescentes</a>
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#pareja">Pareja</a>
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#online">Online</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tarifas</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#tarifas">Online</a>
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#tarifas">Presencial</a>
                            <a class="dropdown-item" href="index.php?url=HomeController/display/#tarifas">Pareja</a>
                        </div>
                    </li>

                    <?php
                    if (isset($data) && $data['login']) {
                    ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user"></i></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="index.php?url=CitasController/display_citas_user/">Mis citas</a>

                                <a class="dropdown-item" href="index.php?url=UserController/display_profile/">Mis datos</a>
                                <?php
                                if (isset($data['isAdmin']) && $data['isAdmin'] == TRUE){
                                ?>
                                <a class="dropdown-item" href="index.php?url=CitasController/display_admin_citas/">Gestionar citas</a>
                                <?php } ?>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?url=UserController/logout/"> <i class="fas fa-sign-out-alt"></i></a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>


                <?php
                if (!isset($data) || !$data['login']) {
                ?>
                    <div>
                        <a class="btn btn-outline-dark btn-sm margin-left" href="index.php?url=LoginController/display/">Iniciar sesión</a>
                        <a class="btn btn-outline-dark btn-sm margin-left " href="index.php?url=UserController/display/">Registrarse</a>
                    </div>
                <?php
                }
                ?>




            </div>
        </nav>
    </div>

    <div id="container-principal" class="container">

        <?php
        include_once "show-info-message.php";
        ?>