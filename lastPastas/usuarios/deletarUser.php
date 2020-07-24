<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

// aqui voce conecta ao banco
include "../conexaoBanco/conexao.php";

// aqui a variavel $rm recebe o valor do banco enviado do formulario
$id = $_GET['cod'];

//executa uma consulta e deleta no banco
$sqld = "DELETE FROM login WHERE cod=$id";

$query = $conect -> query($sqld);

// retorna a pagina de listagem do banco

header('Location: users.php?msg=excluidoOk');


?>