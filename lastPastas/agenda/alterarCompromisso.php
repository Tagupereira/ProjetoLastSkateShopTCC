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
		
		<script type="text/javascript" src="../js/scriptSair.js"></script>
	</head>
	<body>
	<?php
		include "../conexaoBanco/conexao.php";
		$id = $_GET["id"];
		$dados = mysqli_query($conect, "SELECT * FROM agenda where id = $id");
			while($coluna = mysqli_fetch_array($dados)){

				$id = $coluna['id'];
				$evento = $coluna['evento'];
				$dataEvento = $coluna['dataEvento'];
				
				$hora = $coluna['hora'];
				$local = $coluna['localidade'];
				$situacao = $coluna['situacao'];
				$observacao = $coluna['observacao'];
		 	}
		 
		?>
		<div class="bar">
			<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
		
		</div>
		<div class="conteudoApagar">
			<div class="formApagar">
				<h3>Adicionar Produto</h3>
				<hr>
				<form class="formAdd" method="POST" action="salvaAlteracaoCompromisso.php">

					<input name="id" type="hidden" value=<?php echo"$id";?>>
					<div class="campos">
						<label >Evento</label><br>
						<input  class="input2" type="text" name="evento" style="width:500x; " value=<?php echo"'$evento'";?> required >
					</div>
					
					<div class="campos">
						<label >Data</label><br>
						<input  class="input2" type="date" name="data" style="width:150px; " value=<?php echo $dataEvento;?> required>
					</div>
					
					<div class="campos">
						<label >Hora</label><br>
						<input  class="input2" type="text" name="hora" style="width:100px; " maxlength="5" value=<?php echo"$hora";?> required>
					</div>
					
					<div class="campos">
						<label >local</label><br>
						<input  class="input2" type="text" name="local" style="width:200px; " value=<?php echo"'$local'";?> required>
					</div>
					
					<div class="campos">
						<label >Situação</label><br>
						<select  class="input2" type="text" name="situacao" style="width:230px; " value=<?php echo"'$situacao'";?> required >
							<option value="pendente">Pendente</option>
							<option value="confirmado">Concluido</option>
							<option value="cancelado">Cancelado</option>				

						</select>
					</div>
					
					<div class="campos">
						<label >Observação</label><br>
						<input  class="input2" type="text" name="observacao" style="width:200px; " value=<?php echo"'$observacao'";?> required>
					</div>
									
					<div class="btadcApa">
						<input id="cad" type="submit" value="Cadastrar" onclick = 'sucesso()'> 
						<input id="canc" type="reset" value="Cancelar" onclick ="window.location.href='agenda.php'">
					</div>
				</form>
			</div>
			
		</div>
		
		
	</body>
</html>