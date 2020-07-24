<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

include ("../conexaoBanco/conexao.php");

$id = $_POST['id'];

$situacao = $_POST['situacaoAlt'];

$buscarAquivo = $conect->query("SELECT arquivo from agenda;");


$conect->query("UPDATE agenda SET situacao='$situacao' WHERE id='$id' ");

header("Location: agenda.php");
?>