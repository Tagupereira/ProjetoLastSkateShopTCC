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
	$quitado = "$_POST[situacao]";
	$dataCompen = "$_POST[datacompensacao]";
	$valor = "$_POST[valor]";
		
	
	$conect->query("INSERT INTO contasareceber(descricao, pagamento, dataVencimento, valor, situacao, ocorrencia, datarecebimento) VALUES('$descricao', '$pagamento', '$data', '$valor', '$quitado', '$ocorrencia', '$dataCompen')");
	
	
	header("location: areceber.php?msg=cadastradoOk");
?>