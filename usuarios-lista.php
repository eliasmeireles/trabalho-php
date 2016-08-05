<?php include 'menu.php';
require_once 'class/dao/UsuarioDao.php';
require_once 'class/model/Usuario.php';

$usuario = new Usuario();

$usuarioDao = new UsuarioDao($conexao, $usuario);

$funcDados = $usuarioDao->selectAll();

?>
    <div class="page-container">
        <div class="page-menu">
            <ul class="menu-list">
                <li class="navlink active">
                    <a href="usuarios-lista.php" class="navcation font-primary-bold_mediun">Lista</a>
                </li>
                <li class="navlink">
                    <a href="usuario-form.php" class="navcation font-primary-bold_mediun">Adicinar</a>
                </li>
                <li class="navlink">
                    <a href="gera-usuarios-relatorio.php" class="navcation font-primary-bold_mediun">Relatório</a>
                </li>
            </ul>
        </div>
        <div class="result-info">
            <?php
            if (isset($_SESSION['senhaAlterar'])) {
                if ($_SESSION['senhaAlterar']) {
                    echo '<h6 class="text-center sucesso">A senha do usuário foi alterada com sucesso!</h6>';
                } else {
                    echo '<h6 class="text-center error">Falha ao tentar alterar a senha do usuário!</h6>';
                }
                unset($_SESSION['senhaAlterar']);
            }
            ?>
        </div>
        <div class="list-result">
            <h6 class="text-center">Lista dos usuários do sistema</h6>
            <table class="table-container">
                <tr class="background-secondary-dark_light">
                    <th class="table-title">Nome</th>
                    <th class="table-title">Cpf</th>
                    <th class="table-title">Email</th>
                    <th class="table-title">Telefone</th>
                    <th class="table-title">Ações</th>
                </tr>

                <?php foreach ($funcDados as $funcionario) : ?>
                    <tr class="container-info">
                        <td class="table-data"><?php echo $funcionario['funcionarioNome'] ?></td>
                        <td class="table-data"><?php echo $funcionario['cpf'] ?></td>
                        <td class="table-data"><?php echo $funcionario['email'] ?></td>
                        <td class="table-data"><?php echo $funcionario['telefone'] ?></td>
                        <td class="table-data">
                            <div class="options">
                                <form action="dados-completos.php" method="POST" class="table-opt">
                                    <input type="hidden" name="funci_id"
                                           value="<?php echo $funcionario['id'] ?>">
                                    <button type="submit" class="btn">
                                        <img class="opt-ico" src="resources/img/plan.png" title="Click aqui para ver os dados complentos">
                                    </button>
                                </form>
                                <div class="table-opt">
                                    <div class="user-data">
                                        <div class="btn user-btn-senha-alterar"><img class="opt-ico" src="resources/img/reset-password.png" title="Alterar senha"></div>
                                        <input type="hidden" value="<?php echo $funcionario['funcionarioNome'] ?>" class="func-nome">
                                        <input type="hidden" value="<?php echo $funcionario['id'] ?> " class="func-id">
                                    </div>
                                </div>
                                <div class="table-opt cargos">
                                    <div class="deleta-cargo-opt">
                                        <div class="btn deletar">
                                            <img class="opt-ico" src="resources/img/delete-icon-5.png"
                                                 title="Excluir esse usuário">
                                        </div>
                                        <div class="deletar-table hidden">
                                            <div class="warm-deletar hidden">
                                                <div class="conf-excluir-opac">
                                                </div>
                                                <div class="conf-excluir">
                                                    <div class="form-deletar">
                                                        <span
                                                            class="info-hidden-class">Excluir usuário: <?php echo $funcionario['funcionarioNome']; ?></span>
                                                        <samp class="deletar-perg">Deseja excluir esse usuário?</samp>
                                                        <div class="deletar-form">
                                                            <form action="remover-usuario.php" method="POST"
                                                                  class="delete-form-cont">
                                                                <input type="hidden" name="funcionarioId"
                                                                       value="<?php echo $funcionario['id'] ?>">
                                                                <div class="form-btn-opt">
                                                                    <div class="button">
                                                                        <button type="submit" class="btn confirmar">Confirmar</button>
                                                                    </div>
                                                                    <div class="button">
                                                                        <span class="btn cancelar cancelar-delete">Cancelar</span>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>

            </table>
        </div>
    </div>
    <div class="usuario-sistema-form hidden"></div>
    <div class="add-user-system hidden">
        <fieldset class="form-field user-form">
            <form action="usuario-alter-senha.php" method="post" class="form">
                <span class="info-hidden-class"></span>
                <samp class="deletar-perg">Deseja alterar essa senha?</samp>
                <div class="input-conatiner">
                    <div class="input">
                        <label class="form-label">Digite a nova senha</label>
                        <input type="password" name="password" required class="input-box">
                    </div>
                    <input type="hidden" name="funcionarioId" value="" class="funcionario-id">
                    <div class="form-btn-opt">
                        <div class="button">
                            <button class="btn confirmar">Confirmar</button>
                        </div>
                        <div class="button">
                            <span class="btn cancelar cancelar-cad">Cancelar</span>
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
<?php include 'footer.php'; ?>