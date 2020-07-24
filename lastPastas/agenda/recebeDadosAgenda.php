<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
   
	$evento = "$_POST[evento]";
	$data = "$_POST[data]";
	$hora = "$_POST[hora]";
	$local = "$_POST[local]";
	$situacao = "$_POST[situacao]";
	$observacao = "$_POST[observacao]";
	
		
	
	$conect->query("INSERT INTO agenda(evento, dataEvento, hora, localidade, situacao, observacao) VALUES('$evento', '$data', '$hora', '$local', '$situacao', '$observacao')");
	
	
	header("location: agenda.php?msg=cadastroOk");
?>