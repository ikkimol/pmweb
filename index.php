<html>
	<title></title>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			$(document).ready(
				$.getJSON("http://localhost/pmweb/json_orders_pmweb.php?start_date=2015-05-01&end_date=2017-08-02", function(data){
				// verifica se a requisição retornou erro
				if(!data.erro) {
					// mostra na tela os nomes e valores dos dados retornados
					Object.keys( data.orders ).forEach(function(key) {
						document.write(key +": " + data.orders[key]+" <br />");
					});
				} else {
					// mostra na tela o erro retornado
					document.write("<h3>" + data.erro +"</h3>");
				}
			}));
		</script>
	</head>
	
	<body>		
	</body>	
</html>