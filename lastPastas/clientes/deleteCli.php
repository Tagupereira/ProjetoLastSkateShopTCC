<?php 
include ("../login/sessao.php"); 
include ("../login/validaUsuario.php");

// aqui voce conecta ao banco
include "../conexaoBanco/conexao.php";

// aqui a variavel $rm recebe o valor do banco enviado do formulario
$id = $_GET["id"];
$validate = $_GET["validate"];

//executa uma consulta e deleta no banco
//$sqld = "DELETE FROM clientes WHERE id=$id";

//altera a situacao para inativo inves de deletar o cadastro
if($validate == "del"){
    $sqld = "DELETE FROM clientes WHERE id=$id";

    $query = $conect -> query($sqld);
}
else{
$sqld = "UPDATE clientes SET situacao = 'inativo' WHERE id=$id";

$query = $conect -> query($sqld);
}

// retorna a pagina de listagem do banco

header('Location: clientes.php?msg=excluidoOk');

?>