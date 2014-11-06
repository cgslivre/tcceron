
<?php
$host = 'localhost';
$dbname = 'nome_do_banco_de_dados';
$user = 'usuario_do_banco';
$pass = 'senha_do_banco';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

$postData = $_POST;
if(isset($_GET['doAction']))
{
	$action = $_GET['doAction'];
	$tableName = 'tabela_usuarios';
	switch($action)
	{
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
		case 'update':
			$postData = $_POST;
			
		break;
		case 'delete':
			
		break;
	}
}
?>

<html>
	<head></head>
	<body>
	
	
	</body>
</html>

<?php
	endif;	
?>
