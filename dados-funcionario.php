<div class="func-dados">
<h6 class="endereco-title">Dados pessoais</h6>
<span class="func-atr"><span class="func-title">Nome: </span><?php echo $funcionario['nome']?></span>
	<span class="func-atr"><span class="func-title">Email: </span><?php echo $funcionario['email']?></span>
	<span class="func-atr"><span class="func-title">Cpf: </span><?php echo $funcionario['cpf']?></span>
	<span class="func-atr"><span class="func-title">Telefone: </span><?php echo $funcionario['telefone']?></span>
	<span class="func-atr"><span class="func-title">Nascimento: </span>
	<?php 
	
	$timestamp = strtotime($funcionario['data_nascimento']);
	$new_date = date('d/m/Y', $timestamp);
	
	echo $new_date;
	?>
	</span>
	<span class="func-atr"><span class="func-title">Filho: </span><?php
	if ($funcionario['filho']){
		echo "Sim";
	} else{
		echo "Não";
	}?>
	</span>
	
	<?php if ($funcionario['filho']) : ?>
	<span class="func-atr"><span class="func-title">Quantidade de filhos: </span><?php echo $funcionario['quantidade_filhos']?></span>
	<?php
	endif;
	?>
</div>