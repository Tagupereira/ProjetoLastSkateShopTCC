<?php 
	include ("../login/sessao.php"); 
	include "../conexaoBanco/conexao.php";

	
	if(isset($cliente)){	
		$cliente = $_GET['cliente'];
	}else{
		$cliente = "Indefinido";
	}
	if(isset($telefone)){	
		$telefone = $_GET['telefone'];
	}else{
		$telefone = "0000-0000";
	}
	if(isset($email)){	
		$email = $_GET['email'];
	}else{
		$email = "email@email.com";
	}

	$codVenda = $_GET['codVenda'];
	$dados = mysqli_query($conect, "SELECT * FROM vendas WHERE cod_venda='$codVenda'");
	$coluna2 = mysqli_fetch_array($dados);
	$data = $coluna2['data_venda'];
	$data = date('d-m-Y', strtotime($data));
	$vendedor = $coluna2['vendedor'];
	$cliente = $coluna2['cliente'];
	$idCliente = $coluna2['idCliente'];
	$pagamento = $coluna2['pagamento'];

	$dadosCli = mysqli_query($conect, "SELECT * FROM clientes where id='$idCliente'");
	$dadosCliente = mysqli_fetch_array($dadosCli);
	$telefone = $dadosCliente['whatsapp'];
	$email = $dadosCliente['email'];

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Gestão Click</title>
		<link rel="stylesheet" type="text/css" href="../css/styleVendas.css" />
		<link rel="stylesheet" type="text/css" href="../css/modal.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery-1.12.1.min.js" />
			
		<script type="text/javascript" src="../js/scriptSair.js"></script>
		
	</head>
	<body>
			
		<div class="containerFatura">
		
			
			<div class="contentVendas">
				<div class="formFatura">
					<div class="cabecalho">
						<img class="logoFatura" src="../img/logo.png" alt="logo">
						<h3 class="numeroVenda">Venda Nº <?php echo $codVenda; ?></h3>
					</div>
					<br>


					<div class="dados">
						<table class="listaItem" >
							<tr>
								<td class="titulo1">Cliente: </td>
								<td class="dados1"><?php echo $cliente;?></td>
								
								<td class="tituloDados">Data Venda: </td>
								<td class="titulo2"><?php echo $data;?></td>
								<td class="titulo3"><a onClick="window.print()" title="Imprimir Comprovante"><i class="link fa fa-print" aria-hidden="true"></i></a></td>
							</tr>
							
							<tr>
								<td class="titulo1">Telefone: </td>
								<td class="dados1"> <?php echo $telefone;?></td>
								
								<td class="tituloDados">Vendedor: </td>
								<td class="titulo2"><?php echo $vendedor;?></td>
							</tr>
							
							<tr>
								<td class="titulo1">E-mail: </td>
								<td class="dados1"><?php echo $email;?></td>
								
								<td class="titulo1">Pagamento:</td>
								<td class="dados1"><?php echo $pagamento;?></td>
								
							</tr>
							
							
								
							
						</table>
							

					</div>
					<br>
					<div class="itensFatura">
						<h3>Itens Venda</h3>
						<br>						
						<table class="listaItem">
							<tr id="titulos">
								
								<th class='titleTabelaVendas'>Cod.Produto</th>
								<th class='titleTabelaVendas'>Nome Produto</th>
								<th class='titleTabelaVendas'>Fabricante</th>
								<th class='titleTabelaVendas'>Descrição</th>
								<th class='titleTabelaVendas'>Tipo</th>
								<th class='titleTabelaVendas'>Qtd</th>
								<th class='titleTabelaVendas'>Preço</th>
							</tr>

							
															
							<?php
								
								$soma = mysqli_query($conect, "SELECT sum(preco_venda) as codigo FROM vendas WHERE cod_venda='$codVenda';");
								$coluna2 = mysqli_fetch_array($soma);
							
								$somaBanco = $coluna2['codigo'];
								$total = number_format($somaBanco, 2, ',', '.');

								$contaItemBanco = mysqli_query($conect, "SELECT sum(quantidade) as qtd FROM vendas WHERE cod_venda='$codVenda';");
								$coluna3 = mysqli_fetch_array($contaItemBanco);
								$qtdItem = $coluna3['qtd'];
								
								$dados = mysqli_query($conect, "SELECT * FROM vendas WHERE cod_venda='$codVenda'");
								while($coluna = mysqli_fetch_array($dados)){
									
									$id = $coluna['id_venda'];
									$codVenda = $coluna['cod_venda'];
									$cod = $coluna['cod_produto'];
									$nome = $coluna['nome_produto'];
									$fabricante = $coluna['fabricante'];
									$descricao = $coluna['descricao'];
									$tipo = $coluna['tipo'];
									$qtd = $coluna['quantidade'];		 						
									$precoVenda = $coluna['preco_venda'];
									$preco = number_format($precoVenda, 2, ',', '.');
									
									echo"
										<tr class='um' style='font-size:13px;'>
																					
											<td style='width:25px; padding-left: 10px;'align='center'>$cod</td>
											<td style='width: 150px; padding-left: 10px;'>$nome</td>
											<td style='width: 150px;'; align='center'>$fabricante</td>
											<td style='width: 150px;'; align='center'>$descricao</td>
											<td style='width: 80px; padding-left: 10px;'align='center'>$tipo</td>
											<td style='width:40px;padding:5px; text-align: right;'>$qtd</td>
											<td style= 'padding-right: 10px; width: 110px;' align='right'>$preco</td>
											
											
										</tr>
									";
								}
								
								echo "
									<tr><td colspan='7' style='height:20px;'></td></tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<th style='background: #ccc; width: 80px; padding-left: 10px;'align='center'>Total </th>
										<th style='background: #ccc; width:40px;padding:5px; text-align: right;'>$qtdItem</th>
										<th style='background: #ccc; padding-right: 10px;' align='right'>R$ $total</th>
									</tr>
									";
							?>
						</table>
						
					</div>
					
				</div>
			</div>
		</div>
		
		
		<script type="text/javascript" src="../js/scriptSair.js"></script>		
	</body>
</html>