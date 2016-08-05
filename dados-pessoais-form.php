<h5 class="form-sub-title">Dados pessoais</h5>

<div class="input">
    <label class="form-label">Nome</label>
    <input type="text" name="nome" value="<?php
    if (array_key_exists("nome", $funcionario)) {
        echo $funcionario['nome'];
    }
    if (array_key_exists("funcionarioNome", $funcionario)) {
        echo $funcionario['funcionarioNome'];
    } ?>" class="input-box" required>
    <?php if (array_key_exists("nome", $funcionariosErros)) : ?>
        <span class="error"><?= $funcionariosErros['nome'] ?></span>
        <?php
    endif;
    ?>
</div>

<div class="input-half">
    <div class="input">
        <label class="form-label">Cpf</label>
        <input type="text" name="cpf" value="<?php if (array_key_exists("cpf", $funcionario)) {
            echo $funcionario['cpf'];
        } ?>" data-mask="000.000.000-00" class="input-box input-mediun" required>
        <?php if (array_key_exists("cpf", $funcionariosErros)) : ?>
            <span class="error"><?= $funcionariosErros['cpf'] ?></span>
            <?php
        endif;
        ?>
    </div>
    <div class="input">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="<?php if (array_key_exists("email", $funcionario)) {
            echo $funcionario['email'];
        } ?>" class="input-box" required>
        <?php if (array_key_exists("email", $funcionariosErros)) : ?>
            <span class="error"><?= $funcionariosErros['email'] ?></span>
            <?php
        endif;
        ?>
    </div>
</div>


<div class="input-half">
    <div class="input">
        <label class="form-label">Data do nascimento</label>
        <input type="text" name="dataNascimento" value="<?php
        if (array_key_exists("data_nascimento", $funcionario)) {
            $timestamp = strtotime($funcionario['data_nascimento']);
            $new_date = date('d/m/Y', $timestamp);
            echo $new_date;
        }
        if (array_key_exists("dataNascimento", $funcionario)) {
            echo $funcionario['dataNascimento'];
        }
        ?>" data-mask="00/00/0000" class="input-box input-mediun" required>
        <?php if (array_key_exists("dataNascimento", $funcionariosErros)) : ?>
            <span class="error"><?= $funcionariosErros['dataNascimento'] ?></span>
            <?php
        endif;
        ?>
    </div>
    <div class="input">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" value="<?php if (array_key_exists("telefone", $funcionario)) {
            echo $funcionario['telefone'];
        } ?>" data-mask="(00)00000-0000" class="input-box input-mediun" required>
        <?php if (array_key_exists("telefone", $funcionariosErros)) : ?>
            <span class="error"><?= $funcionariosErros['telefone'] ?></span>
            <?php
        endif;
        ?>
    </div>
</div>

<div class="input-half">
    <div class="input input-mediun file-input">
        <label class="form-label">Filho</label>
        <select name="filho" class="input-box input-mediun select-box" required>
            <option value="" disabled selected>Escolha uma opção</option>
            <option
                <?php if (array_key_exists("filho", $funcionario)) : ?>
                    <?php if (!$funcionario['filho']) echo "selected='selected'"; ?>
                    <?php
                endif;
                ?>
                <?php if (array_key_exists("quantidadeFilhos", $funcionariosErros)) : echo "selected='selected'"; ?>
                    <?php
                endif;
                ?>
                value="false">Não
            </option>
            <option value="true"
                <?php if (array_key_exists("filho", $funcionario)) : ?>
                    <?php if ($funcionario['filho']) echo "selected='selected'"; ?>
                    <?php
                endif;
                ?>
            >Sim
            </option>
        </select>
        <?php if (array_key_exists("filho", $funcionariosErros)) : ?>
            <span class="error"><?= $funcionariosErros['filho'] ?></span>
            <?php
        endif;
        ?>
    </div>
    <div class="input input-mediun file-input">
        <label class="form-label">Quantos filhos</label>
        <input type="text" name="quantidadeFilhos"
               value="<?php if (array_key_exists("quantidade_filhos", $funcionario)) {
                   echo $funcionario['quantidade_filhos'];
               } ?>" data-mask="0" class="input-box input-mediun file-input">
        <?php if (array_key_exists("quantidadeFilhos", $funcionariosErros)) : ?>
            <span class="error"><?= $funcionariosErros['quantidadeFilhos'] ?></span>
            <?php
        endif;
        ?>
    </div>
</div>
<div class="input">
    <label class="form-label">Cargo</label>
    <select name="__cargo" class="input-box input-mediun select-box" required>
        <option value="" disabled selected>Selecione o cargo</option>
        <?php
        foreach ($cargos as $cargo) : ?>
            <option
                <?php
                if ($funciCargoId == $cargo['id']) {
                    echo 'selected="selected"';
                }

                ?>
                value="<?php echo $cargo['id'];

                ?>" <?php if (array_key_exists('cargoEscolha', $cargoEscolhido)) {
                if ($cargoEscolhido['cargoEscolha'] == $cargo['id']) {
                    echo "selected='selected'";
                }
            } ?>><?php echo $cargo['nome']; ?></option>
            <?php
        endforeach;
        ?>
    </select>
    <?php if (array_key_exists("cargo", $cargoErro)) : ?>
        <span class="error"><?= $cargoErro['cargo'] ?></span>
        <?php
    endif;
    ?>
</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		