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
		<link rel="stylesheet" type="text/css" href="../css/situacoes.css" />
		<link rel="stylesheet" type="text/css" href="../css/modal.css" />
		<link rel="stylesheet" type="text/css" href="../css/alertas.css" />
		
		<script type="text/javascript" src="../js/scriptSair.js"></script>

	</head>
	<body>
		
		<div class="bar">
			<i class="fa fa-bell-o" aria-hidden="true"title="Nenhum aviso encontrado!"></i>&nbsp &nbsp &nbsp
			<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
		
		</div>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||MENU|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		<?php include ("../menu/menu.php") ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				
		<div class="container">
			
			<div class="cabecalhoAreceber"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</div>
			<?php
				include ("../alertas/alertas.php");
			?>
			
			<a href='#cadastrar'><button class="btnAdc" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar compromisso</button></a>
			
			
			<div class="contasrecebercontent">
				
					<div class="contasettingsareceber" id="tabelaareceber">
						<table class="tabelIniRec">
							<tr id="nometabelareceber">
								<th align="center">ID</th>
								<th align="center">Evento</th>
								<th align="center">Data</th>
								<th align="center">Hora</th>
								<th align="center">Local</th>
								<th align="center" style='width: 100px;'>Situação</th>
								<th align="center" style='width: 100px;'>Observação</th>
								<th align="center" style="width: 100px;">Ações</th>
								
							</tr>
							<?php
								include "../conexaoBanco/conexao.php";
								$dados = mysqli_query($conect, "SELECT * FROM agenda ORDER BY dataEvento ASC");
								
								while($coluna = mysqli_fetch_array($dados)){
									$id = $coluna['id'];
									$id2 = $coluna['id']."situacao";
									$idEdit = $coluna['id']."alterar";
									$evento = $coluna['evento'];
									$dataEdit = $coluna['dataEvento'];
									$data = $coluna['dataEvento'];
									$data = date('d/m/Y', strtotime($data));
									$hora = $coluna['hora'];
									$local = $coluna['localidade'];
									$situacao = $coluna['situacao'];
									$observacao = $coluna['observacao'];

									echo"
										<tr class='um'>
											<td style='width: 50px;' align= 'center'>$id</td>
											<td style='padding-left: 10px;'>$evento</td>
											<td style='width: 100px;' align='center'>$data</td>
											<td style='width: 80px;' align='center'>$hora</td>
											<td style='width: 150px;' align='center'>$local</td>
											<td style='width: 110px;' align='center'><a href='#$id2'><button id='$situacao'>$situacao</button></a></td>
											<td style='width: 150px; padding-left: 10px;' title='$observacao'>$observacao</td>
											<td id='acoes' style='text-align:center' >
												<a href='#$id'><button class='btn' id='ex' title='Excluir'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>
												<a href='#$idEdit'><button class='btn' id='ed' title='Editar'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
											</td>
										</tr>
										
										<div class='modal' id='$id'>
											
											<p class='espaco'>Deletar compromisso '$id'</p></br>
											<hr>
											<br>
											<div id='alert'>Deseja excluir <br>'$evento'</div>
											<br>
											<hr>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
											<a href=\"deleteAgenda.php?id=$id\"><button class='btnMod' id='conf'>Excluir</button></a>
										</div>

										<div class='modal' id='$id2'>
												
											<p class='espaco' id='title'>Alterar Situação</p></br>
											<hr>
											<br>
											<div id='alert'>$evento '$situacao'</div></br>
											Alterar situacao do recebimento ?</br>
											<form method='POST' action='alterarSituacao.php'>
											<input name='id' value=$id hidden >
											<select id='select' name='situacaoAlt'>
												<option value='confirmado'>Confirmado</option>
												<option value='pendente'>Pendente</option>
												<option value='cancelado'>Cancelado</option>
											</select>
											<br><br>
											<hr>
											<a href=\"alterarSituacao.php?id=$id\"><button type='submit' class='btnMod' id='conf'>Alterar</button></a>
											</form>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
																			
										</div>


										<div class='modalEdit' id='$idEdit'>
											<h3>Alterar Evento</h3>
											<hr>
											<br>
											<form method='POST' action='salvaAlteracaoCompromisso.php'>
												<input name='id' type='hidden' value='$id'>

												<label class='label'>Evento</label><br>
												<input  class='input2' type='text' name='evento' value='$evento' required >
											
												<label class='label'>Data</label><br>
												<input  class='input2' type='date' name='data' value='$dataEdit' required>
										
												<label class='label'>Hora</label><br>
												<input  class='input2' type='text' name='hora' value='$hora' maxlength='5' required>
												
												<label class='label'>local</label><br>
												<input  class='input2' type='text' name='local' value='$local' required>
											
												<label class='label'>Situação</label><br>
												<select  class='input2' type='text' name='situacao' required >
													<option value='$situacao'>$situacao</option>
													<option value='pendente'>Pendente</option>
													<option value='confirmado'>Concluido</option>
													<option value='cancelado'>Cancelado</option>				
						
												</select>
											
												<label class='label'>Observação</label><br>
												<input  class='input2' type='text' name='observacao' value='$observacao' required>
												
																
												<button type='submit' class='btnMod' id='confirm'>Alterar</button>
											</form>
													
												<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>
	
									";
									
								}

								echo "
								<div class='modalEdit' id='cadastrar'>
									<h3>Adicionar Evento</h3>
									<hr>
									<br>
									<form method='POST' action='recebeDadosAgenda.php'>
										
										<label class='label'>Evento</label><br>
										<input  class='input2' type='text' name='evento' required >
									
										<label class='label'>Data</label><br>
										<input  class='input2' type='date' name='data'  required>
								
										<label class='label'>Hora</label><br>
										<input  class='input2' type='text' name='hora' maxlength='5' required>
										
										<label class='label'>local</label><br>
										<input  class='input2' type='text' name='local' required>
									
										<label class='label'>Situação</label><br>
										<select  class='input2' type='text' name='situacao' required >
											<option value='pendente'>Pendente</option>
											<option value='confirmado'>Concluido</option>
											<option value='cancelado'>Cancelado</option>				
				
										</select>
									
										<label class='label'>Observação</label><br>
										<input  class='input2' type='text' name='observacao' required>
										
														
										<button type='submit' class='btnMod' id='confirm'>Cadastrar</button>
									</form>
											
										<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
								</div>
								";

								echo"
									<div class='bg'></div>
								";
							?>
	
						</table>
					</div>
				
			</div>	
		</div>
		
	</body>
</html>