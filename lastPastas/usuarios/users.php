<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
if ($_SESSION['ativo'] == "inativo"){
	header("location:../index.php");
	$_SESSION['errorLogin'] = "Usuário Inativo!";
}
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
		<link rel="stylesheet" type="text/css" href="../css/situacoes.css" />
		
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
			
			<div class="cabecalhoAreceber"><i class="fa fa-users" aria-hidden="true"></i> Usuários</div>
			
			<?php
				include ("../alertas/alertas.php");
			?>
			
			<a href="#cadastrar"><button class="btnAdc" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar novo usuário</button></a>
						
			<div class="contasrecebercontent">
				
					<div class="contasettingsareceber" id="tabelaareceber">
						<table class="tabelIniCli">
							<tr id="tabelaCliente">
								<th align="center">ID</th>
								<th align="center">Nome</th>
								<th align="center">Apelido</th>
								<th align="center">Telefone</th>
								<th align="center">E-mail</th>
								<th align="center">Função</th>
								<th align="center">Situação</th>
								<th align="center" style="width: 100px;">Ações</th>
								
							</tr>
							
							
							
							<?php
								include "../conexaoBanco/conexao.php";
								$dados = mysqli_query($conect, "SELECT * FROM login");
								while($coluna = mysqli_fetch_array($dados)){
									$id = $coluna['cod'];
									$idEdit = $coluna['cod']."alterar";
									$nome = $coluna['user'];
									$apelido = $coluna['apelido'];
									$senha = $coluna['senha'];
									$telefone = $coluna['telefone'];
									$email = $coluna['email'];
									$funcao = $coluna['funcao'];
									$situacao= $coluna['situacao'];
									
									
							
									echo"
										<tr class='um'>
											<td id='cod'style='width:  30px; padding-right:10px;' align='right'>$id</td>
											<td id='user'style='width: 200px; padding-left: 15px;'>$nome</td>
											<td id='senha'style='width: 200px; padding-left: 15px;'>$apelido</td>
											<td id='telefone'style='width: 100px;' ><a href='https://web.whatsapp.com/send?phone=5511$telefone&text&source&data' target='_blank' title='Whatsapp'><button class='btnAdWhats' style='margin:0px'><i class='fa fa-whatsapp' aria-hidden='true'>&nbsp$telefone</i></button></a></td>
											<td id='email'style='width: 150px; padding-left:10px; padding-right:10px;' align='left'>$email</td>
											<td id='funcao'style='width: 120px; padding-left:10px;' align='left'>$funcao</td>
											<td id='situacao'style='width: 100px; text-align: center;'><button id='$situacao'>$situacao</button></td>
											<td id='acoes' style='width: 80px;'align='center'>
												<a href='#$id'><button class='btn' id='ex' title='Excluir'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>
												<a href='#$idEdit'><button class='btn' id='ed' title='Editar'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
											</td>
											
										</tr>
										<div class='modal' id='$id'>
											
											<p class='espaco'>Deletar Usuário '$id'</p></br>
											<hr>
											<br>
											<div id='alert'>Deseja excluir <br>'$apelido ?'</div>
											<br>
											<hr>
											<a href=\"deletarUser.php?cod=$id\"><button class='btnMod' id='conf'>Excluir</button></a>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>

										<div class='modalEdit' id='$idEdit'>
											<h3>Alterar Usuários</h3>
											<hr>
											<form method='POST' action='salvarAltUser.php'>
												<input name='cod' type='hidden' value='$id'>

												<label class='label'>Nome</label><br>
												<input  class='input2' type='text' name='nome' value='$nome' required>
												
												<label class='label'>Apelido</label><br>
												<input  class='input2' type='text' name='apelido' value='$apelido' required>
											
												<label class='label'>Senha</label><br>
												<input  class='input2' type='password' name='senha' value='$senha' required>
											
												<label class='label'>Telefone</label><br>
												<input  class='input2' type='text' name='telefone' value='$telefone' maxlength='10' required>
											
												<label class='label'>E-mail</label><br>
												<input  class='input2' type='text' name='email' value='$email' required>
											
												<label class='label'>Função</label><br>
												
												<select class='input2' type='text' name='funcao' required>
													<option name='funcao' value='$funcao'>$funcao</option>
													<option name='funcao' value='administrador'>Administrador</option>
													<option name='funcao' value='vendedor'>Vendedor</option>
												</select>
											
												<label class='label'>Situação</label><br>
												<select class='input2' name='situacao' required>
													<option name='situacao' value='$situacao'>$situacao</option>
													<option name='situacao' value='ativo'>Ativo</option>
													<option name='situacao' value='inativo'>Inativo</option>
												</select>
											
												<button type='submit' class='btnMod' id='conf'>Alterar</button>
											</form>
													
											<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>	
										</div>
									";
								}

								echo"
									<div class='modalEdit' id='cadastrar'>
										<h3>Adicionar Usuários</h3>
										<hr>
										<form method='POST' action='adicionaUsers.php'>
											
											<label class='label'>Nome</label><br>
											<input  class='input2' type='text' name='nome' required>
											
											<label class='label'>Apelido</label><br>
											<input  class='input2' type='text' name='apelido' required>
										
											<label class='label'>Senha</label><br>
											<input  class='input2' type='password' name='senha' required>
										
											<label class='label'>Telefone</label><br>
											<input  class='input2' type='text' name='telefone' required>
										
											<label class='label'>E-mail</label><br>
											<input  class='input2' type='text' name='email' required>
										
											<label class='label'>Função</label><br>
											
											<select class='input2' type='text' name='funcao' required>
												<option value='administrador'>Administrador</option>
												<option value='vendedor'>Vendedor</option>
											</select>
										
											<label class='label'>Situação</label><br>
											<select class='input2' name='situacao' required>
												<option value='ativo'>Ativo</option>
												<option value='inativo'>Inativo</option>
											</select>
										
											<button type='submit' class='btnMod' id='conf'>Cadastrar</button>
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