<?php
if(!isset($_SESSION))session_start(); 
if((!isset($_SESSION['usuarioNome'])) AND (!isset($_SESSION['tipo_session'])) AND (!isset($_SESSION['usuarioNivel']))){
session_destroy();
header("location:../index.php");
exit;
}
include ("../login/validaUsuario.php");
include ("../conexaoBanco/conexao.php");


?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Gestão Click</title>
		<link rel="stylesheet" type="text/css" href="../css/style2.css" />
				
		<script type="text/javascript" src="../js/scriptSair.js"></script>
		<?php
			//header ("Refresh: 5; url=home.php");
		?>
	</head>
	<body>
		
		<div class="bar">
			<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
		
		</div>
	
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||MENU|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		<?php include ("../menu/menu.php") ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->				
		<div class="container">
			
			<!--<div class="cabecalho">Bem Vindo Usuário!</div>-->
			<div class="conteudo">
				<div class="botoes">
					<div class="btnIni" id="btnVendas"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Vendas
						<br>
						<p class='logobtn'><i class="fa fa-shopping-basket" aria-hidden="true"></i></p>
					</div>
					<a href="../vendas/inicioVendas.php"><div class="linkIni">Acessar agora <i class="fa fa-arrow-right" aria-hidden="true"></i></div></a>
				</div>

				<div class="botoes">
					<div class="btnIni" id="btnProdutos"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda
						<br>
						<p class='logobtn'><i class="fa fa-calendar" aria-hidden="true"></i></p>
						
					</div>
					<a href="../agenda/agenda.php"><div class="linkIni">Acessar agora <i class="fa fa-arrow-right" aria-hidden="true"></i></div></a>
				</div>

				<div class="botoes">
					<div class="btnIni" id="btnReceber"><i class="fa fa-arrow-up" aria-hidden="true"></i> A Receber
						<br>
						<p class='logobtn'><i class="fa fa-arrow-up" aria-hidden="true"></i></p> 
					</div>
					<a href="../contasAreceber/areceber.php"><div class="linkIni">Acessar agora <i class="fa fa-arrow-right" aria-hidden="true"></i></div></a>
				</div>

				<div class="botoes">
					<div class="btnIni" id="btnPagar"><i class="fa fa-arrow-down" aria-hidden="true"></i> A Pagar
						<br>
						<p class='logobtn'><i class="fa fa-arrow-down" aria-hidden="true"></i></p>				
					</div>
					<a href="../contasApagar/apagar.php"><div class="linkIni">Acessar agora <i class="fa fa-arrow-right" aria-hidden="true"></i></div></a>
				</div>
			</div>
		
		
			<div class="contas">
				<div class="blocoContas" id="contasPagar">
					<div class="contasettings" id="tabelaapagar">
						<table class=" tabelIniAp">
							<h3 class="tituloContasInicio"> <i class="fa fa-arrow-down" aria-hidden="true"></i> Contas a pagar</h3>
							<tr tr id="nometabelapagar">
								<th align="center">Vencimento</th>
								<th align="center">Descrição</th>
								<th align="center">Situação</th>
								<th align="center">Valor</th>
								
							</tr>
							<?php
								
								$dados = mysqli_query($conect, "SELECT * FROM contasApagar WHERE situacao = 'Pendente' || situacao = 'Atrasado' ORDER BY dataVencimento ASC");
								
								while($coluna = mysqli_fetch_array($dados)){
 									
									$descricao = $coluna['descricao'];
									$data = $coluna['dataVencimento'];
									$data = date('d-m-Y', strtotime($data));
									$situacao = $coluna['situacao'];		
									$valor = $coluna['valor'];
									$valor = number_format($valor, 2, ',', '.');

									echo"
										<tr class='umtab'>
											<td align='center'>$data</td>
											<td style='padding-left: 10px;'>$descricao</td>
											<td align='center'>$situacao</td>
											<td align='right' style='padding-right: 10px;' >$valor</td>
											
										</tr>
									";
								}
								
							?>
						
						</table>
						
					</div>
				</div>
				<div class="blocoContas" id="contasReceber">
					<div class="contasettings" id="tabelareceber">
						<table class="tabelIniRe">
						<h3 class="tituloContasInicio"> <i class="fa fa-arrow-up" aria-hidden="true"></i> Contas a receber</h3>
						<tr tr id="nometabelareceber">
								<th align="center">Vencimento</th>
								<th align="center">Descrição</th>
								<th align="center">Situação</th>
								<th align="center">Valor</th>
								
						</tr>
						<?php
							include "../conexaoBanco/conexao.php";
							$dados = mysqli_query($conect, "SELECT * FROM contasareceber WHERE situacao = 'Pendente' || situacao = 'Atrasado' ORDER BY dataVencimento ASC");
							while($coluna = mysqli_fetch_array($dados)){
								
								$descricao = $coluna['descricao'];
								$data = $coluna['dataVencimento'];
								$data = date('d-m-Y', strtotime($data));
								$situacao = $coluna['situacao'];
								$valor = $coluna['valor'];
								$valor = number_format($valor, 2, ',', '.');
								
								echo"
									<tr class='umtabhome'>
										<td align='center'>$data</td>
										<td style='padding-left: 10px;'>$descricao</td>
										<td align='center'>$situacao</td>
										<td align='right' style='padding-right: 10px;'>$valor</td>
										
									</tr>
								";
							}
						?>
						</table>
					</div>
				</div>
			</div>
			
			<div class="compromissos">
				<h3 class='nomeAgenda' ><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</h3>
				<table class="calendar">
					
					<tr id="nometabelaagenda">
						<th align="center">Evento</th>
						<th align="center">Data</th>
						<th align="center">Horário</th>
						<th align="center">Local</th>
						<th align="center">Situação</th>
							
					</tr>
					<?php
						include "../conexaoBanco/conexao.php";
						$dados = mysqli_query($conect, "SELECT * FROM agenda WHERE situacao = 'Pendente' ORDER BY dataEvento ASC");
						
						while($coluna = mysqli_fetch_array($dados)){
							
							
							$evento = $coluna['evento'];
							$data = $coluna['dataEvento'];
							$data = date('d-m-Y', strtotime($data));
							$hora = $coluna['hora'];
							$local = $coluna['localidade'];
							$situacao = $coluna['situacao'];
							
							echo"
								<tr class='umtab'>
									<td align='center'>$evento</td>
									<td style='padding-left: 10px;'>$data</td>
									<td align='center'>$hora</td>
									<td align='center'>$local</td>
									<td align='center'>$situacao</td>
									
										
								</tr>
								
							";
						} 
						
					?>			
					
				</table>
			</div>
		</div>
		
	</body>
</html>