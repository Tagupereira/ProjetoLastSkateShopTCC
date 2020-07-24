<?php 
include ("../login/sessao.php"); 

// aqui voce conecta ao banco
include ("../conexaoBanco/conexao.php");

// aqui a variavel $rm recebe o valor do banco enviado do formulario
$codVenda = $_GET['codVenda'];
$msg = $_GET['msg'];

// Repor quantidade de produtos cancelados na venda no estoque

//executa uma consulta e deleta no banco
$sqld = "DELETE FROM vendas WHERE cod_venda=$codVenda"  ;

$query = $conect -> query($sqld);

// retorna a pagina de listagem do banco
header("Location: inicioVendas.php?msg=$msg");

?>