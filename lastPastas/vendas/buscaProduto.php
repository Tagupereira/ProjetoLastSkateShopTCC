<?php 
	include ("../login/sessao.php"); 

	include "../conexaoBanco/conexao.php";
    
    $codVenda = $_POST['codVenda'];
    $busca = $_POST['busca'];
    $qtd = $_POST['qtd'];
    $pagamento = $_POST['pgto'];
    
    
    $query = mysqli_query($conect,"SELECT * FROM produtos WHERE nome_produto LIKE '%$busca%'");
    $num = mysqli_num_rows($query);
    if($num >0){
        while($row = mysqli_fetch_assoc($query)){
            $idProduto = $row['id_produto'];
            $pesquisa = $row['nome_produto'];
            $codProduto = $row['cod_produto'];
            $tipo = $row['tipo'];
            $fabricante = $row['fabricante'];
            $descricao = $row['descricao_produto'];
            $resultado = "<a href='insereProduto.php?id=$idProduto&codVenda=$codVenda&qtd=$qtd&pgto=$pagamento' style='list-styletype:none; text-decoration:none;'><li style=' cursor:pointer; padding:12px; margin-bottom:5px; list-style-type: none;'>($codProduto) $pesquisa - $fabricante - $descricao - $tipo<br></li></a>";
            echo $resultado;            
        }

    }else{
        echo "Produto não encontrado!";
    }
       
    
?>