
<?php
// Carrega o arquivo de configurações e funçoes comuns da aplicação
require_once('lib/common.php');

// A tabela que será utilizada
$tableName = 'tabela_usuarios';

// Url principal da aplicação
$redirectUrl = 'usuarios.php?';

// Paramentros da URL ex: array('id' => 1) ==> ?id=1
$redirectUrlQueryString = array();

// Verifica se há a variável "doAction" e atribui seu valor a variável "$action"
$action = isset($_GET['doAction'])?$_GET['doAction']:'list';

// A ação é de manipulação do banco de dados
if(in_array($action, array('insert', 'update', 'delete')))
{
	// String SQL que srá utilizada
	$sql = '';
	// Array com os valores a serem parseados pelo PDO
	$pdoBindingValues = array();
	// Executa a ação
	switch($action)
	{
		// Novo registro
		case 'insert':
			// Prepara a SQL para inserção no bando
			$sql = "INSERT INTO $tableName('nome', 'email', 'usuario', 'senha') VALUES(:nome, :email, :usuario, :senha)";
			// Variáveis(bind) para parseamento pelo PDO
			$pdoBindingValues = array(
				':nome' => $_POST['nome'],
				':email' => $_POST['email'],
				':usuario' => $_POST['usuario'],
				':senha' => $_POST['senha']
			);
			if(db_query($sql, $pdoBI))
			{
				// Define as opções de redirecionamento
				$redirectUrlQueryString = array(
					'doAction' => 'list'	
				);
			}
			else
			{
				// Define as opções de redirecionamento
				$redirectUrlQueryString = array(
					'doAction' => 'add'	
				);
			}
		break;
		
		// Atualizar registro existente
		case 'update':
			$sql = "UPDATE $tableName SET 'nome' = :nome, 'email' = :email, 'usuario' = :usuario WHERE id = :id";
			$pdoBindingValues = array(
				':nome' => $_POST['nome'],
				':email' => $_POST['email'],
				':usuario' => $_POST['usuario'],
				':id' => $_GET['id'],
			);
			if(db_query($sql, $pdoBI))
			{
				$redirectUrlQueryString = array(
					'doAction' => 'list'
				);
			}
			else
			{
				$redirectUrlQueryString = array(
					'doAction' => 'edit',
					'id' => $_GET['id']
				);
			}
		break;
		
		// Excluir registro
		case 'delete':
			$sql = "DELETE FROM $tableName WHERE id = :id";
			$pdoBindingValues = array(':id' => $_GET['id']);
			db_query($sql, $pdoBI);
			$redirectUrlQueryString = array(
				'doAction' => 'list'	
			);
		break;
	}
	// Prepara a URL de retorno da aplicação
	$redirectUrl = $redirectUrl.http_build_query($redirectUrlQueryString);
	// Remove o último caracter se este for uma interrogação '?'
	$redirectUrl = rtrim($redirectUrl, '?');
	// Redireciona a aplicação
	header('location: '.$redirectUrl);
}
// A ação é de listagem, cadastro ou edição, ou seja, exibir algo na tela para o usuário
else
{	
	// Listagem de registros cadastrados no banco de dados
	if($action == 'list'){
		
		// Monta a sql de consulta ao banco, prepara a execução e processa a mesma
		$sql = "SELECT id, nome, email, usuario FROM $tableName";
		$stm = db_query($sql, array());
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
			$stm = db_query($sql, array( ':id' => $id ));
			// Processa o resultado em um array associativo
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			// Caso não retorne um registro válido
			if( !count( $result ) )
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
			$userData = (array)$result[0];
		}
		// Carrega o template correspondente
		include_once(TPL_PATH.'usuarios/form.phtml');
	}
};	
?>
