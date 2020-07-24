<?php 
	include ("../login/sessao.php"); 

	include "../conexaoBanco/conexao.php";
    
    $codVenda = $_POST['codVenda'];
    $busca = $_POST['busca'];
    $pagamento = $_POST['pgto'];
    
    
    $query = mysqli_query($conect,"SELECT * FROM clientes WHERE nome LIKE '%$busca%'");
    $num = mysqli_num_rows($query);
    if($num >0){
        while($row = mysqli_fetch_assoc($query)){
            $id = $row['id'];
            $nome = $row['nome'];
            $resultado = "<a href='insereCliente.php?nomeBusca=$nome&codVenda=$codVenda&pgto=$pagamento&idCliente=$id' style='list-style-type:none; text-decoration:none;'><p style=' cursor:pointer; padding:12px; margin-bottom:5px; list-style-type: none;'>$nome<br></p></a>";
            echo $resultado;            
        }

    }else{
        echo "Cliente não encontrado!";
    }
       
    
?>