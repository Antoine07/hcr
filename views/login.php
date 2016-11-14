<?php ob_start() ; ?>
<h1><?php echo $title?? 'no title' ?></h1>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>