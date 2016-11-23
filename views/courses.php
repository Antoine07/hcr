<?php ob_start() ; ?>
	<div class="content_race">
		<div class="row">
			<div class="col s12 race_top">
				<h4>Bar</h4>
				<ul class="race_list">
					<li class="race_team">team JOJO</li>
					<span>|</span>
					<li>50.000 c</li>
					<span>|</span>
					<li>203 points</li>
					<span>|</span>
					<li>7ème</li>
				</ul>
			</div>
		</div>
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
								<button class="btn buy waves-effect waves-light">Inscription
									<span><?php echo $race->get_cost(); ?></span>
								</button>
							</div>
						</div>
					<?php endforeach ?>
<!-- 					<div class="race_card">
						<div class="race_element">
							<h6>Grande course de la grande ours
								<span class="race_date">le 27-10-2016</span>
							</h6>
							<br>
							<button class="btn buy waves-effect waves-light">Inscription
								<span>100</span>
							</button>
						</div>
					</div> -->
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
								<button class="btn buy">3ème Place
								</button>
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