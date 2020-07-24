<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
	$id = $_POST['id'];
    $descricao = $_POST['descricao'];
	$ocorrencia = $_POST['ocorrencia'];
	$pagamento = $_POST['pagamento'];
	$data = $_POST['data'];
	$data = date('Y-m-d', strtotime($data));
	$situacao = $_POST['situacao'];
	$valor = $_POST['valor'];
		
	$conect->query("UPDATE contasapagar SET descricao='$descricao', pagamento='$pagamento', dataVencimento='$data', situacao='$situacao', valor='$valor', ocorrencia='$ocorrencia' WHERE id='$id'");
	
	header("location: apagar.php?msg=alteradoOk");
?>