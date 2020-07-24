<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

// aqui voce conecta ao banco
include "../conexaoBanco/conexao.php";

// aqui a variavel $rm recebe o valor do banco enviado do formulario
$id = $_GET["id"];

//executa uma consulta e deleta no banco
$sqld = "DELETE FROM contasapagar WHERE id=$id";

$query = $conect -> query($sqld);

// retorna a pagina de listagem do banco

header('Location: apagar.php?msg=excluidoOk');


?>