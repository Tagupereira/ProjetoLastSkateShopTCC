<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
	/*$pagina = mysqli_query($conect, "SELECT max(pagina) FROM clientes");
	$countPage = mysqli_query($conect, "SELECT count(pagina) FROM clientes");
	if($pagina > $countPage ){}*/
	
    $nome = "$_POST[nome]";
	$whatsapp = "$_POST[whatsapp]";
	$instagram = "$_POST[instagram]";
    $facebook = "$_POST[facebook]";
	$email = "$_POST[email]";
	
		
	
	$conect->query("INSERT INTO clientes(nome, whatsapp, instagram, facebook, email, situacao, dataCadastro) VALUES('$nome', '$whatsapp', '$instagram', '$facebook', '$email', 'ativo', NOW())");
	
	
	header("location: clientes.php?msg=cadastroOk");
?>