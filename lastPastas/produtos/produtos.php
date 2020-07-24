<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Gestão Click</title>
		<link rel="stylesheet" type="text/css" href="../css/style2.css" />
		<link rel="stylesheet" type="text/css" href="../css/modal.css" />
		<link rel="stylesheet" type="text/css" href="../css/alertas.css" />
		
		<script type="text/javascript" src="../js/scriptSair.js"></script>

	</head>
	<body>
		
		<div class="bar">
			<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
		
		</div>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||MENU|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		<?php include ("../menu/menu.php") ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				
		<div class="container">
			
			<div class="cabecalhoProdutos"><i class="fa fa-cube" aria-hidden="true"></i> Produtos</div>
			
			<?php
				include ("../alertas/alertas.php");
			?>

			<a href="#cadastrar"><button class="btnAdc" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar produtos</button></a>
			
			<form class="buscar" method="POST" action="pesquisaProduto.php">
				<input type="text" name="busca" placeholder="Buscar por nome" ><button class="buscarBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			
			<div class="contasrecebercontent">
				
					<div class="contasettingsareceber" id="tabelaareceber">
						<table class="tabelIniprod">
							<tr id="nometabelaProdutos">
								
								
								<th align="center">Cód.</th>
								<th align="center">Nome Produto</th>
								<th align="center">Fabricante</th>
								<th align="center">Descrição</th>
								<th align="center">Tipo</th>
								<th align="center">Estoque</th>
								<th align="center">Vr.Venda</th>
								<th align="center">Ações</th>
								
							</tr>
							<?php
								
								include "../conexaoBanco/conexao.php";
								
								$dados = mysqli_query($conect, "SELECT * FROM produtos ORDER BY nome_produto asc");
								while($coluna = mysqli_fetch_array($dados)){
									
									$id = $coluna['id_produto'];
									$idEdit = $coluna['id_produto']."editar";
									$idVisu = $coluna['id_produto']."visualizar";
									$idEstoque = $coluna['id_produto']."estoque";
									$cod = $coluna['cod_produto'];
									$nome = $coluna['nome_produto'];
									$fabricante = $coluna['fabricante'];
									$tipo = $coluna['tipo'];
									$descricao = $coluna['descricao_produto'];
									$valorCusto= $coluna['preco_custo'];
									$custo = number_format($valorCusto, 2, ',', '.');
									$imagem = $coluna['arquivo'];
									$qtd = $coluna['quantidade'];
									$valor = $coluna['preco_venda'];
									$preco = number_format($valor, 2, ',', '.');
									
									
									echo"
										<tr class='um'>
																					
											<td style='width: 70px;' align='center';>$cod</td>
											<td style='width: 200px; padding-left: 10px;'>$nome</td>
											<td style='width: 150px;'; align='center'>$fabricante</td>
											<td style='width: 150px; padding-left: 10px;'>$descricao</td>
											<td style='width: 90px; padding-left: 10px;'>$tipo</td>
											<td style= 'padding-right: 10px; width: 80px;' align='right'>$qtd</td>
											<td style= 'padding-right: 10px; width: 60px;' align='right'>$preco</td>
											
											<td id='acoes' style='width: 160px;'align='center'>

												<a href=#$idEstoque><button class='btn' id='es' title='Editar estoque'><i class='fa fa-cube' aria-hidden='true'></i></button></a>
												<a href=#$idVisu><button class='btn' id='vs' title='Visualizar'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
												<a href=#$idEdit><button class='btn' id='ed' title='Editar'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
												<a href=#$id><button class='btn' id='ex' title='Excluir'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>

											</td>
											
										</tr>
										
										<div class='modal' id='$id'>
										
											<p class='espaco'>Deletar Produto '$cod'</p></br>
											<hr>
											<br>
											<div id='alert'>Deseja excluir <br>'$nome ?'</div>
											<br>
											<hr>
											<a href='deleteProduto.php?id_produto=$id'><button class='btnMod' id='conf'>Excluir</button></a>
											<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>

										<div class='modalV' id='$idVisu'>
											
											<h3 class='espaco'>Visualização do produto</h3></br>
											<hr>
											<br>
											<p class='textModal'><strong>Codigo:</strong> $cod</p>
											<p class='textModal'><strong>Nome:</strong> $nome</p>
											<p class='textModal'><strong>Fabricante:</strong> $fabricante</p>
											<p class='textModal'><strong>Descrição:</strong> $descricao</p>
											<p class='textModal'><strong>Tipo:</strong> $tipo</p>
											<p class='textModal'><strong>Quantidade:</strong> $qtd</p>
											<p class='textModal'><strong>Preço de custo:</strong> $custo</p>
											<p class='textModal'><strong>Preço de venda:</strong> $preco</p>
											<p class='textModal'><strong>Imagem:</strong> <br></p><img id='imgModal' src='$imagem'/>
											<br>
											<hr>
											<a href='#'><button class='btnMod' id='exc'>Fechar</button></a>
											
										</div>

										<div class='modal' id='$idEstoque'>
											
											<p class='espaco'>Alterar Estoque</p></br>
											<hr>
											<br>
											<div id='alertEstoque'>
												<img id='imagemEstoque'src=$imagem>
												<strong>COD:</strong> $cod <br> 
												<strong>Produto:</strong> $nome <br>
												<strong>Estoque Atual: </strong> $qtd <br>
					
											
											<form id='novoQtd' method='POST' action='salvaEstoque.php'>
												<input name='id' value=$id hidden >
												<input name='qtdAtual' value=$qtd hidden >
												<label for='novoQtd'> Adicionar Quantidade: </label>
												<input name='novoQtd' type='number' required><br><br>												<hr>
												</div>
												<button type='submit' class='btnMod' id='confirm'>Alterar</button>
											</form>
											
											<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>

												
										<div class='modalEdit' id='$idEdit'>
											<h3>Alterar Produto</h3>
											<hr>
											
											<form method='POST' action='salvarAltProdutos.php' enctype='multipart/form-data'>
											
											<input name='id' type='hidden' value='$id'>

											<label class='label'>Código Produto</label>
											<input  class='input2' type='text' name='cod_produto' maxlength='4' value='$cod' required ><br>
									
											<label class='label'>Nome do Produto</label>
											<input  class='input2' type='text' name='nome_produto'value='$nome' required><br>
										
											<label class='label'>Descrição do Produto</label>
											<input  class='input2' type='text' name='descricao_produto' value='$descricao' required><br>
										
											<label class='label'>Tipo</label>
											<input  class='input2' type='text' name='tipo' value='$tipo' required><br>
									
											<label class='label'>Quantidade</label>
											<input  class='input2' type='text' name='quantidade' value='$qtd' required><br>
									
											<label class='label'>Fabricante</label><br>
											<select name='fabricante' required>
												<option name='fabricante'>$fabricante<option>
											";											
												$dadosE = mysqli_query($conect, "SELECT razao_social FROM fornecedor");
												while($coluna1 = mysqli_fetch_array($dadosE)){
													$fabricanteCad = $coluna1['razao_social'];
													echo"<option name='fabricante' value='$fabricanteCad'>$fabricanteCad</option>";
												}

											echo"

											</select><br>
									
											<label class='label'>Preço de custo</label>
											<input class='input2' type='text' name='preco_custo' value='$custo' required><br>
										
											<label class='label'>Preço de venda</label>
											<input class='input2' type='text' name='preco_venda' value='$preco' required><br>
										
											<input type='file' name='fotoAlt'><br>
										
											<button type='submit' class='btnMod' id='confirm'>Alterar</button>
											</form>
											
											<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>
									";
								}
							
								echo "
									<div class='modalEdit' id='cadastrar'>
										<h3>Adicionar Produto</h3>
										<hr>
										
										<form class='formAdd' method='POST' action='recebeDadosProdutos.php' enctype='multipart/form-data'>
										
										<label class='label'>Código Produto</label><br>
										<input  class='input2' type='text' name='cod_produto' maxlength='4' required >
								
										<label class='label'>Nome do Produto</label><br>
										<input  class='input2' type='text' name='nome_produto'required>
									
										<label class='label'>Descrição do Produto</label><br>
										<input  class='input2' type='text' name='descricao_produto' required>
									
										<label class='label'>Tipo</label><br>
										<input  class='input2' type='text' name='tipo' required>
								
										<label class='label'>Quantidade</label><br>
										<input  class='input2' type='text' name='quantidade' required>
								
										<label class='label'>Fabricante</label><br>
										<select name='fabricante' required>
										
										";
										include "../conexaoBanco/conexao.php";
										$dados = mysqli_query($conect, "SELECT razao_social FROM fornecedor");
										while($coluna = mysqli_fetch_array($dados)){
							
											$fabricante = $coluna['razao_social'];

											echo"<option name='fabricante' value='$fabricante'>$fabricante</option>";
											
										}
										echo"

										</select><br>
								
										<label class='label'>Preço de custo</label><br>
										<input class='input2' type='text name='preco_custo' required>
									
										<label class='label'>Preço de venda</label><br>
										<input class='input2' type='text' name='preco_venda' required>
									
										<input type='file' name='foto'>
									
										<button type='submit' class='btnMod' id='confirm'>Cadastrar</button>
										</form>
										
										<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
									</div>
								";
								
								echo "
									<div class='bg'></div>
								";
									
							?>
	
						</table>
					</div>
				
			</div>	
		</div>
		
	</body>
</html>