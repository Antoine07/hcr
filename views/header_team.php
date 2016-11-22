<?php $pdo = get_pdo(); ?>
<?php $id = $_SESSION["user"]["team_id"]; ?>
<?php $team_manager = new game\Team_manager($pdo); ?>
<?php $team = $team_manager->get_single($id); ?>


<ul class="race_list">
	<li class="race_team">TEAM <?php echo $team['name']; ?></li>
	<span>|</span>
	<li><?php echo $team['credit']; ?> c</li>
	<span>|</span>
	<li><?php echo $team['score']; ?> points</li>
	<span>|</span>
	<li>7ème</li>
</ul>