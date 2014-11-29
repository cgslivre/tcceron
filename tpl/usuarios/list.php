<?php
// Header template
include_once(TPL_PATH.'header.php');
?>

<h1>Usuários cadastrados</h1>
<table>

	<thead>
		<tr>
			<th>ID</th>
			<th>NOME</th>
			<th>EMAIL</th>
			<th>USUÁRIO</th>
			<th>::::</th>
		</tr>
	</thead>
	
	<tbody>
		
	<?php if(!isset($results) || count($results) == 0) :?>
		
		<tr>
			<td colspan="5">Nenhum usuário cadastrado! <a href="usuarios.php?doAction=update">[ Cadastrar ]</a></td>
		</tr>
		
	<?php 
	else: 
		foreach($results as $row):
	?>
	
		<tr>
			<td> <?php echo $row['id']; ?> </td>
			<td> <?php echo $row['nome']; ?> </td>
			<td> <?php echo $row['email']; ?> </td>
			<td> <?php echo $row['usuario']; ?> </td>
			<td>
				<a href="usuarios.php?doAction=update">[ Editar ] </a> - 
				<a href="usuarios.php?doAction=delete">[ Excluir ]</a>
			</td>
		</tr>
	
	<?php 
		endforeach;
	endif; 
	?>
		
	</tbody>

</table>

<br />

<a href="usuarios.php?doAction=update">[ Novo usuário ]</a>

<?php
// Header template
include_once(TPL_PATH.'footer.php');
?>
