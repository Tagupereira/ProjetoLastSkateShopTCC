/*$(function(){
	$("#nome_produto").keyup(function(){
		//Recuperar o valor do campo
		var pesquisa = $(this).val();
		
		//Verificar se tem algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}
			$.post('pesq_venda.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$("#resultado").empty().html(retorna);
			});
		}
	});
});*/