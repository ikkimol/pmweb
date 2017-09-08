<?php
	// inclui a classe responsável pelas consultas
	include("pmwebOrderStats.php");
	
	// verifica se na requisição foi informad as datas de período
	if(isset($_GET["start_date"]) && isset($_GET["end_date"])) {
		// instancia o objeto responsavel pelas consultas
		$orders = new Pmweb_Orders_Stats();
		$orders->setStartDate($_GET["start_date"]);
		$orders->setEndDate($_GET["end_date"]);
		
		// retorna as informações em formato JSON
		echo $orders->getOrdersInformationJSON();
	} else 
		// retorna informando que as datas não foram informadas
		echo json_encode(array("erro" => "Consulta não realizada. O período não foi informado!"));
?>