<?php 

	session_start();
	require_once '../funcoes.php'; 
	$con = conectar();

	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y-m-d H:i:s', time());

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Rifas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/site.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<body>
	<header>
		<h1>Senhor das Rifas</h1>
		<nav>
			<ul>
				<li class="borda"><a href="../index.php">Home</a></li>
				<li class="borda"><a href="">Rifas</a></li>
				<li class="borda"><a href="minhasRifas.php">Minhas Rifas</a></li>
				<li class="borda"><a href="../cadastro/criaRifa.php">Criar Rifa</a></li>
			</ul>
		</nav>
		<h2>Soluções inteligentes para o gerenciamento de rifas</h2>

		<?php
		if(isset($_SESSION["nome"])){
				?>

		<nav class="navi">
			<ul class="cor">
				<li >Seja bem-vindo, <a href="../telaUser.php"><?=$_SESSION["nome"]?>!</a></li>
				<li><a href="../login.php">Sair</a></li>
			</ul>
		</nav>

		<?php
			}else{
		?>
		<nav class="navi">
			<ul class="cor">
				<li >Faça agora o seu <a href="../login.php">login</a></li>
			</ul>
		</nav>
		<nav class="navig">
			<ul class="cor">
				<li >Ainda não é cadastrado? <a href="../cadastro/cadastro.php">Cadastre-se agora!</a></li>
			</ul>
		</nav>
		<?php
			}
		?>
	</header>
	<main>

		<?php
		if(isset($_SESSION["nome"])){
			$query = mostraOutrasRifas($con, $_SESSION["id"]);
			echo "<h2>Compre suas rifas!</h2>";
		}else{
			$query = mostraTodasRifas($con);
			echo "<h2>Você precisa estar logado ou cadastrado para comprar rifas!</h2>";
		}
			while ($registro = mysqli_fetch_assoc($query)) {
				$id = $registro['id'];
				$titulo = $registro['titulo'];
				$descricao = $registro['descricao'];
				$dataP = $registro['data_provavel_sorteio'];
				$dataI = $registro['data_inicio_venda'];
				$dataF = $registro['data_fim_venda'];
				$dataS = $registro['data_sorteio'];
				$valor = $registro['valor_bilhete'];
		?>
				<section class="secao1">
					<p><strong>Titulo: </strong><?=$titulo?></p>
					<p><strong>Descrição: </strong><?=$descricao?></p>
					<p><strong>Data provável de sorteio: </strong><?=$dataP?></p>
					<p><strong>Data de início de vendas: </strong><?=$dataI?></p>
					<p><strong>Data final de vendas: </strong><?=$dataF?></p>
					<p><strong>Valor unitário do bilhete: </strong>R$ <?=$valor?></p>
					<p><strong>Premiações</strong></p>
					<?php
					$premiacao = premiacoes($con, $id);
					while ($registro2 = mysqli_fetch_assoc($premiacao)) {
						$descricao = $registro2['descricao'];
						$colocacao = $registro2['colocacao'];
						?>
						<p><strong><?=$colocacao?>º lugar: </strong><?=$descricao?></p>
						<?php
					}
					?>
					<p><strong>Data do sorteio: </strong><?=$dataS?></p>
					<p><strong>Bilhetes sorteados</strong></p>
					<?php
					$bilhete = mostraBilhetes($con, $id);
					while ($registro1 = mysqli_fetch_assoc($bilhete)) {
						$num = $registro1['numero'];
						$nome = $registro1['nome'];
						$colocacao = $registro1['colocacao'];
						?>
						<p><strong><?=$colocacao?>º lugar</strong> - <strong>Bilhete Nº</strong><?=$num?> - <strong>Ganhador: </strong><?=$nome?></p>
						<?php
					}
					?>
					<?php
					if(isset($_SESSION["nome"]) && $data>=$dataI && $data<=$dataF){
					?>
						<form action="../form/compraBilhete.php" onclick="return confirm('Deseja mesmo comprar um bilhete?')" method="POST">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="titulo" value="<?=$titulo?>">
							<input type="submit" name="" value="Comprar bilhete">
						</form>
						<?php
					}
					?>
				</section>
			<?php 
			}
			?>
		
	</main>
	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
</body>
</html>