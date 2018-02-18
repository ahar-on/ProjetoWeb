<?php 

	session_start();
	require_once 'funcoes.php'; 
	$con = conectar();

	$nome = $_POST['nome'];
	$senha = $_POST['senha'];
	$sucesso = realizarLogin($con, $nome, $senha);

	if($sucesso){
		$id = $sucesso['id'];
		$nomeReal = $sucesso['nome'];
		$email = $sucesso['email'];
		$foto = $sucesso['foto'];
	}

	if(isset($nomeReal)){
		$_SESSION["id"] = "$id";
		$_SESSION["nome"] = "$nomeReal";
		$_SESSION["email"] = "$email";
		$_SESSION["foto"] = "$foto";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Sua Conta</title>
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

		<?php
		if(isset($_SESSION["nome"])){
				?>

		<nav class="navi">
			<ul class="cor">
				<li >Seja bem-vindo, <a href=""><?=$_SESSION["nome"]?>!</a></li>
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
		if(isset($_SESSION["nome"])){
	?>
			<h2>Seja bem-vindo, <?=$_SESSION["nome"]?>!</h2>
			<figure>
				<img src="<?=$_SESSION["foto"]?>">
			</figure>
			<form>
				<input type="text" value="<?=$_SESSION["nome"]?>" readonly="readonly">
				<input type="text" value="<?=$_SESSION["email"]?>" readonly="readonly">
			</form>	

	<?php 
		}else{
			echo "<h3>Houve algum erro ou seus dados estão incorretos!</h3>";
		}
	?>
	</main>
	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
</body>
</html>