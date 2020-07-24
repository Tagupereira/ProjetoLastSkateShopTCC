<?php 
 
	include ("../login/sessao.php"); 
	include ("../conexaoBanco/conexao.php");
	


?>	
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||MENU|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		
		<div class="nav">
			
			<div id="logo">
				<a href="../home/home.php">
					<i class="fa fa-user-circle" aria-hidden="true"></i>
				</a>
				<br>
				<h3 id='nomeuser'><?php echo $_SESSION['usuarioApelido'];?></h3>
				
			</div>
		
			
			<div class="item">
				<!--img id="logo" src="img/logo.png"-->
				<input type="checkbox" id="check1">
				<label for="check1"><i class="fa fa-users" aria-hidden="true"></i> Cadastros</label>
				<ul>
					<li><a href="../clientes/clientes.php"> Clientes</a></li>
					<li><a href="../fornecedores/fornecedores.php">Fornecedores</a></li>
				</ul>
			</div>
			
			<div class="item">
				<input type="checkbox" id="check2">
				<label for="check2"><i class="fa fa-barcode" aria-hidden="true"></i> Produtos</label>

				<ul>
					<li><a href="../produtos/produtos.php"> Gerenciar Produtos</i></a></li>					
				</ul>
			</div>

			<div class="item">
				<input type="checkbox" id="check3">
				<label for="check3"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Vendas</label>
				<ul>
				<?php 
			
			
			
						
		
					$max = mysqli_query($conect, "SELECT max(cod_venda) as codigo FROM vendas;");
					
					$coluna2 = mysqli_fetch_array($max);

					$codMax = $coluna2['codigo']+1 ;
				
					echo "<li><a href='../vendas/vendas.php?codVenda=$codMax'> Nova Venda</i></a></li>";
				?>	
				</ul>
				<ul>
					<li><a href="../vendas/inicioVendas.php"> Listar Vendas</i></a></li>
				</ul>
			</div>
			<!--
			<div class="item">
				<input type="checkbox" id="check4">
				<label for="check4"><i class="fa fa-cube" aria-hidden="true"></i> Estoque</label>
				<ul>
					<li><a href="../estoque/estoque"> Estoque</a></li>
				</ul>
			</div> -->
			
			<div class="item">
				<input type="checkbox" id="check5">
				<label for="check5"><i class="fa fa-money" aria-hidden="true"></i> Financeiro</label>
				<ul>
					<li><a href="../contasApagar/apagar.php"> Contas a pagar</a></li>
					<li><a href="../contasAreceber/areceber.php"> Contas a receber</a></li>
				</ul>
			</div>
			
			<div class="item">
				<input type="checkbox" id="check6">
				<label for="check6"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</label>
				<ul>
					<li><a href="../agenda/agenda.php"> Agenda</a></li>
				</ul>
			</div>
			
			<!--
			<div class="item">
				<input type="checkbox" id="check7">
				<label for="check7"><i class="fa fa-print" aria-hidden="true"></i> Relatórios</label>
				<ul>
					<li><a href="#"> Clientes</a></li>
					<li><a href="#"> Produtos</a></li>
					<li><a href="#"> Financeiro</a></li>
					<li><a href="#"> Vendas</a></li>
					
				</ul>
			</div>
			
			-->
			<div class="item">
				<input type="checkbox" id="check9">
				<label for="check9"><i class="fa fa-cog" aria-hidden="true"></i> Configurações</label>
				<ul>
					<li><a href="../empresa/empresa.php"><i class="fa fa-industry" aria-hidden="true"></i> Dados da empresa</a></li>
					<li><a href="../usuarios/users.php"><i class="fa fa-user" aria-hidden="true"></i> Usúarios</a></li>
					<li><a href="../clientes/clientesExcluidos.php"><i class="fa fa-user-times" aria-hidden="true"></i> Clientes Excluidos</a></li>
					<li><a onclick = "sair()"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
					
				</ul>
			</div>
			
		</div>
