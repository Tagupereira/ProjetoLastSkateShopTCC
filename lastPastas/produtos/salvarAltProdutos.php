<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
include '../conexaoBanco/conexao.php';



$id = $_POST['id'];
$cod = $_POST['cod_produto'];
$nome = $_POST['nome_produto'];
$fabricante = $_POST['fabricante'];
$descricao = $_POST['descricao_produto'];
$tipoProduto = "$_POST[tipo]";
$qtd = $_POST['quantidade'];

$vendaC = $_POST['preco_custo'];
$custo = explode(",", $vendaC);
$custo = array_reverse($custo);
$umV = $custo[1];
$doisV = $custo[0];
$venda = $umV.'.'.$doisV;

$valorV = $_POST['preco_venda'];
$custo = explode(",", $valorV);
$custo = array_reverse($custo);
$um = $custo[1];
$dois = $custo[0];
$valor = $um.'.'.$dois;


$buscarAquivo = $conect->query("SELECT arquivo from produtos;");

$uploaddir ='imgProdutos/';
$arquivo = $_FILES['fotoAlt']['name'];
$separa = explode(".", $arquivo);
$separa = array_reverse($separa);
$tipo = $separa[0];
$imagem = $cod.'.'.$tipo;

if(move_uploaded_file($_FILES['fotoAlt']['tmp_name'], $uploaddir . $imagem))
{
	$uploadfile = $uploaddir . $imagem;
	$conect->query("UPDATE produtos SET cod_produto='$cod', nome_produto='$nome', descricao_produto='$descricao', quantidade='$qtd', fabricante='$fabricante', tipo = '$tipoProduto', preco_custo='$venda', preco_venda='$valor', arquivo='$uploadfile' WHERE id_produto='$id' ");
}

else{

	$conect->query("UPDATE produtos SET cod_produto='$cod', nome_produto='$nome', descricao_produto='$descricao', quantidade='$qtd', fabricante='$fabricante', tipo = '$tipoProduto', preco_custo='$venda', preco_venda='$valor' WHERE id_produto='$id'");
}


header("Location: produtos.php?msg=alteradoOk");

?>