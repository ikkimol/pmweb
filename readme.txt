Teste aplica��o PMWEB - Encomendas
Arquivos e suas fun��es:
config.php
	Arquivo respons�vel pela conex�o e execu��o de consultas no banco de dados
encomendas.sql
	Arquivo para carregar a base de dados 
index.php
	Arquivo de exemplo da utiliza��o da requisi��o em formato JSON e seu retorno 
json_orders_pmweb.php
	Arquivo respons�vel pela execu��o da requisi��o enviada
pmwebOrderStats.php
	Classe respons�vel pelas a��es de encomendas

** COMO UTILIZAR A REQUISI��O JSON DE ENCOMENDAS **
Para utilizar a requi��o � preciso informar, em m�todo GET, a data de in�cio(start_date) e fim(end_date) para o arquivo json_orders_pmweb.php

Por exemplo: 
	json_orders_pmweb.php?start_date=2015-05-01&end_date=2017-08-02

No exemplo acima, o per�odo solicitado foi 01/05/2015 a 02/08/2017 retornando um object da seguinte maneira:
{
	orders: {
		"AverageOrderValue": "95,00",
		"averageRetailPrice": "30,65",
		"count": 15610,
		"quantity": 48386,
		"revenue": "1.482.964,1068"
	}
	
}