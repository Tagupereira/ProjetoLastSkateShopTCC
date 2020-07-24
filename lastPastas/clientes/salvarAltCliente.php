<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
include "../conexaoBanco/conexao.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$whatsapp = $_POST['whatsapp'];
$instagram = $_POST['instagram'];
$facebook = $_POST['facebook'];
$email = $_POST['email'];
$situacao = $_POST['situacao'];


$conect->query("UPDATE clientes SET nome='$nome', whatsapp='$whatsapp', instagram='$instagram', facebook='$facebook', email='$email', situacao='$situacao' WHERE id='$id' ");


header("Location: clientes.php?msg=alteradoOk");



?>