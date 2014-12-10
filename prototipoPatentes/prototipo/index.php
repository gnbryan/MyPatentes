<!DOCTYPE html>
<html lang="es_ES">
	<head>
		<title>Patentazo - Buscador de patentes</title>
		<meta charset="utf-8">
	    <meta name="description" content="Patentazo, el buscador de Patentes">
	    <meta name="author" content="Bryan García Navarro">
	    <link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/normalize.min.css">
	</head>
	<body>
		<div class="wrapper">
			<header id="cabecera">
				<div class="logo">
					<a href="index.php"><img src="img/patente-logo.jpg" alt=""></a>
				</div>
				<nav id="menu">
					<ul>
						<li><a id="inicio" class="button" href="index.php">Inicio</a></li>
						<li><a id="acerca-de" class="button" href="#">Acerca de</a></li>
						<li><a id="quienes-somos" class="button" href="#">Quienes somos</a></li>
					</ul>
				</nav>
			</header>
			<section id="contenido">
				<div id="centrar-caja-busqueda">
					<form method="post" action="resultado.php" class="container-2" >
						<input type="search" id="buscar" name="nomb" placeholder="Busca una patente..." />
						<input type="submit" class="icon" value="">
					</form>
					<div id="loading"></div>
					<div id="resultado"></div>
				</div>

				<div class="acerca-de">
					<p>Esta web tiene el propósito de ayudarte a encontrar una patente registrada, tanto a nivel español como a nivel europeo.</p>
				</div>

				<div class="quienes-somos">
					<ul>
						<li>Abraham Barreto Luis de la Guardia</li>
						<li>Bryan García Navarro</li>
						<li>Laura Padrón Jorge</li>
						<li>Natalia Gutiérrez Rodriguez</li>
					</ul>
				</div>
			</section>
			<footer id="pie">
				<a href="http://www.oepm.es" target="_blank"><img src="img/oepm.jpg" height="70"></a>
				<a href="http://www.epo.org" target="_blank"><img src="img/epo.jpg" height="70"></a>
			</footer>
		</div>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
			$().ready(function(){
				$("#menu a[id=acerca-de]").on("click", function(e){
					e.preventDefault();
					$(".acerca-de").slideToggle("slow");
				});

				$("#menu a[id=quienes-somos]").on("click", function(e){
					e.preventDefault();
					$(".quienes-somos").slideToggle("slow");
				});

				/*$("form").on("submit", function(e){
					e.preventDefault();
					$("#loading").css("display", "block");
					$.ajax({
						type:"POST",
						url:"resultado.php",
						data:$(this).serialize(),
						success: function(data){
							setTimeout(function(){
								$("#loading").css("display", "none");
								$("#resultado").html(data);
							}, 2500);
						}
					});
				});*/
			});
		</script>
	</body>
</html>