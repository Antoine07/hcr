<?php $pdo = get_pdo(); ?>
<?php $id = 1; ?>
<?php $team_manager = new game\Team_manager($pdo); ?>
<?php $team = $team_manager->get_single($id); ?>


<ul class="race_list">
	<li class="race_team">TEAM <?php echo $team->get_name(); ?></li>
	<span>|</span>
	<li><?php echo $team->get_credit(); ?> c</li>
	<span>|</span>
	<li><?php echo $team->get_score(); ?> points</li>
	<span>|</span>
	<li>7ème</li>
</ul>