<!DOCTYPE html>
<!-- Début du HTML -->
<html lang="en">
<!-- Début du HEAD -->
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/assets/css/materialize.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/styles.css">

</head>
<!-- Fin du HEAD -->
<!-- Début du BODY -->
<body>
	<!-- Début de la NAV -->
	<nav>
    		<div class="nav-wrapper navbar">
      			<a href="#"><img class="imgnav" src="/images/rocket.png"></a>
      			<ul id="nav-mobile" class="right hide-on-med-and-down">
        				<li><a href="<?php echo url('qg') ?>" class="element underline-opening" id="qg">QG</a></li>
        				<li><a href="<?php echo url('bar') ?>" class="element underline-opening" id="bar">Bar</a></li>
        				<li><a href="<?php echo url('shop') ?>" class="element underline-opening" id="shop">Magasin</a></li>
        				<li><a href="<?php echo url('race') ?>" class="element underline-opening" id="race">Courses</a></li>
      			</ul>
    		</div>
  	</nav>
	<!-- Fin de la NAV -->
	  	<?php echo $content?? '' ; ?>
</body>
<!-- Fin du BODY -->

<!-- Liens vers les fichiers JavaScript -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/445f146961.js"></script>
<script src="/assets/js/materialize.min.js"></script>
<script src="/assets/js/main.js"></script>
</html>
<!-- Fin du HTML -->