function sair(){
		var x;
		//recebe o valor do botão pressionado ok ou cancelar em uma variavel
		var r=confirm("Deseja Sair?");
		if (r==true)
		{
		  window.location.href = "../index.php";
		}
		else
		{
		  return;
		}
	}

function excluir(){
	alert("Excluido com sucesso!");
}
