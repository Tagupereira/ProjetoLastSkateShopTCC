<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" >
		<link rel="stylesheet" type="text/css" href="../css/style.css" />		
	</head>
</html>

<?php

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
    $id = $_POST['cod'];
	$nome = $_POST['nome'];
	$apelido = $_POST['apelido'];
	$senha = $_POST['senha'];
	$telefone = $_POST['telefone'];
	$email= $_POST['email'];
	$funcao = $_POST['funcao'];
	$situacao = $_POST['situacao'];
	
		
	
	$conect->query("INSERT INTO login(user, senha, telefone, email, funcao, situacao, apelido) VALUES('$nome', '$senha', '$telefone', '$email', '$funcao', '$situacao', '$apelido')");
	
	
	header("location: users.php?msg=cadastroOk");
?>