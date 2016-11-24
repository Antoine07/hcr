<?php $pdo = get_pdo(); ?>
<?php $id = $_SESSION['user']['team_id']; ?>
<?php $team_manager = new game\Team_manager($pdo); ?>
<?php $team = $team_manager->get_single($id); ?>

<?php ob_start(); ?>
	<div class="content_header_time">
		<div class="row">
			<div class="col s12 qg_top">
				<h4><?php echo $nom_page; ?>	</h4>
				<ul class="qg_list">
					<li class="qg_team">team <?php echo $team->get_name() ?></li>
					<span>|</span>
					<li><?php echo $team->get_credit() ?> c</li>
					<span>|</span>
					<li><?php echo $team->get_score() ?> points</li>
					<span>|</span>
					<li>7ème</li>
				</ul>
			</div>
		</div>
	</div>	
<?php $header_team = ob_get_clean(); ?>