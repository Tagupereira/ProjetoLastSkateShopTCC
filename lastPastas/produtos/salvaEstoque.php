<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
include "../conexaoBanco/conexao.php";

$id = $_POST['id'];
$qtdAtual = $_POST['qtdAtual'];
$novaQtd = $_POST['novoQtd'];


$qtd = $qtdAtual + $novaQtd;
    

$conect->query("UPDATE produtos SET quantidade='$qtd' WHERE id_produto='$id' ");


header("Location: produtos.php?msg=alteradoOk");

?>