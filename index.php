
<?php
// Variáveis de acesso ao bando de dados
$host = 'localhost';
$dbname = 'nome_do_banco_de_dados';
$user = 'usuario_do_banco';
$pass = 'senha_do_banco';

// Cria uma instancia da Super Classe PDO
// http://php.net/manual/en/book.pdo.php
$pdo = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

// Verifica se há a variável "doAction" e atribui seu valor a variável "$action"
$action = isset($_GET['doAction'])?$_GET['doAction']:'list';

// A ação é de manipulação do banco de dados
if(in_array($action, array('insert', 'update', 'delete')))
{
	// A tabela que será utilizada
	$tableName = 'tabela_usuarios';
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
?>

<!-- Header template -->
<?php include_once('header.phtml'); ?>



<!-- Header template -->
<?php include_once('header.phtml'); ?>

<?php
};	
?>
