<?php 

	session_start();
	require_once '../funcoes.php'; 
	$con = conectar();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas - Cadastro de Rifas</title>
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
				<li class="borda"><a href="">Criar Rifa</a></li>
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
		if(isset($_SESSION["nome"])){
			$varia = "";
			echo "<h2>Cadastre uma rifa</h2>";
		}else{
			echo "<h2>Faça login ou cadastre-se para criar uma rifa!</h2>";
			$varia = "disabled='disabled'";
		}
		?>
			<form action="../form/formRifa.php" name="rifa" onsubmit= "return validacaoRifa()" method="post">
				<fieldset <?=$varia?>>
					<input type="text" name="titulo" placeholder="Titulo">
					<textarea  name="descricao" maxlength="250" placeholder="Descrição"></textarea>
					<p>Data provável do sorteio</p>
					<input type="datetime-local" name="dataP">
					<p>Data do início das vendas</p>
					<input type="datetime-local" name="dataI">
					<p>Data final das vendas</p>
					<input type="datetime-local" name="dataF">
					<select name="id">
						<?php
						$query = pegaTipo($con);
						while ($registro = mysqli_fetch_assoc($query)) {
							$id = $registro['id'];
							$passo = $registro['passo'];
							$numI = $registro['numero_inicial'];
							$qtd = $registro['quantidade_bilhetes'];
						?>
							<option value="<?=$id?>">Intervalo: <?=$passo?> N.Inicial: <?=$numI?> Quantidade: <?=$qtd?></option>
						<?php
						}
						?>
					</select>
					<input type="number" step="0.01" name="valor" placeholder="Valor">
					<input type="submit" name="">
				</fieldset>
			</form>		
			<?php
			if($_SESSION["id"]==1){
			?>
			<br>
			<form action="criaTipo.php" method="POST">
				<p>Você é também um administrador, crie um tipo de bilhete!</p>
				<input type="submit" value="Criar">
			</form>
			<?php
			}
			?>
	</main>

	<footer>
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!</div>
	</footer>
	<script type="text/javascript" src="../js/cadastro.js"></script>
</body>
</html>