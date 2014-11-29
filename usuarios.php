
<?php
// Carrega o arquivo de configurações e funçoes comuns da aplicação
require_once('lib/common.php');

// Verifica se há a variável "doAction" e atribui seu valor a variável "$action"
$action = isset($_GET['doAction'])?$_GET['doAction']:'list';

// A tabela que será utilizada
$tableName = 'tabela_usuarios';

// A ação é de manipulação do banco de dados
if(in_array($action, array('insert', 'update', 'delete')))
{
	// Executa a ação
	switch($action)
	{
		// Novo registro
		case 'insert':
			$postData = array(
				':nome' => $_POST['nome'],
				':email' => $_POST['email'],
				':usuario' => $_POST['usuario'],
				':senha' => $_POST['senha']
			);
			$sql = "INSERT INTO $tableName('nome', 'email', 'usuario', 'senha') VALUES(:nome, :email, :usuario, :senha)";
			$query = $pdo->prepare( $sql );
			$query->execute( $postData );
		break;
		
		// Atualizar registro existente
		case 'update':
			$postData = $_POST;
			
		break;
		
		// Excluir registro
		case 'delete':
			
		break;
	}
}
// A ação é de listagem, cadastro ou edição, ou seja, exibir algo na tela para o usuário
else
{
	if($action == 'list'){
		
		// Monta a sql de consulta ao banco, prepara a execução e processa a mesma
		$sql = "SELECT id, nome, email, usuario FROM $tableName";
		$stm = $pdo->prepare( $sql );
		$stm->execute();
		// Processa o resultado em um array associativo
		$results = $stm->fetch( PDO::FETCH_ASSOC );
		// Carrega o template correspondente
		include_once(TPL_PATH.'usuarios/list.phtml');
		
	}elseif($action == 'add' || $action == 'edit')
	{
		// Dados do usuário
		$userData = array();
		if($action == 'edit')
		{
			$id = isset($_GET['id'])?$_GET['id']:false;
			// Monta a sql de consulta ao banco, prepara a execução e processa a mesma
			$sql = "SELECT id, nome, email, usuario FROM $tableName WHERE id = :id";
			$stm = $pdo->prepare( $sql );
			$stm->execute( array( ':id' => $id ) );
			// Processa o resultado em um array associativo
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			// Caso não retorne um registro válido
			if( !isset( $result['id'] ) )
			{
				// Imprime mensagem de erro
				echo '
				<h1>Usuário inválido</h1>
				<p>O registro '.$id.' não existe no banco de dados</p>
				<br />
				<br />
				<a href="index.php" title="Retornar a página anterior">Voltar</a>';
				// Termina a aplicação;
				exit();
			}
			// Atribui os dados do banco a váriavel $userData
			$userData = $result;
		}
		// Carrega o template correspondente
		include_once(TPL_PATH.'usuarios/form.phtml');
	}
};	
?>
