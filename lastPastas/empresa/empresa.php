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
			
			<div class="cabecalhoProdutos"><i class="fa fa-industry" aria-hidden="true"></i> Dados da empresa</div>
			
			<?php
			include "../conexaoBanco/conexao.php";
			include ("../alertas/alertas.php");
			$dados = mysqli_query($conect, "SELECT * FROM empresa");
			
			
			$coluna = mysqli_fetch_array($dados);
				$id = $coluna['id'];
				$nome = $coluna['nome'];
				$cnpj = $coluna['cnpj'];
				$telefone = $coluna['telefone'];
				$email = $coluna['email'];
				$logo = $coluna['logo'];
			
				echo"
				<div class='contentAlteraLogo'>	
					<div class='imgLogo'>
						<img class='logoEdit' src='$logo' alt='logo'>
					</div>
					<div class='dadosEmpresa'>
						
							<label class='label'for='nome'>Razão Social</label><br>
							<input class='inputDadosEmpresa' type='text' name='nome' value='$nome' readonly='true'><br>

							<label class='label'for='cnpj'>CNPJ</label><br>
							<input class='inputDadosEmpresa' type='text' name='cnpj' value='$cnpj' readonly='true'><br>

							<label class='label'for='telefone'>Telefone</label><br>
							<input class='inputDadosEmpresa' type='text' name='telefone' value='$telefone' readonly='true'><br>
							
							<label class='label'for='email'>E-mail</label><br>
							<input class='inputDadosEmpresa' type='text' name='email' value='$email' readonly='true'><br>

							<a href='#modalD'><button class='configBtn' id='edi'>Alterar Dados</button></a>
						
					</div>
				</div>

				<div class='modalD' id='modalD'>
					<h3>Alterar dados da empresa</h3>
					<hr><br>
						<form>
							<label class='label' for='nome'>Razão Social</label><br>
							<input class='inputDadosEmpresa' type='text' name='nome' value='$nome'><br>

							<label class='label' for='cnpj'>CNPJ</label><br>
							<input class='inputDadosEmpresa' type='text' name='cnpj' value='$cnpj'><br>

							<label class='label' for='telefone'>Telefone</label><br>
							<input class='inputDadosEmpresa' type='text' name='telefone' value='$telefone'><br>
							
							<label class='label' for='email'>E-mail</label><br>
							<input class='inputDadosEmpresa' type='text' name='email' value='$email'><br>

							<label class='label' for='logo'>Alterar imagem</label><br>
							<input type='file' name='logo'><br><br>

							<input class='configBtn' id='edi' type='submit' value='Alterar dados'>
						</form>
						<a href='#'><button class='configBtn' id='exc' value='Alterar dados'>Cancelar</button></a>
					</div>

					<div class='bg'></div>
				";
				
			?>
			
		<div>
		
	</body>
</html>