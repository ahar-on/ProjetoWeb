<?php 

	session_start();
	require_once 'funcoes.php'; 
	$con = conectar();

	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y-m-d H:i:s', time());

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header>
		<h1>Senhor das Rifas</h1>
		<nav>
			<ul>
				<li class="borda"><a href="">Home</a></li>
				<li class="borda"><a href="rifas/rifas.php">Rifas</a></li>
				<li class="borda"><a href="rifas/minhasRifas.php">Minhas Rifas</a></li>
				<li class="borda"><a href="cadastro/criaRifa.php">Criar Rifa</a></li>
			</ul>
		</nav>
		<h2>Soluções inteligentes para o gerenciamento de rifas</h2>

		<?php
		if(isset($_SESSION["nome"])){
				?>

		<nav class="navi">
			<ul class="cor">
				<li >Seja bem-vindo, <a href="telaUser.php"><?=$_SESSION["nome"]?>!</a></li>
				<li><a href="login.php">Sair</a></li>
			</ul>
		</nav>

		<?php
			}else{
		?>
		<nav class="navi">
			<ul class="cor">
				<li >Faça agora o seu <a href="login.php">login</a></li>
			</ul>
		</nav>
		<nav class="navig">
			<ul class="cor">
				<li >Ainda não é cadastrado? <a href="cadastro/cadastro.php">Cadastre-se agora!</a></li>
			</ul>
		</nav>
		<?php
			}
		?>
	</header>
	<main>


		<?php
		if(isset($_SESSION["nome"])){;
			echo "<h2>Minhas Rifas</h2>";
			$query = mostraRifas($con, $_SESSION["id"]);
			while ($registro = mysqli_fetch_assoc($query)) {
				$ide = $registro['id'];
				$titulo = $registro['titulo'];
				$dataP = $registro['data_provavel_sorteio'];

				$data1 = strtotime($dataP);
				$data2 = strtotime($data);
				$dataDif = $data1 - $data2;

				$dataFra = $dataDif/ 86400;
				$dataFinal = round($dataFra, 0);
				
				
				?>
				<section class="secao1">
				<p><strong>Titulo: </strong><?=$titulo?></p>
				<p><strong>Dias restantes: </strong>
				<?php
					if($dataFinal>0){
						echo "$dataFinal";
					}else{
						echo "Prazo encerrado!";
					}
				?>
				</p>

				<?php

				$quantidade = qtdeMinhasRifas($con, $ide);
				while ($registro1 = mysqli_fetch_assoc($quantidade)) {
					$qtde = $registro1['qtde'];
					$valor = $registro1['valor'];
					?>
					<p><strong>Quantidade de bilhetes comprados: </strong><?=$qtde?></p>
					<p><strong>Valor arrecadado: </strong>R$ <?=round($valor, 2)?></p>
					
				<?php	
				}
				?>
				</section>
				<?php
			}	

			echo "<br><h2>Rifas Compradas</h2>";
			$query2 = mostraOutrasRifas($con, $_SESSION["id"]);
			while ($registro = mysqli_fetch_assoc($query2)) {
				$ide = $registro['id'];
				$titulo = $registro['titulo'];
				$valor = $registro['valor_bilhete'];
				$dataP = $registro['data_provavel_sorteio'];
				$dataI = $registro['data_inicio_venda'];
				$dataF = $registro['data_fim_venda'];

				$data1 = strtotime($dataP);
				$data2 = strtotime($data);
				$dataDif = $data1 - $data2;

				$dataFra = $dataDif/ 86400;
				$dataFinal = round($dataFra, 0);
	
				?>
				<section class="secao1">
				<p><strong>Titulo: </strong><?=$titulo?></p>
				<p><strong>Dias restantes: </strong>
				<?php
					if($dataFinal>0){
						echo $dataFinal;
					}elseif($dataFinal==0){
						echo "Data final para compra!";
					}
					else{
						echo "Prazo encerrado!";
					}
				?>
				</p>
				<p><strong>Número das rifas: </strong>
				<?php
				$cont = 0;
				$rifas = rifasCompradas($con, $ide, $_SESSION['id']);
				while ($registro1 = mysqli_fetch_assoc($rifas)) {
					$numero = $registro1['numero'];
					?>	
					-> <?=$numero?>


			<?php
					$cont++;
				}
				
				$valorTotal = $valor*$cont;
			?>

				</p>
				<p><strong>Valor unitário: </strong>R$ <?=$valor?></p>
				<p><strong>Valor investido: </strong>R$ <?=$valorTotal?></p>
				<?php
				if($data>=$dataI && $data<=$dataF){
					?>
					<form action="form/compraBilhete.php" onclick="return confirm('Deseja mesmo comprar um bilhete?')" method="POST">
						<input type="hidden" name="id" value="<?=$ide?>">
						<input type="hidden" name="titulo" value="<?=$titulo?>">
						<input type="submit" name="" value="Comprar bilhete">
					</form>
				<?php
				}
				?>
					</section>
					<?php
			}


		}else{ 
			?>
			<h2>Bem-vindo ao melhor site nacional de gerenciamento de rifas! Por favor, faça o login ou cadastre-se para visualizar essa seção!</h2>
		<?php 
		}
		?>
		
	</main>
	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
</body>
</html>