<?php
	
	include_once('config.php');
	
	/**
		* Sumarizações de dados transacionais de pedidos.
	*/
	class Pmweb_Orders_Stats {
		
		// atributos para selecionar o período
		private $dt_ini;
		private $dt_fim;
		
		// atributo para funções no banco
		private $db;
		
		// metódo contrutor 
		function __construct() {
			// instância objeto do banco de dados
			$this->db = new Db_pmweb;
		}
		
		/**
			* Define o período inicial da consulta.
			* @param String $date Data de início, formato `Y-m-d` (ex, 2017-08-24).
			*
			* @return void
		*/
		public function setStartDate($date) {
			$this->dt_ini = $date;
		}
		
		/**
			* Define o período final da consulta.
			* 
			* @param String $date Data final da consulta, formato `Y-m-d` (ex, 2017-08-24).
			* 
			* @return void
		*/
		public function setEndDate($date) {
			$this->dt_fim = $date;
		}
		
		/**
			* Retorna o total de pedidos efetuados no período.
			* 
			* @return integer Total de pedidos.
		*/
		public function getOrdersCount() {
			// varíavel que ira servir para retorno
			$retorno = '';
			// verifica se as datas foram preenchidas
			if($this->dt_fim == '' || $this->dt_ini == ''){
				$retorno = 'Informe o período para realizar a consulta';
				} else {
				// busca a quantidade de pedidos (count) que foram feitos no período
				$query = "SELECT COUNT(*) as total_pedidos FROM encomendas where order_date BETWEEN '{$this->dt_ini}' AND '{$this->dt_fim}'";
				// executa a consulta
				$resultado = $this->db->executaQuery($query);
				// pega o retorno
				$retorno = $resultado["total_pedidos"];
			}
			
			return $retorno;
		}
		
		/**
			* Retorna a receita total de pedidos efetuados no período.
			* 
			* @return float Receita total no período.
		*/
		public function getOrdersRevenue() {
			// varíavel que ira servir para retorno
			$retorno = '';
			// verifica se as datas foram preenchidas
			if($this->dt_fim == '' || $this->dt_ini == ''){
				$retorno = 'Informe o período para realizar a consulta';
				} else {
				// busca o valor (price) de todos os pedidos no período
				$query = "SELECT SUM(price) as total_receita FROM encomendas where order_date BETWEEN '{$this->dt_ini}' AND '{$this->dt_fim}'";
				// executa a consulta
				$resultado = $this->db->executaQuery($query);
				// pega o retorno
				$retorno = $resultado["total_receita"];
			}
			
			return $retorno;
		}
		
		/**
			* Retorna o total de produtos vendidos no período (soma de quantidades).
			* 
			* @return integer Total de produtos vendidos.
		*/
		public function getOrdersQuantity() {
			// varíavel que ira servir para retorno
			$retorno = '';
			// verifica se as datas foram preenchidas
			if($this->dt_fim == '' || $this->dt_ini == ''){
				$retorno = 'Informe o período para realizar a consulta';
			} else {
				// busca a quantidade de produtos (quantity) que foram feitos no período
				$query = "SELECT SUM(quantity) as total_produtos FROM encomendas where order_date BETWEEN '{$this->dt_ini}' AND '{$this->dt_fim}'";
				// executa a consulta
				$resultado = $this->db->executaQuery($query);
				// pega o retorno
				$retorno = $resultado["total_produtos"];
			}
			
			return $retorno;
		}
		
		/**
			* Retorna o preço médio de vendas (receita / quantidade de produtos).
			* 
			* @return float Preço médio de venda.
		*/
		public function getOrdersRetailPrice() {
			// busca a receita para o período
			$receita = $this->getOrdersRevenue();
			// busca a quantidade de produtos para o período
			$quantidade = $this->getOrdersQuantity();
			
			// retorna o preço médio de vendas
			if($quantidade && $receita)
				return $receita / $quantidade;
			else 
				return null;
		}
		
		/**
			* Retorna o ticket médio de venda (receita / total de pedidos).
			* 
			* @return float Ticket médio.
		*/
		public function getOrdersAverageOrderValue() {
			// busca a receita para o período
			$receita = $this->getOrdersRevenue();
			// busca a quantidade de pedidos para o período
			$pedidos = $this->getOrdersCount();
			
			// retorna o preço médio de vendas
			if($receita && $pedidos)			
				return $receita / $pedidos;
			else
				return null;
		}
		
		/**
			*	Retorna as informações encapsuladas em JSON 
			*
			*	@return json dados
		*/
		public function getOrdersInformationJSON() {
			// atribui a variaveis as informações que serão passadas
			$count = $this->getOrdersCount();
			$receita = $this->getOrdersRevenue();
			$quantidade = $this->getOrdersQuantity();
			$preco_medio_vendas = $this->getOrdersRetailPrice();
			$ticket_medio_venda = $this->getOrdersAverageOrderValue();
			// varíavel responsável pelo retorno
			$array_retorno = array();
			
			if($count > 0) {
				// atribui a varíavel de retorno uma array com os dados 
				$array_retorno = 
					array( 
						"orders" =>
							array(
								"count"   				=> $count,
								"revenue" 				=> number_format($receita, 4, ',', '.'),
								"quantity"				=> $quantidade,
								"averageRetailPrice" 	=> number_format($preco_medio_vendas, 2, ',', ' '),
								"AverageOrderValue" 	=> number_format($ticket_medio_venda, 2, ',', ' ')
							)
					);
				
			} else {
				// atribui a variavel de retorno uma array com o erro
				$array_retorno = array("erro" => "Não há pedidos no período informado");
			}
			// retorna em formato JSON
			return json_encode($array_retorno, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT);
		}
	}
	
?>