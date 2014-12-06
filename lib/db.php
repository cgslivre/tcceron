<?php

// Variáveis de acesso ao bando de dados
$host   = 'localhost';
$dbname = 'nome_do_banco_de_dados';
$user   = 'usuario_do_banco';
$pass   = 'senha_do_banco';

// Cria uma instancia da Super Classe PDO
// http://php.net/manual/en/book.pdo.php
$pdo = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

function db_query($sql, $bindValues = array(), &$pdo)
{
  	try
	{
		$query = $pdo->prepare( $sql );
		return $query->execute( $bindValues );
	} 
	catch($e)
	{
		return $e->getMessage().'<br />'.$e->getTrace();
	}
}

function db_get(string $tableName, array $columns = array('*'), array $where = array(), $limit = null, $offset = null)
{
	$sql  = array('SELECT');
	if(!is_array($columns)) $columns = array(explode(',', $columns))
	$sql[] = implode(', ', $columns);
	$sql[] = 'FROM';
	$sql[] = $tableName;
	if(!is_array($where)) $where = array($where);
	if(count($where))
	{
		$sql[] = 'WHERE';
		foreach($where as $condition => $clause)
		{
			if(in_array())
		}
	}
}
?>
