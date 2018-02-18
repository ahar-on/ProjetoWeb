<?php 

	require_once '../funcoes.php'; 
	$con = conectar();

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$foto = $_POST['foto'];
	if(isset($nome)||$nome!="" && isset($email)||$email!="" && isset($senha)||$senha!=""){
		$sucessoUsuario = inserirUsuario($con, $nome, $email, $senha, $foto);
		administrador($con);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Cadastro</title>
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
				<li class="borda"><a href="../cadastro/criarRifa.php">Criar Rifa</a></li>
			</ul>
		</nav>
		<h2>Soluções inteligentes para o gerenciamento de rifas</h2>
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
	</header>


	<main>
	<?php
		if($sucessoUsuario){
	?>
			<h2>Você foi cadastrado com sucesso!</h2>
			<figure>
				<img src="<?=$foto?>">
			</figure>
			<form>
				<input type="text" value="<?=$nome?>" readonly="readonly">
				<input type="text" value="<?=$email?>" readonly="readonly">
			</form>	

	<?php 
		}else{
			echo "<h3>Houve algum erro, tente novamente mais tarde!</h3>";
		}
	?>
	</main>
	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
</body>
</html>