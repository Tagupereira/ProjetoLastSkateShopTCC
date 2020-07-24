<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
    $descricao = "$_POST[descricao]";
	$ocorrencia = "$_POST[ocorrencia]";
	$pagamento = "$_POST[pagamento]";
	$data = "$_POST[data]";
	$data = date('Y-m-d', strtotime($data));
	$situacao = "$_POST[situacao]";
	$valor = "$_POST[valor]";
		
	$conect->query("INSERT INTO contasapagar(descricao, pagamento, dataVencimento, valor, situacao, ocorrencia) VALUES('$descricao', '$pagamento', '$data', '$valor', '$situacao', '$ocorrencia')");
	
	
	header("location: apagar.php?msg=cadastroOk");
?>