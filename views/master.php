<!DOCTYPE html>
<!-- Début du HTML -->
<html lang="en">
<!-- Début du HEAD -->
<head>
	<meta charset="UTF-8">
	<title>Hyper Cosmic Racer</title>
	<link rel="stylesheet" href="/assets/css/materialize.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/styles.css">

</head>
<!-- Fin du HEAD -->
<!-- Début du BODY -->
<body>
      <!-- Dropdown deconnexion -->
      <ul id="dropdown1" class="dropdown-content nav_deco">
            <li><a href="<?php echo url('deconnexion'); ?>">Déconnexion</a></li>
      </ul>
	<!-- Début de la NAV -->
	<nav>
	         <div class="nav-wrapper navbar">
               	<a href="#"><img class="imgnav" src="/images/rocket.png"></a>
               	<ul id="nav-mobile" class="right hide-on-med-and-down">
          		<li>
                                   <a href="<?php echo url('qg'); ?>" class="element underline-opening" id="qg">QG</a>
                            </li>
          		<li>
                                   <a href="<?php echo url('bar'); ?>" class="element underline-opening" id="bar">Bar</a>
                            </li>
          		<li>
                                   <a href="<?php echo url('shop'); ?>" class="element underline-opening" id="shop">Magasin</a>
                            </li>
          		<li>
                                   <a href="<?php echo url('race'); ?>" class="element underline-opening" id="race">Courses</a>
                            </li>
                            <li>
                                   <a class="dropdown-button" href="#" data-activates="dropdown1">
                                        <?php echo $_SESSION['user']['username'] ; ?>
                                        <i class="material-icons right">arrow_drop_down</i>
                                   </a>
                            </li>
                            </ul>
    	     </div>
  	</nav>

    <?php echo $header?? '' ;  ?>
	<!-- Fin de la NAV -->
	  	<?php echo $content?? '' ; ?>
</body>
<!-- Fin du BODY -->

<!-- Liens vers les fichiers JavaScript -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/445f146961.js"></script>
<script src="/assets/js/materialize.min.js"></script>
<script src="/assets/js/main.js"></script>

<?php if (isset($_SESSION['message'])): ?>
  <script>
    Materialize.toast("<?php echo $_SESSION['message']; ?>",8000);
  </script>
<?php endif ?>

</html>
<!-- Fin du HTML -->