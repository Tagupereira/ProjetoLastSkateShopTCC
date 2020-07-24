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
	<?php include ("../menu/menu.php");?>
		
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		
		<div class="container">
			
			<div class="cabecalhoAreceber"><i class="fa fa-handshake-o" aria-hidden="true"></i> Fornecedores</div>
			
			<?php
				include ("../alertas/alertas.php");
			?>
			
			<a href="#cadastrar"><button class="btnAdc" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar novo fornecedor</button></a>
					
			<form class="buscar" method="POST" action="pesquisaCliente.php">
				<input type="text" name="busca" placeholder="Buscar por nome" ><button class="buscarBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			
			<div class="contasrecebercontent">
				
					<div class="contasettingsareceber" id="tabelaareceber">
						<table class="tabelIniCli">
							<tr id="tabelaCliente">
								<th align="center">ID</th>
								<th align="center">Nome</th>
								<th align="center">telefone</th>
								<th align="center">celular</th>
								<th align="center">email</th>
								<th align="center">site</th>
								<th align="center" style="width: 100px;">Ações</th>
								
							</tr>
							
							
							
							<?php
								include "../conexaoBanco/conexao.php";
								
								
								//$pagina = 2;
								//$dados = mysqli_query($conect, "SELECT * FROM clientes WHERE pagina = '$pagina'");
								$dados = mysqli_query($conect, "SELECT * FROM fornecedor");
								
								
								while($coluna = mysqli_fetch_array($dados)){
									$id = $coluna['id_fornecedor'];
									$idEdit = $coluna['id_fornecedor'].'Editar';
									$nome = $coluna['razao_social'];
									$telefone = $coluna['telefone'];
									$celular = $coluna['celular'];
									$email= $coluna['email'];
									$site = $coluna['web'];
								
									
									
							
									echo"
										<tr class='um'>
											<td style='width:  50px; padding-right:10px;' align='right'>$id</td>
											<td style='width: 200px; padding-left: 15px;'>$nome</td>
											<td style='width: 100px; padding-left:10px;' >&nbsp$telefone</td>
											<td style='width: 100px;' ><a href='https://web.whatsapp.com/send?phone=5511$celular&ola mundo&source&data' target='_blank' title='Whatsapp'><button class='btnAdWhats' style='margin:0px'><i class='fa fa-whatsapp' aria-hidden='true'>&nbsp$celular</i></button></a></td>
											
											<td style='width: 100px; padding-left:10px;' >&nbsp$email</td>
											<td style='width: 200px; padding-left:10px;' ><a href='https://$site' target='_blank' title='site $nome'>$site</a></td>
											
											<td id='acoes' style='width: 70px'; align='center'>
												<a href='#$id'><button class='btn' id='ex' title='Excluir'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>
												<a href='#$idEdit'><button class='btn' id='ed' title='Editar'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
											</td>
											
										</tr>
											
										<div class='modal' id='$id'>
											
											<p class='espaco'>Deletar Registro '$id'</p></br>
											<hr>
											<br>
											<div id='alert'>Deseja excluir <br>'$nome ?'</div>
											<br>
											<hr>
											<a href=\"deleteFornecedor.php?id=$id\"><button class='btnMod' id='conf'>Excluir</button></a>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>
										
										<div class='modalEdit' id='cadastrar'>
												
											<h3>Adicionar Fornecedor</h3>
											<hr>
											<form class='formAdd' method='POST' action='recebeDadosFornecedor.php'>
																								
												<label class='label'>Razão Social / Nome Fantasia</label><br>
												<input  class='input2' type='text' name='nome' placeholder='Razão Social / Nome Fantasia'><br>

												<label class='label'>Telefone</label>
												<input  class='input2' type='text' name='telefone' maxlength='9' placeholder='Ex: 0000-5555' ><br>
											
												<label class='label' >Celular</label>
												<input  class='input2' type='text' name='celular' maxlength='10' placeholder='Ex: 90000-5555' <br>
											
												<label class='label'>E-mail</label>
												<input  class='input2' type='text' name='email' placeholder='Ex: fornecedor@empresa.com.br' ><br>
											
												<label class='label'>Site</label>
												<input  class='input2' type='text' name='site' placeholder='Ex: www.site.com.br'><br>
									
												<input class='btnMod' id='conf' type='submit' value='Cadastrar'> 
												
											</form>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a> 
										</div>

										<div class='modalEdit' id='$idEdit'>	
											<h3>Editar Fornecedor</h3>
											<hr>
											<form class='formAdd' method='POST' action='salvarAltFornecedor.php'>
												<input name='id' type='hidden' value='$id'>

												<label class='label'>Razão Social / Nome Fantasia</label><br>
												<input  class='input2' type='text' name='nome' value='$nome'><br>

												<label class='label'>Telefone</label>
												<input  class='input2' type='text' name='telefone' value='$telefone' maxlength='9' placeholder='Ex: 0000-5555' ><br>
											
												<label class='label' >Celular</label>
												<input  class='input2' type='text' name='celular' value='$celular' maxlength='10' placeholder='Ex: 90000-5555' <br>
											
												<label class='label'>E-mail</label>
												<input  class='input2' type='text' name='email' value='$email' placeholder='Ex: fornecedor@empresa.com.br' ><br>
											
												<label class='label'>Site</label>
												<input  class='input2' type='text' name='site' value='$site' placeholder='Ex: www.site.com.br'><br>
									
												<input class='btnMod' id='conf' type='submit' value='Alterar'> 
												
											</form>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a> 
										</div>
										
									";
									
								}
								
								//campo teste paginação
								
								
								for($recebepagina;"";$recepagina++)
								{
								echo $recebepagina;
								}
								
								//campo teste paginação
								
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