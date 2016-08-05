<div class="func-dados_completos">
    <div class="list-result">
        <table class="table-container">
            <tr class="background-secondary-dark_light">
                <th class="table-title">Nome</th>
                <th class="table-title">Cpf</th>
                <th class="table-title">Email</th>
                <th class="table-title">Telefone</th>
                <th class="table-title">Nascimento</th>
                <th class="table-title">Filhos</th>
                <th class="table-title">Cargo</th>
                <th class="table-title">Opções</th>
            </tr>

            <?php foreach ($funcDados as $funcionario) : ?>
            <tr class="container-info">
                <td class="table-data"><?php echo $funcionario['funcionarioNome'] ?></td>
                <td class="table-data"><?php echo $funcionario['cpf'] ?></td>
                <td class="table-data"><?php echo $funcionario['email'] ?></td>
                <td class="table-data"><?php echo $funcionario['telefone'] ?></td>
                <td class="table-data"><?php
                    $timestamp = strtotime($funcionario['data_nascimento']);
                    echo $new_date = date('d/m/Y', $timestamp); ?></td>
                <td class="table-data"><?php echo $funcionario['filho'] ?></td>
                <td class="table-data"><?php echo $funcionario['cargoNome']?></td>
                <td class="table-data">
                    <div class="options">
                        <form action="alterar-func-dados.php" method="POST" class="table-opt">
                            <input type="hidden" name="funci_id" value="<?php echo $funcionario['funcionarioId'] ?>">
                            <button type="submit" class="btn alterar"><img class="opt-ico" src="resources/img/edit.png" title="Editar os dados"></button>
                        </form>
                        <div class="table-opt usuario-sistema">
                            <input type="hidden" name="funci_id" value="<?php echo $funcionario['funcionarioId'] ?>">
                            <div class="btn user-btn"><img class="opt-ico" src="resources/img/user.png" title="Adicionar como usuário do sistema"></div>
                            <div class="usuario-sistema-form hidden"></div>
                            <div class="add-user-system hidden">
                                <fieldset class="form-field user-form">
                                    <form action="cad-usuario.php" method="post" class="form">
                                        <span class="info-hidden-class">Usuário do sistema: <?php echo $funcionario['funcionarioNome'] ?></span>
                                        <samp class="deletar-perg">Deseja adicionar como um usuário do sistema?</samp>
                                        <div class="input-conatiner">
                                            <div class="input">
                                                <label class="form-label">Digite a senha</label>
                                                <input type="password" name="password" required class="input-box">
                                            </div>
                                            <input type="hidden" name="funcionarioId" value="<?php echo $funcionario['funcionarioId'] ?>">
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
                        </div>
                        <div class="table-opt">
                            <button class="btn deletar"><img class="opt-ico" src="resources/img/delete-icon-5.png" title="Excluir esse funcionário"></button>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <h6 class="text-center">Endereço</h6>
        <table class="table-container">
            <tr class="background-secondary-dark_light">
                <th class="table-title">Cep</th>
                <th class="table-title">Logradouro</th>
                <th class="table-title">Número</th>
                <th class="table-title">Complmento</th>
                <th class="table-title">Bairro</th>
                <th class="table-title">Cidade</th>
                <th class="table-title">Estado</th>
                <th class="table-title">Atualizar</th>
            </tr>

            <tr class="container-info">
                <td class="table-data"><?php echo $funcionario['cep'] ?></td>
                <td class="table-data"><?php echo $funcionario['logradouro'] ?></td>
                <td class="table-data"><?php echo $funcionario['numero'] ?></td>
                <td class="table-data"><?php if ($funcionario['complemento'] == "") { echo '-';}
                    else{echo $funcionario['complemento'];} ?></td>
                <td class="table-data"><?php echo $funcionario['bairro'] ?></td>
                <td class="table-data"><?php echo $funcionario['cidade']?></td>
                <td class="table-data"><?php echo $funcionario['estado']?></td>
                <td class="table-data">
                    <div class="options">
                        <form action="endereco-alterar.php" method="POST" class="table-opt">
                            <input type="hidden" name="__id" value="<?php echo $funcionario['enderecoId'] ?>">
                            <button type="submit" class="btn alterar"><img class="opt-ico" src="resources/img/edit.png" title="Atualizar endereço"></button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
        <div class="warm-deletar hidden">
            <div class="conf-excluir-opac">
            </div>
            <div class="conf-excluir">
                <div class="form-deletar">
                    <span class="info-hidden-class">Excluir funcionário: <?php echo $funcionario['funcionarioNome'];?></span>
                    <samp class="deletar-perg">Deseja excluir esse funcionário?</samp>
                    <div class="deletar-form">
                        <form action="funcionario-deletar.php" method="POST" class="delete-form-cont">
                            <input type="hidden" name="funci_id" value="<?php echo $funcionario['funcionarioId'] ?>">
                            <div class="form-btn-opt">
                                <div class="button">
                                    <button class="btn confirmar">Confirmar</button>
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
        <?php
        endforeach;
        ?>
    </div>
</div>