<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
 
include ("../conexaobanco/conexao.php");

$id = $_POST['cod'];
$nome = $_POST['nome'];
$apelido = $_POST['apelido'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];
$email= $_POST['email'];
$funcao = $_POST['funcao'];
$situacao = $_POST['situacao'];

$conect->query("UPDATE login SET user='$nome', senha='$senha', telefone='$telefone', email='$email', funcao='$funcao', situacao='$situacao', apelido='$apelido' WHERE cod='$id' ");

$_SESSION['usuarioApelido'] = $apelido;

header("Location: users.php?msg=alteradoOk");
?>