<?php 

include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
include "../conexaoBanco/conexao.php";


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
		<?php 
		include ("../menu/menu.php");
		$dados1 = mysqli_query($conect, "SELECT * FROM clientes WHERE situacao = 'ativo' ");
		$coluna1 = mysqli_fetch_array($dados1);

		$idCad = $coluna1['id'].'Cadastrar';
		
		?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		
		<div class="container">
			
			<div class="cabecalhoAreceber"><i class="fa fa-user-plus" aria-hidden="true"></i> Clientes</div>
			<?php
				include ("../alertas/alertas.php");
			?>
			
			<a href="#cadastrar"><button class="btnAdc" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar novo Cliente</button></a>
					
			<form class="buscar" method="POST" action="pesquisaCliente.php">
				<input type="text" name="busca" placeholder="Buscar por nome" ><button class="buscarBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			
			<div class="contasrecebercontent">
				
					<div class="contasettingsareceber" id="tabelaareceber">
						<table class="tabelIniCli">
							<tr id="tabelaCliente">
								<th align="center">ID</th>
								<th align="center">Nome</th>
								<th align="center">Whatsapp</th>
								<th align="center">Instagram</th>
								<th align="center">Facebook</th>
								<th align="center">E-mail</th>
								<th align="center">Situação</th>
								<th align="center" style="width: 100px;">Ações</th>
								
							</tr>
							
							
							
							<?php

								//$pagina = 2;
								//$dados = mysqli_query($conect, "SELECT * FROM clientes WHERE pagina = '$pagina'");
								
								$dados = mysqli_query($conect, "SELECT * FROM clientes WHERE situacao = 'ativo' ");
								
								while($coluna = mysqli_fetch_array($dados)){
									$id = $coluna['id'];
									$idEdit = $coluna['id'].'Editar';
									$nome = $coluna['nome'];
									$whatsapp = $coluna['whatsapp'];
									$instagram = $coluna['instagram'];
									$facebook= $coluna['facebook'];
									$situacao = $coluna['situacao'];
									$email = $coluna['email'];
									
									
							
									echo"
										<tr class='um'>
											<td style='width:  50px; padding-right:10px;' align='right'>$id</td>
											<td style='width: 200px; padding-left: 15px;'>$nome</td>
											<td style='width: 100px;' ><a href='https://web.whatsapp.com/send?phone=5511$whatsapp&ola mundo&source&data' target='_blank' title='Whatsapp'><button class='btnAdWhats' style='margin:0px'><i class='fa fa-whatsapp' aria-hidden='true'>&nbsp$whatsapp</i></button></a></td>
											<td style='width: 100px; padding-left:10px;' ><a href='https://instagram.com/$instagram' target='_blank' title='Instagram'><button class='btnAdInsta' style='margin:0px'><i class='fa fa-instagram' aria-hidden='true'>&nbsp$instagram</i></button></a></td>
											<td style='width: 100px; padding-left:10px;' ><a href='https://facebook.com/$facebook' target='_blank' title='Facebook'><button class='btnAdFace' style='margin:0px'><i class='fa fa-facebook' aria-hidden='true'>&nbsp$facebook</i></button></a></td>
											<td style='width: 200px; padding-left:10px;' >$email</td>
											<td style='width: 60px; padding-left:10px;' >$situacao</td>
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
											
											<a href=\"deleteCli.php?id=$id\"><button class='btnMod' id='conf'>Excluir</button></a>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>
										
										<div class='modalEdit' id='$idEdit'>
											
											<h3>Alterar dados de clientes</h3>
											<hr>
											<form class='formAdd' id='formAdd' method='POST' action='salvarAltCliente.php'>
												<input name='id' type='hidden' value='$id'>	
												
													<label class='label'> Nome</label>
													<input  class='input2' type='text' name='nome' value='$nome' required><br>

													<label class='label' > Whatsapp</label>
													<input  class='input2' type='text' name='whatsapp' value='$whatsapp' required><br>

													<label class='label'> Instagram</label>
													<input  class='input2' type='text' name='instagram' value='$instagram' required><br>

													<label class='label'> Facebook</label>
													<input  class='input2' type='text' name='facebook' value='$facebook' required><br>

													<label class='label'> E-mail</label>
													<input  class='input2' type='text' name='email' value='$email' required><br>

													<label class='label'> Situação</label>
													<select class='input2' name='situacao' value='$situacao' required><br>
														<option value='ativo'>Ativo</option>
														<option value='inativo'>Inativo</option>
													</select><br><br>
														
											
												<input class='btnMod' id='conf' type='submit' value='Alterar'>
	
											</form>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a> 

											
										</div>

										<div class='modalEdit' id='cadastrar'>
											
											<h3>Cadastrar novo cliente</h3>
											<hr>
											<form class='formAdd' id='formAdd' method='POST' action='recebeDadosCli.php'>
												<input name='id' type='hidden' value='$id'>	
												
													<label class='label'> Nome</label>
													<input  class='input2' type='text' name='nome' required><br>

													<label class='label' > Whatsapp</label>
													<input  class='input2' type='text' name='whatsapp' required><br>

													<label class='label'> Instagram</label>
													<input  class='input2' type='text' name='instagram' required><br>

													<label class='label'> Facebook</label>
													<input  class='input2' type='text' name='facebook' required><br>

													<label class='label'> E-mail</label>
													<input  class='input2' type='text' name='email'required><br>

													<label class='label'> Situação</label>
													<select class='input2' name='situacao' required><br>
														<option value='ativo'>Ativo</option>
														<option value='inativo'>Inativo</option>
													</select><br><br>
														
											
												<input class='btnMod' id='conf' type='submit' value='Cadastrar'>
	
											</form>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a> 

											
										</div>
										
									";
									
								}
																
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