<?php 
   
	include ("../login/sessao.php"); 
    include ("../conexaoBanco/conexao.php");
    
	
    $busca = $_GET['id'];
    $codVenda = $_GET['codVenda'];
    $qtd=$_GET['qtd'];

    $pagamento = $_GET['pgto'];
    

    

    if($qtd == 0){
        $qtd=1;
    }
 
    /*
    $max = mysqli_query($conect, "SELECT max(cod_venda) as codigo FROM vendas;");
    $coluna = mysqli_fetch_array($max);
    $codVenda = $coluna['codigo'];*/
    
    if($codVenda == 0){
        $codVenda = 1; 
    }
    $vendedor = $_SESSION['usuarioNome'];
    $consultaDados = mysqli_query($conect, "SELECT * FROM produtos WHERE id_produto = $busca;");
    $coluna2 = mysqli_fetch_array($consultaDados);

    $codProduto = $coluna2['cod_produto'];
    $nomeProduto = $coluna2['nome_produto'];
    $fabricante = $coluna2['fabricante'];
    $tipo = $coluna2['tipo'];
    $descricao = $coluna2['descricao_produto'];
    $preco = $coluna2['preco_venda'];
    //$qtd = 1;
     
    $conect->query("INSERT INTO vendas(cod_venda, cod_produto, nome_produto, fabricante, descricao, tipo, quantidade, preco_venda, data_venda, vendedor, pagamento) VALUES('$codVenda', '$codProduto', '$nomeProduto', '$fabricante', '$descricao', '$tipo', '$qtd', '$preco', NOW(), '$vendedor', '$pagamento')");
    $conect->query("UPDATE vendas SET pagamento='$pagamento' WHERE cod_venda = '$codVenda'");
    header('location: vendas.php?codVenda='.$codVenda);
    
?>