<?php 
   
	include ("../login/sessao.php"); 

    include ("../conexaoBanco/conexao.php");

    $pagamento = $_GET['pagamento'];
    $codVenda = $_GET['cod'];
    $idCliente= $_GET['idCliente'];
    $nome = $_GET['nome'];

    var_dump($pagamento, $codVenda, $idCliente, $nome);
    
    $conect->query("UPDATE vendas SET pagamento='$pagamento' WHERE cod_venda = '$codVenda'");
    $conect->query("UPDATE vendas SET idCliente = '$idCliente' ,cliente='$nome', pagamento='$pagamento' WHERE cod_venda = '$codVenda'");
    
    header('location: inicioVendas.php?msg=1');
    
?>
