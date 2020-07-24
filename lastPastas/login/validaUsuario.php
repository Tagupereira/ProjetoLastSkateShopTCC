<?php 

if ($_SESSION['usuarioNivel'] == "vendedor"){	
	header ("location:../vendas/inicioVendas.php?msg=4");
}

?>