<?php
date_default_timezone_set('America/Sao_Paulo');
if(!isset($_SESSION)) session_start(); 
if((!isset($_SESSION['usuarioNome'])) AND (!isset($_SESSION['tipo_session'])) AND (!isset($_SESSION['usuarioNivel']))){
session_destroy();
header("location:../index.php");
exit;
}
?>