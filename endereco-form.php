<h5 class="form-sub-title">Endereço</h5>
						
	<div class="input">
		<label class="form-label">Cep</label>
		<input type="text" name="cep" value="<?php if (array_key_exists("cep", $endereco)) { echo $endereco['cep'];}?>" data-mask="00000.000" class="input-box">
		<?php if (array_key_exists("cep", $enderecoErros)) : ?>
			<span class="error"><?=$enderecoErros['cep']?></span>
		<?php 
			endif;
		?>
	</div>
	
	<div class="input">
		<label class="form-label">Logradouro</label>
		<input type="text" name="logradouro" value="<?php if (array_key_exists("logradouro", $endereco)) { echo $endereco['logradouro'];}?>" class="input-box">
		<?php if (array_key_exists("logradouro", $enderecoErros)) : ?>
			<span class="error"><?=$enderecoErros['logradouro']?></span>
		<?php 
			endif;
		?>
	</div>
	
	<div class="input-half">
		<div class="input">
			<label class="form-label">Numero</label>
			<input type="text" name="numero" value="<?php if (array_key_exists("numero", $endereco)) { echo $endereco['numero'];}?>" class="input-box input-mediun">
			<?php if (array_key_exists("numero", $enderecoErros)) : ?>
			<span class="error"><?=$enderecoErros['numero']?></span>
			<?php 
				endif;
			?>
		</div>
		<div class="input">
			<label class="form-label">Complemento</label>
			<input type="text" name="complemento" value="<?php if (array_key_exists("complemento", $endereco)) { echo $endereco['complemento'];}?>" class="input-box input-mediun">
			<?php if (array_key_exists("complemento", $enderecoErros)) : ?>
			<span class="error"><?=$enderecoErros['complemento']?></span>
			<?php 
				endif;
			?>
		</div>
	</div>
	<div class="input">
		<label class="form-label">Bairro</label>
		<input type="text" name="bairro" value="<?php if (array_key_exists("bairro", $endereco)) { echo $endereco['bairro'];}?>" class="input-box">
		<?php if (array_key_exists("bairro", $enderecoErros)) : ?>
			<span class="error"><?=$enderecoErros['bairro']?></span>
		<?php 
			endif;
		?>
	</div>
	
	<div class="input-half">
		<div class="input">
			<label class="form-label">Cidade</label>
			<input type="text" name="cidade" value="<?php if (array_key_exists("cidade", $endereco)) { echo $endereco['cidade'];}?>" class="input-box input-mediun">
			<?php if (array_key_exists("cidade", $enderecoErros)) : ?>
				<span class="error"><?=$enderecoErros['cidade']?></span>
			<?php 
				endif;
			?>
		</div>
		
		<div class="input">
			<label class="form-label">Estado</label>
			<select name="estado" class="input-box input-mediun select-box" required>
				<option value="" selected disabled>Selecione o estado</option>
				<?php
					foreach ($estados as $estado) : ?>
						<option
						<?php
						if (array_key_exists("estado", $endereco)) {
							if ($endereco['estado'] == $estado['id']){
								echo "selected='selected'";
							}
						}
						if (array_key_exists("estado_id", $endereco)) {
							if ($endereco['estado_id'] == $estado['id']){
								echo "selected='selected'";
							}
						}
						?>
						value="<?php echo $estado['id'] ?>"><?php echo $estado['nome'] ?></option>
					<?php 
						endforeach;
					?>
			</select>
			<?php if (array_key_exists("estado", $enderecoErros)) : ?>
				<span class="error"><?=$enderecoErros['estado']?></span>
			<?php
				endif;
			?>
		</div>
	</div>