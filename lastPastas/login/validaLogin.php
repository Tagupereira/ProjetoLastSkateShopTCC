<?php
	session_start();
	include_once("../conexaoBanco/conexao.php");
	mysqli_query($conect, 'CALL tr_atualiza_data()');

	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	
	if((isset($login)) && (isset($senha))){
		
		$login = mysqli_real_escape_string($conect, $login); //previne SQL injection
		$senha = mysqli_real_escape_string($conect, $senha);
		
		$result_usuario = "SELECT * FROM login WHERE user ='$login' AND senha = '$senha' LIMIT 1";
		$resultado_usuario = mysqli_query($conect, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
		
		if(isset($resultado)){
			
			$_SESSION['usuarioId'] = $resultado['cod'];
			$_SESSION['usuarioNome'] = $resultado['user'];
			$_SESSION['usuarioApelido'] = $resultado['apelido'];
			$_SESSION['usuarioNivel'] = $resultado['funcao'];
			$_SESSION['ativo'] = $resultado['situacao'];
			
			if($_SESSION['ativo']!= 'inativo' ){
				if($_SESSION['usuarioNivel'] == "administrador"){
					header("location: ../home/home.php");
					
				}elseif ($_SESSION['usuarioNivel'] == 'vendedor'){
					header("location: ../vendas/inicioVendas.php");
				}
			}else{
				header("location: ../index.php");
				$_SESSION['errorLogin'] = "Usuário Inativo!";
			}
		}else{
			
			header("location: ../index.php");
			$_SESSION['errorLogin'] = "Login e senha inválidos!";
		}
	}else{
		$_SESSION['errorLogin'] = "Login e senha inválidos!";
		header("location: index.php");
	}	

?>

