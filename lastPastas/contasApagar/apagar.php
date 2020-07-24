<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

	include_once "../conexaoBanco/conexao.php";
	

	$sqlsoma = "SELECT sum(valor) total from contasapagar where situacao = 'Pendente' || situacao = 'Atrasado' ";
	$soma = mysqli_query($conect, $sqlsoma);
	$somaa = mysqli_fetch_assoc($soma);
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
			<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
		
		</div>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||MENU|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		<?php include ("../menu/menu.php") ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				
		<div class="container">
			
			<div class="cabecalhoApagar"><i class="fa fa-arrow-down" aria-hidden="true"></i> 
			Listar Contas a pagar
			
			

				<div class="saldoAp">
					<p id="saldo-apagar-atual">Saldo em aberto:</p>
					R$ <?php 
						$soma = number_format($somaa["total"], 2, ',', '.');
					echo $soma;
					
					?>
				</div>
			</div>
			<?php
				include ("../alertas/alertas.php");
			?>
			
			<a href="#cadastrar"><button class="btnAdc" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar pagamento</button></a>
			
			<div class="contasapagarcontent">
				
					<div class="contasettingsapagar" id="tabelaapagar">
						<table class="tabelIni">
							<tr id="nometabelapagar">
								<th align="center">ID</th>
								<th align="center">Descrição</th>
								<th align="center">Forma de Pagamento</th>
								<th align="center">Data Vencimento</th>
								<th align="center" style='width: 100px;'>Situação</th>
								<th align="center">Valor total</th>
								<th align="center" style="width: 100px;">Ações</th>
								
							</tr>
							<?php							
								$dataAtual = date('d-m-Y');
								$dados = mysqli_query($conect, "SELECT * FROM contasApagar");
								
								while($coluna = mysqli_fetch_array($dados)){
									$id = $coluna['id'];
									$idAS = $coluna['id']."situacao";
									$idEdit = $coluna['id']."alterar";
									$descricao = $coluna['descricao'];
									$pagamento = $coluna['pagamento'];
									$situacao = $coluna['situacao'];
									$ocorrencia = $coluna['ocorrencia'];
									$vr = $coluna['valor'];
									$valor = number_format($vr, 2, ',', '.');
									
									$dataEdit = $coluna['dataVencimento'];
									$data = $coluna['dataVencimento'];
									$data = date('d/m/Y', strtotime($data));
									
									
									$situacao = $coluna['situacao'];
									
									
									
									echo"
										<tr class='um'>
											<td style='padding-left: 10px;'>$id</td>
											<td style='padding-left: 10px;'>$descricao</td>
											<td style='width: 200px;' align='center'>$pagamento</td>
											<td style='width: 150px;' align='center'>$data</td>
											<td style='width: 130px;' align='center'><a href='#$idAS'><button id='$situacao'>$situacao</button></a></td>
											<td style='width: 100px; padding-right: 10px;' align='right'>$valor</td>
											<td id='acoes' style='width: 100px;'align='center' >
												<a href='#$id'><button class='btn' id='ex' title='Excluir'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>
												<a href='#$idEdit'><button class='btn' id='ed' title='Editar'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
											</td>
											
										</tr>
										<div class='modal' id='$id'>
												
											<p class='espaco'>Deletar compromisso '$id'</p></br>
											<hr>
											<br>
											<div id='alert'>Deseja excluir <br>'$descricao ?'</div>
											<br>
											<hr>
											<a href=\"deleteAP.php?id=$id\"><button class='btnMod' id='conf'>Excluir</button></a>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
											
										</div>

										<div class='modal' id='$idAS'>
												
											<p class='espaco' id='title'>Alterar Situação</p></br>
											<hr>
											<br>
											<div id='alert'>$descricao '$situacao'</div></br>
											Alterar situacao do pagamento ?</br>
											<form method='POST' action='alterarSituacao.php'>
											<input name='id' value=$id hidden >
											<select id='select' name='situacaoAlt'>
												<option name='situacaoAlt' value='confirmado'>Confirmado</option>
												<option name='situacaoAlt' value='pendente'>Pendente</option>
												<option name='situacaoAlt' value='atrasado'>Atrasado</option>
											</select>
											<br><br>
											<hr>
											<a href=\"alterarSituacao.php?id=$id\"><button type='submit' class='btnMod' id='conf'>Alterar</button></a>
											</form>
											<a href=\"#\"><button class='btnMod' id='exc'>Cancelar</button></a>
									
										</div>

										<div class='modalEdit' id='$idEdit'>
											<h3>Editar pagamento</h3>
											<hr>
											<form method='POST' action='salvarDadosAlterados.php'>
												<input name='id' type='hidden' value='$id'>
											
												<label class='label'>Descrição do pagamento</label><br>
												<input  class='input2' type='text' name='descricao' value='$descricao' required>
											
												<label class='label'>Ocorrência</label><br>
												<select  class='input2' type='text' name='ocorrencia'>
													<option name='ocorrencia' value='$ocorrencia' checked>$ocorrencia</option>
													<option name='ocorrencia' value='Diaria'>Diária</option>
													<option name='ocorrencia' value='Semanal'>Semanal</option>
													<option name='ocorrencia' value='Mensal'>Mensal</option>
													<option name='ocorrencia' value='Anual'>Anual</option>
												</select>
											
												<label class='label'>Vencimento</label><br>
												<input class='input2' type='date' name='data' placeholder='Ex.: dd/mm/aaaa' maxlength='10' value='$dataEdit' required >
											
												<label class='label'>Forma de pagamento</label><br>
												<select  class='input2' type='text' name='pagamento' required >
													<option  name='pagamento' value='$pagamento' checked>$pagamento</option>
													<option  name='pagamento' value='Dinheiro'>Dinheiro</option>
													<option  name='pagamento' value='Credito'>Cartão de Credito</option>
													<option  name='pagamento' value='Debito'>Cartão de Débito</option>	
												</select>
											
												<label class='label'>Situação</label><br>
												<select  class='input2' type='text' name='situacao' required>
													<option name='situacao' value='$situacao' checked>$situacao</option>
													<option name='situacao' value='confirmado'>Confirmado</option>
													<option name='situacao' value='pendente'>Pendente</option>
													<option name='situacao' value='atrasado'>Atrasado</option>
												</select>
												
												<label class='label'>Valor bruto</label><br>
												<input class='input2' type='text' name='valor' value='$valor' required>
											
												<button type='submit' class='btnMod' id='confirm'>Alterar</button>
											</form>
												
												<a href='#'><button class='btnMod' id='exc'>Cancelar</button></a>
										</div>

									
										";
								}

								echo "
									<div class='modalEdit' id='cadastrar'>
										<h3>Adicionar pagamento</h3>
										<hr>
										<br>
										<form method='POST' action='recebeDadosAP.php'>
											
											<label class='label'>Descrição do pagamento</label><br>
											<input  class='input2' type='text' name='descricao' required><br>
									
											<label class='label'>Ocorrência</label><br>
											<select  class='input2' type='text' name='ocorrencia'>
												<option value='Diaria'>Diária</option>
												<option value='Semanal'>Semanal</option>
												<option value='Mensal'>Mensal</option>
												<option value='Anual'>Anual</option>
											</select><br>
										
											<label class='label'>Vencimento</label><br>
											<input class='input2' type='date' name='data' placeholder='Ex.: dd/mm/aaaa' maxlength='10' required ><br>
									
											<label class='label'>Pagamento quitado</label><br>
											<select  class='input2' type='text' name='situacao' required>
												<option value='pendente'>Não</option>
												<option value='confirmado'>Sim</option>
											</select><br>

											<label class='label'>Forma de pagamento</label><br>
											<select  class='input2' type='text' name='pagamento' required >
												<option value='Dinheiro' checked >Dinheiro</option>
												<option value='Credito'>Cartão de Credito</option>
												<option value='Debito'>Cartão de Débito</option>	
											</select><br>
											
											<label >Data de compensação</label><br>
											<input class='input2' type='date' name='datacompensacao' placeholder='Ex.: dd/mm/aaaa' maxlength='10'><br>
										

											<label class='label'>Valor bruto</label><br>
											<input class='input2' type='text' name='valor' required><br>

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