<?php
include 'menu.php'; ?>
<?php
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';

$funcDados = array();
$porCargo = "";
$porEstado = "";
$porFilho = "";
$selecionados = array();
$selecionados['estado'] = "";
$selecionados['filho'] = "";
$selecionados['cargo'] = "";

if (isset($_POST['__cargo'])) {
    $porCargo = $_POST['__cargo'];
    $porEstado = $_POST['__estado'];
    $porFilho = $_POST['__filho'];
    if ($porCargo == "") {
        $cargoQury = ' 1 = 1 ';
    } else {
        $cargoQury = " c.id = '$porCargo' ";
        $selecionados['cargo'] = $porCargo;
    }
    if ($porEstado == "") {
        $estado = ' 1 = 1 ';
    } else {
        $estado = " e.estado_id = '$porEstado' ";
        $selecionados['estado'] = $porEstado;
    }
    if ($porFilho == "") {
        $filho = ' 1 = 1 ';
    } else {
        $filho = " f.filho = '$porFilho' ";
        $selecionados['filho'] = $porFilho;
    }

    $query = "SELECT f.id, f.nome AS funcionarioNome, f.email, f.cpf, f.data_nascimento, f.telefone, f.filho, f.quantidade_filhos, c.nome AS cargoNome, e.cep, 
            e.logradouro, e.numero, e.complemento, e.bairro, e.cidade, es.nome AS estado 
            FROM cargo_funcionario cf
            JOIN cargo c ON c.id = cf.cargo_id
            JOIN funcionario f ON f.id = cf.funcionario_id
            JOIN endereco e ON e.funcionario_id = f.id
            jOIN estados es ON e.estado_id = es.id WHERE $cargoQury and $estado and $filho";


    $func = new Funcionario();
    $endereco = new Endereco($func);

    $funcDao = new FuncionarioDao($conexao, $func);
    $enderecoDao = new EnderecoDao($conexao, $endereco);
    $funcDados = $funcDao->selectPorFiltro($query);
    $porFilho = $_POST['__filho'];
}
$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();
?>
    <div class="page-container">
        <div class="page-menu">
            <ul class="menu-list">
                <li class="navlink active">
                    <a href="funcionarios.php" class="navcation font-primary-bold_mediun">Filtrar</a>
                </li>
                <li class="navlink">
                    <a href="funcionario-form.php" class="navcation font-primary-bold_mediun">Cadastrar</a>
                </li>
                <li class="navlink">
                    <a href="localiza-funcionario.php" class="navcation font-primary-bold_mediun">Localizar</a>
                </li>
                <li class="navlink">
                    <a href="grafico-cargos-funcionarios.php" class="navcation font-primary-bold_mediun">Gráfico</a>
                </li>
                <li class="navlink">
                    <a href="funcionarios-relatorio.php" class="navcation font-primary-bold_mediun">Relatório</a>
                </li>
            </ul>
        </div>
        <div class="coll">
            <div class="filtrar-funcionario">
                <h6 class="text-center">Localizar funcionários por categoria</h6>
                <fieldset class="form-field">
                    <legend class="field-legend">Filtrar funcionários</legend>
                    <form action="funcionarios.php" method="POST" class="form" enctype="multipart/form-data">
                        <div class="form-container">
                            <div class="input-conatiner">
                                <div class="input-half">
                                    <div class="input">
                                        <label class="form-label">Cargo</label>
                                        <select name="__cargo" class="input-box input-mediun select-box">
                                            <option value="">Selecione o cargo</option>
                                            <?php
                                            foreach ($cargos as $cargo) : ?>
                                                <option
                                                    value="<?php echo $cargo['id'] ?>"
                                                    <?php if ($selecionados['cargo'] == $cargo['id']) {
                                                        echo 'selected';
                                                    } ?>>
                                                    <?php echo $cargo['nome'] ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input">
                                        <label class="form-label">Filtra por filhos</label>
                                        <select name="__filho" class="input-box input-mediun select-box">
                                            <option value="">Ecolha uma opção</option>
                                            <option value="1" <?php if ($selecionados['filho'] == "1") {
                                                echo 'selected';
                                            } ?>>Sim
                                            </option>
                                            <option value="0" <?php if ($selecionados['filho'] == "0") {
                                                echo 'selected';
                                            } ?>>Não
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input">
                                    <label class="form-label">Estado</label>
                                    <select name="__estado" class="input-box input-mediun select-box">
                                        <option value="">Selecione o estado</option>
                                        <?php
                                        foreach ($estados as $estado) : ?>
                                            <option
                                                value="<?php echo $estado['id'] ?>" <?php if ($selecionados['estado'] == $estado['id']) {
                                                echo 'selected';
                                            } ?>>
                                                <?php echo $estado['nome'] ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="button background-secondary btn-primary">
                                    <button type="submit" class="btn">Localizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>
                <p class="cadastrar-cargo-info msg-info">Caso não tenha nenhuma opção selecionada, serão localizados
                    todos
                    os funcionários
                    já registrados</p>
            </div>
            <div class="col-list">
                <?php if (isset($_POST['__cargo']) && $funcDados) : ?>
                    <div class="list-result">
                        <h6 class="text-center">Total relativo a sua pesquisa é: <?php echo sizeof($funcDados); ?></h6>
                        <table class="table-container">
                            <tr class="background-secondary-dark_light">
                                <th class="table-title">Nome</th>
                                <th class="table-title">Cpf</th>
                                <th class="table-title">Cargo</th>
                                <th class="table-title">Estado</th>
                                <th class="table-title">Filhos</th>
                                <th class="table-title">Dados completos</th>
                            </tr>

                            <?php foreach ($funcDados as $funcionario) : ?>
                                <tr class="container-info">
                                    <td class="table-data"><?php echo $funcionario['funcionarioNome'] ?></td>
                                    <td class="table-data"><?php echo $funcionario['cpf'] ?></td>
                                    <td class="table-data"><?php echo $funcionario['cargoNome'] ?></td>
                                    <td class="table-data"><?php echo $funcionario['estado'] ?></td>
                                    <td class="table-data"><?php echo $funcionario['filho'] ?></td>
                                    <td class="table-data">
                                        <div class="options">
                                            <form action="dados-completos.php" method="POST" class="table-opt">
                                                <input type="hidden" name="funci_id"
                                                       value="<?php echo $funcionario['id'] ?>">
                                                <button type="submit" class="btn"><img class="opt-ico" src="resources/img/plan.png" title="Click aqui para ver os dados complentos"></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>

                        </table>
                    </div>
                    <?php
                endif;
                ?>

                <?php
                if (isset($_POST['__cargo']) && !$funcDados) : ?>
                    <h6 class="text-center">Nenhum dado relativo a sua pesquisa!</h6>
                    <?php
                endif;
                ?>
                <?php
                if (isset($_SESSION['deleteResult'])) {
                    $res = $_SESSION['deleteResult'];
                    if ($res) {
                        echo '<h6 class="text-center sucesso">O funcionário foi excluido com sucesso</h6>';
                    } else {
                        echo '<h6 class="text-center error">Ocorreu um erro ao tentar excluir o funcionário!</h6>';
                    }
                    unset($_SESSION['deleteResult']);
                }
                if (isset($_SESSION['funcionarioAtualizar'])) {
                    $res = $_SESSION['funcionarioAtualizar'];
                    if ($res) {
                        echo '<h6 class="text-center sucesso">Os dados do funcionário foram aturalizados com sucesso!</h6>';
                    } else {
                        echo '<h6 class="text-center error">Os dados do funcionário não foram aturalizados!</h6>';
                    }
                    unset($_SESSION['funcionarioAtualizar']);
                }
                if (isset($_SESSION['enderecoAtualiza'])) {
                    $res = $_SESSION['enderecoAtualiza'];
                    if ($res) {
                        echo '<h6 class="text-center sucesso">Os dados do endereço foram aturalizados com sucesso!</h6>';
                    } else {
                        echo '<h6 class="text-center error">Os dados do endereço não foram aturalizados!</h6>';
                    }
                    unset($_SESSION['enderecoAtualiza']);
                }
                if (isset($_SESSION['funcionarioCadastrar'])) {
                    $res = $_SESSION['funcionarioCadastrar'];
                    if ($res) {
                        echo '<h6 class="text-center sucesso">O funcionário foi cadastrdo com sucesso!</h6>';
                    } else {
                        echo '<h6 class="text-center error">Ocorreu um erro ao no cadastro, tente novamente!</h6>';
                    }
                    unset($_SESSION['funcionarioCadastrar']);
                }
                ?>
            </div>
        </div>
    </div>
<?php
include 'footer.php';
?>