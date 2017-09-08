Teste aplicação PMWEB - Encomendas
Arquivos e suas funções:
config.php
	Arquivo responsável pela conexão e execução de consultas no banco de dados
encomendas.sql
	Arquivo para carregar a base de dados 
index.php
	Arquivo de exemplo da utilização da requisição em formato JSON e seu retorno 
json_orders_pmweb.php
	Arquivo responsável pela execução da requisição enviada
pmwebOrderStats.php
	Classe responsável pelas ações de encomendas

** COMO UTILIZAR A REQUISIÇÃO JSON DE ENCOMENDAS **
Para utilizar a requição é preciso informar, em método GET, a data de início(start_date) e fim(end_date) para o arquivo json_orders_pmweb.php

Por exemplo: 
	json_orders_pmweb.php?start_date=2015-05-01&end_date=2017-08-02

No exemplo acima, o período solicitado foi 01/05/2015 a 02/08/2017 retornando um object da seguinte maneira:
{
	orders: {
		"AverageOrderValue": "95,00",
		"averageRetailPrice": "30,65",
		"count": 15610,
		"quantity": 48386,
		"revenue": "1.482.964,1068"
	}
	
}