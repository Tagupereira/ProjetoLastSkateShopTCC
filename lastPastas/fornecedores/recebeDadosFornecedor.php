<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
	/*$pagina = mysqli_query($conect, "SELECT max(pagina) FROM clientes");
	$countPage = mysqli_query($conect, "SELECT count(pagina) FROM clientes");
	if($pagina > $countPage ){}*/
	
    $nome = "$_POST[nome]";
	$telefone = "$_POST[telefone]";
	$celular = "$_POST[celular]";
    $email = "$_POST[email]";
	$site = "$_POST[site]";
	
		
	
	$conect->query("INSERT INTO fornecedor(razao_social, telefone, celular, email, web) VALUES('$nome', '$telefone', '$celular', '$email', '$site')");
	
	
	header("location: fornecedores.php?msg=cadastroOk");
?>