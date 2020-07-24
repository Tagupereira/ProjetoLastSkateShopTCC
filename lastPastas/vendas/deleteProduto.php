<?php 
include ("../login/sessao.php"); 

// aqui voce conecta ao banco
include ("../conexaoBanco/conexao.php");

// aqui a variavel $rm recebe o valor do banco enviado do formulario
$id = $_GET['idVenda'];
$codVenda = $_GET['codVenda'];
if($codVenda == 0){
    $codVenda = 1; 
}
//executa uma consulta e deleta no banco
$sqld = "DELETE FROM vendas WHERE id_venda=$id"  ;

$query = $conect -> query($sqld);

// retorna a pagina de listagem do banco

header('Location: vendas.php?codVenda='.$codVenda);


?>