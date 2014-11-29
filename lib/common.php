<?php
// Definições da aplicação
// Separador de pastas UNIX =  '/', WINDOWS = '\'
define('DS', DIRECTORY_SEPARATOR);
// Pasta principal da aplicação
$root_path = dirname(dirname(__FILE__));
// Define /PATH/? para /PATH/
$root_path = rtrim($root_path, DS).DS;
define('ROOT_PATH', $root_path);
// Pasta de bibliotecas da aplicação
define('LIB_PATH', ROOT_PATH.'lib'.DS);
// Pasta de templates da aplicação
define('TPL_PATH', ROOT_PATH.'tpl'.DS);

// Chama o arquivo de acesso a banco de dados
require_once('db.php');

?>
