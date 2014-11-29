<?php
// Header template
include_once(TPL_PATH.'header.php');
?>

<form method="post" action="usuarios.php?doAction=<?php echo isset($userData['id'])?"update":"insert"; ?>">
	<fieldset>
	
		<p>
			<label for="nome"></label>
			<input type="text" name="nome" value="<?php echo isset($userData['nome'])?$userData['nome']:""; ?>" />
		</p>
		
		<p>
			<label for="email"></label>
			<input type="text" name="email" value="<?php echo isset($userData['email'])?$userData['email']:""; ?>" />
		</p>
		
		<p>
			<label for="usuario"></label>
			<input type="text" name="usuario" value="<?php echo isset($userData['usuario'])?$userData['usuario']:""; ?>" />
		</p>
		
		<p>
			<label for="senha"></label>
			<input type="password" name="senha" value="" />
		</p>
		
		<p>
			<button type="submit">Salvar dados</button>
			<a href="usuarios.php" title="Cancelar edição">Cancelar</a>
		</p>
	
	</fieldset>
</form>

<?php
// Header template
include_once(TPL_PATH.'footer.php');
?>
