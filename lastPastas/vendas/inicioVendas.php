<?php
include ("../login/sessao.php");
include ("../conexaoBanco/conexao.php");


?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Gestão Click</title>
		<link rel="stylesheet" type="text/css" href="../css/style2.css" />
		<link rel="stylesheet" type="text/css" href="../css/modal.css" />
		<link rel="stylesheet" type="text/css" href="../css/alertas.css" />
		
		<script type="text/javascript" src="../js/scriptSair.js"></script>

	</head>
	<body>
		
		<div class="bar">
			
			
			<i class="fa fa-sign-out" aria-hidden="true"></i><button class="signout" onclick = "sair()"> sign-out</button>
		
		</div>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||MENU|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		<?php include ("../menu/menu.php") ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				
		<div class="container">
			
			
			<div class="cabecalhoProdutos"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Vendas</div>
			
			<?php 
			
				include ("../alertas/alertas.php");
				
							
			
				$max = mysqli_query($conect, "SELECT max(cod_venda) as codigo FROM vendas;");
				
				$coluna2 = mysqli_fetch_array($max);

				$codMax = $coluna2['codigo']+1 ;
					
				echo "<a href='vendas.php?codVenda=$codMax'><button class='btnAdc' ><i class='fa fa-plus-circle' aria-hidden='true'></i> Adicionar venda</button></a>";
			?>
			<div class="contasrecebercontent">
				
				<div class="contasettingsareceber" id="tabelaareceber">
					<table class="tabelIniprod">
						<tr id="nometabelaProdutos">
							
							
							<th align="center">Cód.</th>
							<th align="center">Cliente</th>
							<th align="center">Vendedor</th>
							<th align="center">Vr.Venda</th>
							<th align="center">Data venda</th>
							<th align="center">Ações</th>
							
						</tr>
						<?php
							
							include "../conexaoBanco/conexao.php";
							$dados = mysqli_query($conect, "SELECT * FROM vendas GROUP BY cod_venda ORDER BY cod_venda desc");
							
							while($coluna = mysqli_fetch_array($dados)){
								
								$cod = $coluna['cod_venda'];
								$vendedor = $coluna['vendedor'];
								$cliente = $coluna['cliente'];
								$data_venda = $coluna['data_venda'];
								$data_venda = date('d-m-Y', strtotime($data_venda));
								$somaVenda = mysqli_query($conect, "SELECT sum(preco_venda) as total FROM vendas WHERE cod_venda = $cod ");
								$coluna2 = mysqli_fetch_array($somaVenda);
								$valor_venda = $coluna2['total'];
								$valor_venda = number_format($valor_venda, 2, ',', '.');
								
								echo "
									<tr class='um'>
																				
										<td style='width: 100px;' align='center';>$cod</td>
										<td style='padding-left: 10px;'>$cliente</td>
										<td style=' width: 130px; text-align: center; padding-left: 10px;'>$vendedor</td>
										<td style= 'padding-right: 10px; width: 80px;' align='right'>$valor_venda</td>
										<td style='width: 150px;' align='center'>$data_venda</td>
										<td id='acoes' style='width: 70px;'align='center'>
											<a href=comprovanteVenda.php?codVenda=$cod target='_blank'><button class='btn' id='vs' title='Visualizar venda'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
										</td>
										
									</tr>
									";

							}
						?>
					</table>
				</div>
			</div>	
		</div>
	</body>
</html>