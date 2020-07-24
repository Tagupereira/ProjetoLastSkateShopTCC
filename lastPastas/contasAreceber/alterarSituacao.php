<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

include ("../conexaoBanco/conexao.php");

$id = $_POST['id'];

$situacao = $_POST['situacaoAlt'];

$buscarAquivo = $conect->query("SELECT arquivo from contasareceber;");


$conect->query("UPDATE contasareceber SET situacao='$situacao' WHERE id='$id' ");

header("Location: areceber.php?msg=alteradoOk");
?>