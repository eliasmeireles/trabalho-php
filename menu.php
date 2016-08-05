<?php
session_start();
require_once 'class/dao/EstadoDao.php';
require_once 'class/fw/Conexao.php';

$estadoDao = new EstadoDao($conexao);
$estados = $estadoDao->selectEstados();

$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])), 0, strlen(basename($_SERVER['PHP_SELF'])) - 4);


if ((empty($_SESSION['__usuarioConectado'])) && ($basename != "index")) {
    $_SESSION['__fazerLogin'] = "error";
   header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Aulas PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/css/reset.css">
    <link href="//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="resources/css/base.css">
    <link rel="stylesheet" href="resources/css/index.css">
    <link rel="stylesheet" href="resources/css/tema.css">
    <link rel="stylesheet" href="resources/css/menu.css">
    <link rel="stylesheet" href="resources/css/footer.css">
    <link rel="stylesheet" href="resources/css/form.css">
    <link rel="stylesheet" href="resources/css/pages/lista-funcionarios.css">
    <link rel="stylesheet" href="resources/css/pages/alterar-dados-func.css">
    <link rel="stylesheet" href="resources/css/pages/sobre.css">
    <link rel="stylesheet" href="resources/css/pages/cadastro-ok.css">
    <link rel="stylesheet" href="resources/css/pages/localiza.css">
    <link rel="stylesheet" href="resources/css/pages/usuario-form.css">
    <link rel="stylesheet" href="resources/css/pages/cadastrar-usuario.css">
    <link rel="stylesheet" href="resources/css/pages/cad-usuario.css">
    <link rel="stylesheet" href="resources/css/pages/lista-cargo.css">
    <link rel="stylesheet" href="resources/css/hidden-classes.css">
</head>
<body>
<div class="wrapper">
    <header class="page-header background-primary">
        <div class="container header-container">
            <div class="logo-container">
                <h1 class="logo">
                    <a class="logo-empresa" href="/">
                        <img class="logo-image" alt="Foto do usuario"
                             src="/resources/img/logo_system_plus.png">
                    </a>
                </h1>
            </div>
            <div class="menu-bar">
                <div class="menu-responsiv">
                    <div class="menu-ico">
                        <div class="inner"></div>
                        <div class="inner"></div>
                        <div class="inner"></div>
                    </div>
                    <h5 class="resp-text color_primary_light font-primary-bold">Menu</h5>
                </div>
                <div class="toggle-sub"></div>
                <ul class="navbar-nav">
                    <li class="navlink"><a href="/" class="navcation font-primary-bold_mediun">Home</a>
                    </li>
                    <li class="navlink"><a href="/funcionarios.php" class="navcation font-primary-bold_mediun">Funcionário</a>
                    </li>
                    <li class="navlink"><a href="/lista-cargos.php" class="navcation font-primary-bold_mediun">Cargo</a>
                    </li>
                    <li class="navlink">
                        <a href="usuarios-lista.php" class="navcation font-primary-bold_mediun">Usuários</a>
                    </li>
                    <?php if ((empty($_SESSION['__usuarioConectado']))) : ?>
                        <li class="navlink navlink-login">
                            <span class="func-nav color_primary_light font-primary-bold_mediun">Login</span>
                        </li>
                        <?php
                    endif;
                    ?>
                    <?php if (!empty($_SESSION['__usuarioConectado'])) : ?>
                        <li class="navlink">
                            <a href="/logoff.php" class="navcation font-primary-bold_mediun">Logout</a>
                        </li>
                        <?php
                    endif;
                    ?>


                </ul>
                <div
                    class="toggle-login <?php if (!empty($_SESSION['__falhaLogin']) || !empty($_SESSION['__fazerLogin'])) {
                        echo " active";
                    } ?>"></div>
                <div class="toggle-menu"></div>
            </div>
        </div>
        <div class="login-container background-primary_light
                                <?php if (!empty($_SESSION['__falhaLogin']) || !empty($_SESSION['__fazerLogin'])) {
            echo " active";
        } ?>
                            ">
            <span class="login-title">Dados do usúario</span>
            <?php if (!empty($_SESSION['__falhaLogin'])) {
                echo '<span class="login-title error">Cpf ou senha invalida, tente novamente!</span>';
            } ?>
            <form action="/login.php" method="post" class="form">
                <div class="form-container">
                    <div class="input">
                        <label class="form-label">Cpf</label>
                        <input type="text" name="__funcionarioCpf" data-mask="000.000.000-00" class="input-box"
                               required="required">
                    </div>
                    <div class="input">
                        <label class="form-label">Senha</label>
                        <input type="password" name="__password" class="input-box" required="required">
                    </div>
                    <div class="button background-secondary btn-primary">
                        <button type="submit" class="btn">Logar</button>
                    </div>
                </div>
            </form>
        </div>
    </header>

    <main class="main container">