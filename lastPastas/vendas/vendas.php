<?php 
	include ("../login/sessao.php"); 
	include ("../conexaoBanco/conexao.php");
	
	
	$dados = mysqli_query($conect, "SELECT * FROM vendas");
	$coluna = mysqli_fetch_array($dados);

	
	$codMax = $_GET['codVenda'];
	$codVenda = $codMax;	
	
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
			
		<div class="container">
		
			<div class="bar">
				<h3 class="BemVindoUserVendas"><?php echo "Bem Vindo ". $_SESSION['usuarioNome'];?> ! - Vendas</h3>
				
				<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
			</div>

			<div class="contentVendas">
				<div class="formVendas">
					<div class="itens">
					
						<h4 id="codVenda"> 
						
							<?php 
							
									echo "Cod.Venda: ".$codMax;
							
							?>
						</h4><br>
						<form >
							<div class="divQtd">
								<label class="labelPesquisa" for="insereQuantidade">Quantidade: </label><br>						
								<input class='inputQtd' id="qtdProduto" type="number" name="insereQuantidade" required>
							</div>
							<div class="divBusca">
								<label class="labelPesquisa" for="pesquisaProduto">Pesquisar Produto/Código: </label><br>
								<input class='inputPesquisa' id="pesquisaProduto" type="text" name="pesquisaProduto" autocomplete = "off">
							</div>
							
							
						</form>
						<div style="position:absolute; background:#d6d6d6; border-radius: 5px;">
							<ul id="resultProduto">
							</ul>
						</div>
						
						<table class="tabelIniprod">
							<tr id="nometabelaProdutos">
								
								<th class='titleTabelaVendas'>Cod.Produto</th>
								<th class='titleTabelaVendas'>Nome Produto</th>
								<th class='titleTabelaVendas'>Fabricante</th>
								<th class='titleTabelaVendas'>Descrição</th>
								<th class='titleTabelaVendas'>Tipo</th>
								<th class='titleTabelaVendas'>Qtd</th>
								<th class='titleTabelaVendas'>Preço</th>
								<th class='titleTabelaVendas'></th>
							</tr>
							<br>								
							<?php
								
								$soma = mysqli_query($conect, "SELECT sum(preco_venda * quantidade) as codigo FROM vendas WHERE cod_venda=$codMax;");
								$coluna2 = mysqli_fetch_array($soma);
							
								$somaBanco = $coluna2['codigo'];
								$total = number_format($somaBanco, 2, ',', '.');

								$contaItemBanco = mysqli_query($conect, "SELECT sum(quantidade) as qtd FROM vendas WHERE cod_venda=$codMax and quantidade != 0;");
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
										<tr class='um'>
																					
											<td style='width:25px; padding-left: 10px;'align='center'>$cod</td>
											<td style='width: 150px; padding-left: 10px;'>$nome</td>
											<td style='width: 150px;'; align='center'>$fabricante</td>
											<td style='width: 150px;'; align='center'>$descricao</td>
											<td style='width: 80px; padding-left: 10px;'align='center'>$tipo</td>
											<td style='width:40px;padding:5px; text-align: right;'>$qtd</td>
											<td style= 'padding-right: 10px; width: 60px;' align='right'>$preco</td>
											
											<td id='acoes' style='width: 50px;'align='center'>
												<a href=\"deleteProduto.php?idVenda=$id&codVenda=$codMax\">
													<button class='btn' id='ex' title='Excluir'>
														<i class='fa fa-trash-o' aria-hidden='true'>
														</i>
													</button>
												</a>
											</td>
										</tr>
									";
								}
							?>
						</table>
					</div>
					<div class="itens2">
					<form>
						<label for="pesquisaCliente"> Pesquisar Cliente: </label><br>
						<input class='inputPesquisa' id='pesquisaCliente' type="text" name="pesquisaCliente">
						
					</form>
					<div style="position:absolute; background:#d6d6d6; border-radius: 5px;">
						<ul id="resultCliente">
						</ul>
					</div>
						<table class="tableConfPagamento"><br>
							<tr class="finalizaCompra">
								<td colspan="2" id="resultCliente">Cliente: 
									<?php 
										$dados1 = mysqli_query($conect, "SELECT * FROM vendas WHERE cod_venda='$codVenda'");
								
										$colunaNome	= mysqli_fetch_array($dados1);
										$cliente = $colunaNome['cliente'];
										$pagamento = $colunaNome['pagamento'];
										$idCliente = $colunaNome['idCliente'];
										echo $cliente;
										
									?>
									
								 </td>
								
							</tr>
							<br><br>
							
							<tr class="finalizaCompra">
								<td>Forma de Pagamento: </td>
								<td>
									<select id="pagamento" name="pagamento" style="border:none; width: 100%;">
										<?php echo"<option name='pagamento' value='$pagamento'>$pagamento</option>"; ?>
										<option name="pagamento" value="Dinheiro">Dinheiro</option>
										<option name="pagamento" value="Débito">Débito</option>
										<option name="pagamento" value="Crédito">Crédito</option>
									</select>
								</td>
								
							</tr>
							
							<tr class="finalizaCompra">
								<td >Total de itens: </td>
								<td style="text-align:center"><?php echo $qtdItem." Unidades";?></td>
							</tr>
							
							<tr class="finalizaCompra">
								<td >Valor Total: </td>
								<td style="text-align:right;"><?php echo "R$ ".$total;?></td>
							</tr>
						</table>
						

						<a href="#confVenda"><button class="btnMod" id="conf">Finalizar</button></a>
						<a href="#cancelarVenda"><button class="btnMod" id="exc">Cancelar</button></a>

						<div class='modalConfVenda' id='confVenda'>
											
							<p class='espaco'>Finalizar Venda</p></br>
							<hr>
							<br>
							<div id='alert'>Deseja Concluir esta venda?</div>
							<br>
							<hr>
							<a href="finalizaVenda.php?cod=<?php echo $codVenda;?>&idCliente=<?php echo $idCliente;?>&nome=<?php echo $cliente;?>&pagamento=<?php echo $pagamento;?>"><button class='btnMod' id='conf'>Concluir</button></a>
							<a href="#"><button class='btnMod' id='exc'>Cancelar</button></a>
							
						</div>
						
						

						<div class='modalConfVenda' id='cancelarVenda'>
											
							<p class='espaco'>Cancelar Venda</p></br>
							<hr>
							<br>
							<div id='alert'>Deseja cancelar esta Venda?
								<br>Todo os itens serão deletados!
							</div>
							<br>
							<hr>
							<a href='../vendas/deleteVenda.php?codVenda=<?php echo$codMax?>&msg=5'><button class='btnMod' id='exc'>Cancelar Venda</button></a>
							<a href="#"><button class='btnMod' id='conf'>Continuar</button></a>
							
						</div>
						<div class='bg'></div>

						
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
		<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
		<script type="text/javascript" src="js/buscaVendas.js"></script>
		<script type="text/javascript" src="../js/scriptSair.js"></script>
		
		<script>
			
			$("#pesquisaProduto").keyup(function(){ //quando escrever no input pesquisar

				var buscaProduto =$("#pesquisaProduto").val(); // vai criar uma variavel com a palavra digitada no input
				var qtd =$("#qtdProduto").val();
				var pagamento =$("#pagamento").val();
				

				if(buscaProduto != ''){ // verifica se o input esta cheio e envia a variavel busca para pagina buscaproduto.php
					$.ajax({
						url:"buscaProduto.php",
						method:"POST",
						data:{busca:buscaProduto, codVenda:<?php echo $codMax; ?>, qtd:qtd, pgto:pagamento}, // variavel que envia os dados
						success:function(data){
							$('#resultProduto').fadeIn(); 
							$('#resultProduto').html(data);
						}
						
					});
					
				}
			});

			$(document).on('click','li',function(){
				$('#pesquisaProduto').val($(this).text());
				$('#resultProduto').fadeOut();
			});

			$(document).focusout(function(){
				$('#resultProduto').fadeOut();
			});

			$("#pesquisaCliente").keyup(function(){ //quando escrever no input pesquisar

				var buscaCliente =$("#pesquisaCliente").val(); // vai criar uma variavel com a palavra digitada no input
				var pagamento =$("#pagamento").val();
				if(buscaCliente != ''){ // verifica se o input esta cheio e envia a variavel busca para pagina buscaproduto.php
					$.ajax({
						url:"buscaCliente.php",
						method:"POST",
						data:{busca:buscaCliente, codVenda:<?php echo $codMax; ?>, pgto:pagamento}, // variavel que envia os dados
						success:function(data){
							$('#resultCliente').fadeIn(); 
							$('#resultCliente').html(data);	
						}
					});	
				}
			});

			$(document).on('click','p',function(){				
				$('#resultCliente').val($(this).text());
				$('#resultCliente').fadeOut();				
			});

		</script>
		
	</body>
</html>