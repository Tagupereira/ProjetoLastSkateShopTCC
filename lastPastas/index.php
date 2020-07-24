<?php
	session_start();
	unset (
	
	$_SESSION['usuarioId'],
	$_SESSION['usuarioNivel'],
	$_SESSION['usuarioNome'],
	$_SESSION['tipo_session']
);

?>
<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" >
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>Last SkateShop</title>
	</head>
	<body>
		<div class="formUser">
		
			<form method='POST' action="login/validaLogin.php">
			
				<img src="img/logo.png"width="150px"/>
				<!-- <h1>Login</h1> -->
				<!--<i class="fa fa-user" aria-hidden="true"></i> -->
				<input class="campo"type="text" name="login" placeholder="LOGIN" autofocus="true" required autocomplete="off">
			
				<!--<i class="fa fa-lock" aria-hidden="true"></i>--> 
				<input class="campo"type="password" name="senha" placeholder="SENHA" required autocomplete="off">
				
				<div class="error">
					<?php
						if(isset($_SESSION['errorLogin']))
						{
							echo $_SESSION['errorLogin']."<br><br>";
							unset($_SESSION['errorLogin']);
						}
					?>
				</div>	
				<input type="submit" id="button" value="ENTRAR">
							
			</form>
				
			<!--a href="alterar.html" id="altCad">Esqueci minha senha?</a-->
			<br>
			<br>
			<h6>Projeto TCC Etec Jardim Angela</h6>
		</div>
	
	</body>
	
</html>
