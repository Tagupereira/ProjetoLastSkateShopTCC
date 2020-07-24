<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
include ("../conexaoBanco/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$site = $_POST['site'];


$conect->query("UPDATE fornecedor SET razao_social='$nome', telefone='$telefone', celular='$celular', email='$email', web='$site' WHERE id_fornecedor='$id' ");

header("Location: fornecedores.php?msg=alteradoOk");
?>