<?php 
	include ("../login/sessao.php"); 
	include ("../login/validaUsuario.php");

	include "../conexaoBanco/conexao.php";
	//aqui são as variaveis que iram receber o valor do form
    $cod = "$_POST[cod_produto]";
    $nome = "$_POST[nome_produto]";
	$descricao = "$_POST[descricao_produto]";
	$tipoProduto = "$_POST[tipo]";
	$qtd = "$_POST[quantidade]";
	$fabricante = "$_POST[fabricante]";
    $precoDeCusto = "$_POST[preco_custo]";
	$precoDeVenda = "$_POST[preco_venda]";
	
	$custo = explode(",", $precoDeCusto);
	$custo = array_reverse($custo);
	$um = $custo[1];
	$dois = $custo[0];
	$precoCusto = $um.'.'.$dois;

	$custov = explode(",", $precoDeVenda);
	$custov = array_reverse($custo);
	$umv = $custov[1];
	$doisv = $custov[0];
	$precoVenda = $umv.'.'.$doisv;


	$uploaddir ='imgProdutos/';
    $arquivo = $_FILES['foto']['name'];
	$separa = explode(".", $arquivo);
	$separa = array_reverse($separa);
	$tipo = $separa[0];
	$imagem = $cod.'.'.$tipo;

	if(move_uploaded_file($_FILES['foto']['tmp_name'], $uploaddir . $imagem))
	{
		$uploadfile = $uploaddir . $imagem;
		echo'<center>Enviado com Sucesso</center><br>';

		echo'<center><a href="produto.php"><button>voltar</button></a></center>';
	} 
	else {
		echo "Não foi Possivel enviar o arquivo";
	}
	
	$conect->query("INSERT INTO produtos(cod_produto, nome_produto, descricao_produto, quantidade, fabricante, tipo, preco_custo, preco_venda, data_entrada, arquivo) VALUES('$cod', '$nome', '$descricao', '$qtd', '$fabricante', '$tipoProduto', '$precoCusto', '$precoVenda', NOW(), '$uploadfile')");
	
	
	header("location: produtos.php?msg=cadastroOk");
?>