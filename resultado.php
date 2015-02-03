<?php $a = $_POST["nomb"]; ?>
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
				<h1 style="background:#999;color:#fff;display:inline-block;">Buscador de Patentes</h1>
		        <br>
		        <br>
		        <form action="resultado.php" method="post">
		          <tr></tr>
		          <tr>
		          <div>
		            <div>
		              <div>
		                <input name="nomb" type="text" value="<?php echo $a; ?>" />
		                <input name="Buscar" type="submit" id="Buscar" value="Buscar" />
		                <div id="searchForm" style="display:none;"></div>
		                  <select id="restrict" onchange="formSubmit(searchform);return false;"></select>
		                  <select id="sort" onchange="formSubmit(searchform);return false;"></select>
		                  </td>
		              </div>
		              <div class="panel-body">

			    <?php include('google.php'); ?>

				<div class="acerca-de2">
					<p>Esta web tiene el propósito de ayudarte a encontrar una patente registrada, tanto a nivel español como a nivel europeo.</p>
				</div>

				<div class="quienes-somos2">
					<ul>
						<li>Abraham Barreto Luis de la Guardia</li>
						<li>Bryan García Navarro</li>
						<li>Laura Padrón Jorge</li>
						<li>Natalia Gutiérrez Rodriguez</li>
					</ul>
				</div>
			</section>
			<footer id="pie2">
				<a href="http://www.oepm.es" target="_blank"><img src="img/oepm.jpg" height="70"></a>
				<a href="http://www.epo.org" target="_blank"><img src="img/epo.jpg" height="70"></a>
			</footer>
		</div>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
			$().ready(function(){
				$("#menu a[id=acerca-de]").on("click", function(e){
					e.preventDefault();
					$(".acerca-de2").slideToggle("slow");
				});

				$("#menu a[id=quienes-somos]").on("click", function(e){
					e.preventDefault();
					$(".quienes-somos2").slideToggle("slow");
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