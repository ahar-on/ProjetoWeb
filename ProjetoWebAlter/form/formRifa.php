<?php 

	session_start();
	require_once '../funcoes.php'; 
	$con = conectar();

	$usuario_id = $_SESSION["id"];
	$tipo_id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$dataP = $_POST['dataP'];
	$dataI = $_POST['dataI'];
	$dataF = $_POST['dataF'];
	$valor = $_POST['valor'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Cadastro de Rifa</title>
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
			if(isset($usuario_id)||$usuario_id!="" && isset($tipo_id)||$tipo_id!="" && isset($titulo)||$titulo!="" && isset($descricao)||$descricao!="" && isset($dataP)||$dataP!="" && isset($dataI)||$dataI!="" && isset($dataF)||$dataF!="" && isset($valor)||$valor!=""){
			if($dataP>$dataI && $dataP>=$dataF && $dataF>$dataI){
				$sucesso = inserirRifa($con, $usuario_id, $tipo_id, $titulo, $descricao, $dataP, $dataI, $dataF, $valor);
			}else{
				?>
				<h3>Datas inseridas incorretamente!</h3>
				<?php
			}
		}
			if($sucesso){
	?>
				<h2>Rifa cadastrada com sucesso!</h2>
		

	<?php 
			}else{
				echo "<h3>Houve algum erro, tente novamente mais tarde!</h3>";
			}
		}else{
			?>
			<h3>Acesso negado!</h3>
			<?php
		}
	?>
	</main>
	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
</body>
</html>