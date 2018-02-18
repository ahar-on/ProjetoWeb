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
	<title>Senhor das Rifas - Sorteio</title>
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
			if(isset($rifa)||$rifa_id!="" && isset($titulo)||$titulo!=""){
				$contador = sorteadorContador($con, $rifa_id);
				if($contador){
					$cont = $contador['contagem'];
				}

				if($cont==0){
					echo "<h3>Nenhum prêmio definido, falha no sorteio!</h3>";
				}else{
					for($i=0;$i<$cont;$i++){
						$sucessoRand = randomico($con, $rifa_id);
						if($sucessoRand){
							$bilheteID = $sucessoRand['id'];
							$numero = $sucessoRand['numero'];
							$sucessoPremiado = premiado($con, $rifa_id, $bilheteID);
							$sucessoDia = sorteioDia($con, $rifa_id);
						}
					}
					if($sucessoRand){
						echo"<h2>Sorteio da rifa $titulo realizado com sucesso!</h2>";
					}else{
						echo "<h3>Falha no sorteio da rifa $titulo, quantidade de bilhetes comprados inferior a quantidade de prêmios!</h3>";
					}
				}
			}else{
					?>
					<h3>Acesso negado!</h3>
					<?php
			}
		}
		else{
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