<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");
	include ("../conexao/conexao.php");
	//aqui são as variaveis que iram receber o valor do form
   
	$pesquisa = "$_POST[pesquisaEvento]";
			
	
	$conect->query("SELECT * FROM agenda WHERE evento=$pesquisa");
	
	$busca = $conect;
	
	header("location: agenda.php");
?>