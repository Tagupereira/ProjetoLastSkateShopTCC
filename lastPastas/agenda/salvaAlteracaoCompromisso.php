<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");
 
include "../conexaoBanco/conexao.php";

$id = $_POST['id'];
$evento = $_POST['evento'];
$dataEvento = $_POST['data'];
$hora = $_POST['hora'];
$local =$_POST['local'];
$situacao = $_POST['situacao'];
$observacao = $_POST['observacao'];


$conect->query("UPDATE agenda SET evento='$evento', dataEvento='$dataEvento', hora='$hora', localidade='$local', situacao='$situacao', observacao='$observacao'  WHERE id='$id' ");

header("Location: agenda.php?msg=alteradoOk");
?>