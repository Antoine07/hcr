<!DOCTYPE html>
<!-- Début du HTML -->
<html lang="en">
<!-- Début du HEAD -->
<head>
	<meta charset="UTF-8">
	<title>Hyper Cosmic Racer</title>
	<!-- Liens vers Materialize et Styles.css -->
	<link rel="stylesheet" href="/assets/css/materialize.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/styles.css">

</head>
<!-- Fin du HEAD -->
<!-- Début du BODY -->
<body>
	  	<?php echo $content?? '' ; ?>
</body>
<!-- Fin du BODY -->

<!-- Liens vers les fichiers JavaScript -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/445f146961.js"></script>
<script src="/assets/js/materialize.min.js"></script>
<script src="/assets/js/main.js"></script>
<?php if(isset($_SESSION['errors'])){
	echo "<script>Materialize.toast('".$_SESSION['errors']['pseudo']."', 4000);</script>";
}
?>
</html>
<!-- Fin du HTML -->