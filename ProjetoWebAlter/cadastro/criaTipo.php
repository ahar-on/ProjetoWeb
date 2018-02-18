<?php 

	session_start();

	require_once '../funcoes.php'; 
	$con = conectar();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Cadastro de Tipo</title>
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
		if(isset($_POST['descricao'])&&isset($_POST['numI'])&&isset($_POST['passo'])&&isset($_POST['quantidade'])){
			$descricao = $_POST["descricao"];
			$numI = $_POST["numI"];
			$passo = $_POST["passo"];
			$quantidade = $_POST["quantidade"];

			$sucesso = inserirTipo($con, $descricao, $numI, $passo, $quantidade);

			if($sucesso){
				echo "<h2>Tipo cadastrado com sucesso!</h2>";

			}else{
				
				echo "<h3>Falha ao cadastrar tipo!</h3>";
			}

		}else{
		?>
		<?php
			if($_SESSION["id"]==1){
					?>
				<h2>Crie um tipo de bilhete</h2>
					<form action="" name="tipo" onsubmit= "return validacaoTipo()" method="post">
						<input type="textarea" name="descricao" placeholder="Descrição do tipo">
						<input type="number" name="numI" placeholder="Número inicial">
						<input type="number" name="passo" placeholder="Intervalo de números">
						<input type="number" name="quantidade" placeholder="Quantidade">
						<input type="submit" name="">
					</form>		
		<?php
			}else{
				?>
				<h3>Acesso negado! Você não tem permissão de visualizar essa página!</h3>
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