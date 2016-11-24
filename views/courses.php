<?php ob_start() ; ?>
	<div class="content_race">
		<?php echo $header_team; ?>
		<div class="row content_race_item">
			<div class="col s6 race_left">
				<h5>Courses</h5>
				<div class="content_card_race">
					<?php foreach ($future_races as $race): ?>
						<div class="race_card">
							<div class="race_element">
								<h6>
									<?php
										echo ($race->get_ladder())? '<i class="fa fa-trophy"></i> ' : '';
										echo $race->get_name();
									?>
									<span class="race_date">le <?php echo $race->get_date(); ?></span>
								</h6>
								<br>
								<p>durée : <?php echo $race->get_duration(); ?> milliparsec</p>
								<?php if (!$team_manager->is_participating($_SESSION['user']['team_id'], $race->get_id())): ?>
									<form action="/index.php/participate" method="POST">
											<input name="race_id" type="number" hidden="none" value=<?php echo $race->get_id(); ?>>
											<input type="submit" class="btn buy waves-effect waves-light" value="inscription <?php echo $race->get_cost(); ?> c">
									</form>
								<?php else: ?>
									<button class="btn buy waves-effect waves-light"> Déjà inscrit </button>
								<?php endif ?>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col s6 race_right">
			 	<h5>Courses Précédentes</h5>
				<div class="content_card_race">
					<?php foreach ($past_races as $race): ?>
						<div class="race_card">
							<div class="race_element">
								<h6><?php echo $race->get_name(); ?>
									<span class="race_date"><?php echo $race->get_date(); ?></span>
								</h6>
								<br>
								<?php if ($team_manager->has_participated($_SESSION['user']['team_id'], $race->get_id())): ?>
									<?php $log = $manager->get_log_entry($_SESSION['user']['team_id'], $race->get_id()); ?>
									<p>position : <?php echo $log['position'] ?></p>
									<p>journal de bord : <?php echo $log['content'] ?></p>
								<?php else: ?>
									<p>vous n'avez pas participé à cette course</p>
								<?php endif ?>
							</div>
						</div>						
					<?php endforeach ?>			
				</div>
			</div>  
 		</div>
	</div>
<style>body{background:#F4F4F4;}</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>