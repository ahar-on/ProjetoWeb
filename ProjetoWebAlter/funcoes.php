<?php  

	function conectar(){
		$servidor = "localhost";
		$usuario = "root";
		$senha = "root";
		$con = mysqli_connect($servidor, $usuario, $senha);
		mysqli_select_db($con, "mysql-tads16");
		mysqli_set_charset($con, "utf8");

		return $con;
	}

	function inserirUsuario($con, $nome, $email, $senha, $foto){
		$sql = "INSERT INTO usuarios (nome, email, senha, foto, admin) VALUES ('$nome', '$email', '$senha', '$foto', 0)";
		return mysqli_query($con, $sql);
	}

	function inserirRifa($con, $usuario_id, $tipo_id, $titulo, $descricao, $dataP, $dataI, $dataF, $valor){
		$sql = "INSERT INTO rifas (usuario_id, tipo_id, titulo, descricao, data_provavel_sorteio, data_inicio_venda, data_fim_venda, valor_bilhete) VALUES ($usuario_id, $tipo_id, '$titulo', '$descricao', '$dataP', '$dataI', '$dataF', $valor)";
		return mysqli_query($con, $sql);
	}

	function inserirTipo($con, $descricao, $inicial, $passo, $quantidade){
		$sql = "INSERT INTO tipos (descricao, numero_inicial, passo, quantidade_bilhetes) VALUES ('$descricao', $inicial, $passo, $quantidade)";
		return mysqli_query($con, $sql);
	}

	function inserirPremio($con, $rifa_id, $descricao, $colocacao){
		$sql = "INSERT INTO premios (rifa_id, descricao, colocacao) VALUES ($rifa_id, '$descricao', $colocacao)";
		return mysqli_query($con, $sql);
	}

	function administrador($con){
		$sql = "UPDATE usuarios SET admin = 1 LIMIT 1";
		return mysqli_query($con, $sql);
	}

	function realizarLogin($con, $nome, $senha){
		$sql = "SELECT id, nome, email, foto FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
		$query = mysqli_query($con, $sql);
		
		return mysqli_fetch_assoc($query);
	}

	function pegaTipo($con){
		$sql = "SELECT id, passo, quantidade_bilhetes, numero_inicial FROM tipos";
		return mysqli_query($con, $sql);
	}

	function mostraRifas($con, $id){
		$sql = "SELECT * FROM rifas where usuario_id = $id";
		return mysqli_query($con, $sql);
	}

	function mostraOutrasRifas($con, $id){
		$sql = "SELECT * FROM rifas where usuario_id != $id";
		return mysqli_query($con, $sql);
	}

	function mostraTodasRifas($con){
		$sql = "SELECT * FROM rifas";
		return mysqli_query($con, $sql);
	}

	function compraBilhete($con, $rifa_id, $usuario_id, $numero){
		$sql = "INSERT INTO bilhetes (rifa_id, usuario_id, numero) VALUES ($rifa_id, $usuario_id, $numero)";
		return mysqli_query($con, $sql);
	}

	function defineNumero($con, $rifa_id){
		$sql = "SELECT numero_inicial+(passo*(SELECT COUNT(*) FROM bilhetes where rifa_id = $rifa_id)) AS numero, quantidade_bilhetes FROM tipos, rifas where rifas.id = $rifa_id and tipos.id = tipo_id";
		return mysqli_query($con, $sql);
	}

	function limiteBilhete($con, $rifa_id){
		$sql = "SELECT COUNT(*) + 1 as limite FROM bilhetes WHERE rifa_id = $rifa_id";
		return mysqli_query($con, $sql);
	}

	function randomico($con, $rifa_id){
		$sql = "SELECT id, numero FROM bilhetes WHERE rifa_id = $rifa_id AND id NOT IN (SELECT bilhete_sorteado_id FROM premios WHERE rifa_id = $rifa_id and bilhete_sorteado_id IS NOT NULL) ORDER BY RAND() LIMIT 1";
		$query = mysqli_query($con, $sql);
		
		return mysqli_fetch_assoc($query);
	}

	function premiado($con, $rifa_id, $bilheteID){
		$sql = "UPDATE premios set bilhete_sorteado_id = $bilheteID WHERE rifa_id = $rifa_id and bilhete_sorteado_id IS NULL LIMIT 1";
		return mysqli_query($con, $sql);
	}

	function sorteioDia($con, $rifa_id){
		$sql = "UPDATE rifas set data_sorteio = NOW() WHERE id = $rifa_id";
		return mysqli_query($con, $sql);
	}

	function sorteadorContador($con, $rifa_id){
		$sql = "SELECT COUNT(*) as contagem FROM premios WHERE rifa_id = $rifa_id AND bilhete_sorteado_id IS NULL";
		$query = mysqli_query($con, $sql);
		
		return mysqli_fetch_assoc($query);
	}

	function mostraBilhetes($con, $rifa_id){
		$sql = "SELECT numero, usuarios.nome, colocacao FROM bilhetes, premios, usuarios WHERE premios.rifa_id = $rifa_id and bilhete_sorteado_id = bilhetes.id and bilhetes.usuario_id = usuarios.id";
		return mysqli_query($con, $sql);
	}

	function premiacoes($con, $rifa_id){
		$sql = "SELECT descricao, colocacao FROM premios WHERE rifa_id = $rifa_id";
		return mysqli_query($con, $sql);
	}

	function defineNumPremio($con, $rifa_id){
		$sql = "SELECT COUNT(*)+1 as num FROM premios where rifa_id = $rifa_id";
		$query = mysqli_query($con, $sql);
		
		return mysqli_fetch_assoc($query);
	}

	function qtdeMinhasRifas($con, $rifa_id){
		$sql = "SELECT COUNT(*) as qtde, COUNT(*)*(SELECT valor_bilhete FROM rifas WHERE id = $rifa_id) as valor FROM bilhetes WHERE rifa_id = $rifa_id";
		return mysqli_query($con, $sql);
	}

	function rifasCompradas($con, $rifa_id, $usuario_id){
		$sql = "SELECT numero FROM bilhetes WHERE rifa_id=$rifa_id and usuario_id=$usuario_id";
		return mysqli_query($con, $sql);
	}
	
?>