<?php 

	session_start();
	require_once '../funcoes.php'; 
	$con = conectar();

	$rifa_id = $_POST['id'];
	$titulo = $_POST['titulo'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Premiação</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/site.css">
	<link rel="stylesheet" type="text/css" href="../css/cadastroLogin.css">
</head>
<body>
	<header>
		<h1>Senhor das Rifas</h1>
		<nav>
			<ul>
				<li class="borda"><a href="../index.php">Home</a></li>
				<li class="borda"><a href="../rifas/rifas.php">Rifas</a></li>
				<li class="borda"><a href="../rifas/minhasRifas.php">Minhas Rifas</a></li>
				<li class="borda"><a href="criaRifa.php">Criar Rifa</a></li>
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
				<li >Ainda não é cadastrado? <a href="cadastro.php">Cadastre-se agora!</a></li>
			</ul>
		</nav>
		<?php
			}
		?>
	</header>
	<main>

		<?php

		if(isset($_POST['descricao'])&&isset($_POST['rifa_id'])&&isset($_POST['colocacao'])){
			$rifa_id = $_POST['rifa_id'];
			$descricao = $_POST['descricao'];
			$colocacao = $_POST['colocacao'];

			$sucesso = inserirPremio($con, $rifa_id, $descricao, $colocacao);
			if($sucesso){
				echo "<h2>Premiação inserida com sucesso!</h2>";
			}else{
				echo "<h3>Falha na inserção, tente novamente!</h3>";
			}

		}else{
			$numPremio = defineNumPremio($con, $rifa_id);
			if($numPremio){
				$num = $numPremio['num'];
			}
			if(isset($_SESSION["nome"])){
		?>
				<h2>Defina a premiação do <?=$num?>º lugar da rifa: <?=$titulo?></h2>
				<form action="" name="premio" onsubmit= "return validacaoPremio()" method="post">
					<fieldset>
						<input type="hidden" name="colocacao" value="<?=$num?>"">
						<input type="text" name="descricao" placeholder="Descrição">
						<input type="hidden" name="rifa_id" value="<?=$rifa_id?>">
						<input type="submit" name="">
					</fieldset>
				</form>	
		<?php
			}else{
				?>
				<h3>Acesso negado!</h3>
				<?php
			}
		}
		?>
		
	</main>
	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
	<script type="text/javascript" src="../js/cadastro.js"></script>
</body>
</html>