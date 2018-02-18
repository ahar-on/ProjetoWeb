<?php 
	
	session_start();

	require_once 'funcoes.php'; 
	$con = conectar();

	session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/cadastroLogin.css">
</head>
<body>
	<header>
		<h1>Senhor das Rifas</h1>
		<nav>
			<ul>
				<li class="borda"><a href="index.php">Home</a></li>
				<li class="borda"><a href="rifas/rifas.php">Rifas</a></li>
				<li class="borda"><a href="rifas/minhasRifas.php">Minhas Rifas</a></li>
				<li class="borda"><a href="cadastro/criaRifa.php">Criar Rifa</a></li>
			</ul>
		</nav>
		<h2>Soluções inteligentes para o gerenciamento de rifas</h2>
		<nav class="navi">
			<ul class="cor">
				<li >Faça agora o seu <a href="">login</a></li>
			</ul>
		</nav>
		<nav class="navig">
			<ul class="cor">
				<li >Ainda não é cadastrado? <a href="cadastro/cadastro.php">Cadastre-se agora!</a></li>
			</ul>
		</nav>
	</header>


	<main>

		<h2>Login</h2>
			<form action="telaUser.php" name="login" method="post">
				<input type="text" name="nome" placeholder="Nome">
				<input type="password" name="senha" placeholder="Senha">
				<input type="submit" name="">
			</form>		
	</main>

	<footer id="footer">
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
	<script type="text/javascript" src="js/cadastro.js"></script>
</body>
</html>