<?php
	include "../conexaoBanco/conexao.php";
	
	$login1 = $_POST['login1'];
	$senha1 = $_POST['senha1'];
	$senha2 = $_POST['senha2'];
	
	
	
	$check = $conect -> query("SELECT * FROM login WHERE user='$login1', senha='$senha1' ");
	
	if($check == 1)
	{
		echo'Login ja cadastrado';
	}
	else if($senha1!= $senha2)
	{
		echo'Senhas Divergentes';
	}
	else{
		$conect->query("INSERT INTO login(user, senha, funcao) VALUES('$login1','$senha1','administrador')");
		
		echo "cadastrado com sucesso";
		
	}
?>
<html>
	<head>
		<meta charset="UTF-8" >
		<!-- direciona para um link <meta http-equiv="refresh" content=1;url="home.html"> -->
		<link rel="stylesheet" style="text/css" href="../css/style.css">
	</head>
	<center>
		<a href="../index.php"><button id="button">VOLTAR</button></a><br /><br />
	</center>
</html>
