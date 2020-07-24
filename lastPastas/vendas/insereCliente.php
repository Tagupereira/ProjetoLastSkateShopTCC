<?php 
   
	include ("../login/sessao.php"); 
    include ("../conexaoBanco/conexao.php");
    
	
    $codVenda = $_GET['codVenda'];
    $nome = $_GET['nomeBusca'];
    $pagamento = $_GET['pgto'];
    $idCliente = $_GET['idCliente'];

    if($nome == "" || $nome == NULL){
        $nome = "Sem cadastro";
    }
    var_dump($nome , $codVenda);
    $conect->query("UPDATE vendas SET idCliente = '$idCliente' ,cliente='$nome', pagamento='$pagamento' WHERE cod_venda = '$codVenda'");
    
    header('location: vendas.php?codVenda='.$codVenda);
    
?>