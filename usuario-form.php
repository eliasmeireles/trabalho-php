<?php
include 'menu.php';
$usuariosErros = array();
$usuario = array();
?>

    <div class="page-container">
        <div class="page-menu">
            <ul class="menu-list">
                <li class="navlink">
                    <a href="usuarios-lista.php" class="navcation font-primary-bold_mediun">Lista</a>
                </li>
                <li class="navlink active">
                    <a href="usuario-form.php" class="navcation font-primary-bold_mediun">Adicinar</a>
                </li>
                <li class="navlink">
                    <a href="gera-usuarios-relatorio.php" class="navcation font-primary-bold_mediun">Relatório</a>
                </li>
            </ul>
        </div>

        <h2 class="text-center">Cadastrar novo usuário do sistema</h2>

        <form action="cadastrar-usuario.php" method="POST" class="form usuario-cad" enctype="multipart/form-data">

            <div class="form-container">

                <div class="input-conatiner">

                    <div class="cool-form">
                        <div class="input-half">
                            <div class="input">
                                <label class="form-label">Cpf</label>
                                <input type="text" name="cpf" required="required" data-mask="000.000.000-00"
                                       class="input-box input-mediun">
                            </div>
                            <div class="input">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" required="required" class="input-box">
                            </div>
                        </div>
                        <div class="input">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" required="required" class="input-box">
                        </div>
                    </div>
                </div>

                <div class="button background-secondary btn-primary">
                    <button type="submit" class="btn">Cadastrar</button>
                </div>
            </div>
        </form>

        <p class="msg-info">Ao cadastrar novo usuário, esse mesmo terá livre acesso a todo o sistema!</p>
    </div>
<?php include 'footer.php'; ?>