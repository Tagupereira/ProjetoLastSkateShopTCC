<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

// aqui voce conecta ao banco
include "../conexaoBanco/conexao.php";


$id = $_GET["id"];

    $sqld = "DELETE FROM fornecedor WHERE id_fornecedor=$id";

    $query = $conect -> query($sqld);


// retorna a pagina de listagem do banco

header('Location: fornecedores.php?msg=excluidoOk');

?>