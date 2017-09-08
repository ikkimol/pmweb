<?php
/*
	Classe responsável pela conexão ao banco de dados	
*/
class Db_pmweb {
	// Define as variaveis responsáveis pela conexão ao banco
	var $MYSQL_HOSTNAME = "localhost";
	var $MYSQL_USERNAME = "root";
	var $MYSQL_PASSWORD = "";
	var $MYSQL_DATABASE = "pmweb";
	
	var $conexao;
	
	/**
	 * Realiza a conexão ao banco de dados.
	**/
	function conecta() {
		$this->conexao = new mysqli($this->MYSQL_HOSTNAME, $this->MYSQL_USERNAME, $this->MYSQL_PASSWORD, $this->MYSQL_DATABASE);
		
		if (!$this->conexao){
			echo "Ocorreu um conectar ao banco de dados";
			echo "<br /> Erro :" . mysqli_connect_errno();
			die();
		}
	}
	
	/**
	 * Realiza a execução de uma query.
	 * 
	 * @param String $query 
	 */	
	function executaQuery($query) {
		$resultado = "";
		
		$this->conecta();
		
		if($resultado = mysqli_query($this->conexao, $query)) {
			return mysqli_fetch_assoc($resultado);
		} else {
			echo "Ocorreu um erro na execução da SQL";
			echo "Erro :" . mysqli_connect_errno();
			echo "SQL: " . $query;
			die();
		}
	}
}
?>