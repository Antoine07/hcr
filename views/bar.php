<?php ob_start() ; ?>
	<div class="content_bar">
		<?php echo $header_team; ?>
		 <div class="row content_bar_item">
			<div class="col s6 bar_left">
				<h5>Pilotes</h5>
				<div class="content_card_bar">
					<?php foreach ($npcs_pilotes as $pilote): ?>
						<div class="bar_card">
							<div class="bar_element">
								<div class="bar_less">
									<img class="bar_portrait" src="../images/<?php echo $pilote->get_id()?>.png" alt="">
									<h6><?php echo h($pilote->get_name()) ?>
										<br><span>
											<?php echo h($pilote->get_race()) ?> - 
											<?php echo h($pilote->get_job()) ?>
										</span>
									</h6>
									<form action="/index.php/buy" method="POST">
										<input name="item_category" type="text" hidden="none" value="NPC">
										<input name="item_id" type="number" hidden="none" value=<?php echo h($pilote->get_id()); ?>>
										<input type="submit" class="btn buy waves-effect waves-light" value=" <?php echo h($pilote->get_price()); ?> c">
									</form>
								</div>
								<div class="more">
									<ul class="bar_stats">
										<li>Intelligence : 
										<span><?php echo h($pilote->get_stats('intelligence'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Dextérité : 
										<span><?php echo h($pilote->get_stats('dexterity'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Endurance : 
										<span><?php echo h($pilote->get_stats('stamina'));?><span>
										</li>
										<span class="grey-span">|</span>
										<li>Rapidité : 
										<span><?php echo h($pilote->get_stats('speed'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Force : 
										<span><?php echo h($pilote->get_stats('strength'));?><span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			 <div class="col s6 bar_right">
				<h5>Mécaniciens</h5>
				<div class="content_card_bar">
					<?php foreach ($npcs_mecaniciens as $mecanicien): ?>
						<div class="bar_card">
							<div class="bar_element">
								<div class="bar_less">
									<img class="bar_portrait" src="../images/<?php echo $mecanicien->get_id()?>.png" alt="">
									<h6><?php echo h($mecanicien->get_name()) ?>
										<br><span>
											<?php echo h($mecanicien->get_race()) ?> - 
											<?php echo h($mecanicien->get_job()) ?>
										</span>
									</h6>
									
									<form action="/index.php/buy" method="POST">
										<input name="item_category" type="text" hidden="none" value="NPC">
										<input name="item_id" type="number" hidden="none" value=<?php echo h($mecanicien->get_id()); ?>>
										<input type="submit" class="btn buy waves-effect waves-light" value=" <?php echo h($mecanicien->get_price()); ?> c">
									</form>
								</div>
								<div class="more">
									<ul class="bar_stats">
										<li>Intelligence : 
										<span><?php echo h($mecanicien->get_stats('intelligence'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Dextérité : 
										<span><?php echo h($mecanicien->get_stats('dexterity'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Endurance : 
										<span><?php echo h($mecanicien->get_stats('stamina'));?><span>
										</li>
										<span class="grey-span">|</span>
										<li>Rapidité : 
										<span><?php echo h($mecanicien->get_stats('speed'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Force : 
										<span><?php echo h($mecanicien->get_stats('strength'));?><span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>  
 		</div>
	</div>
<style>body{background: #F4F4F4;};</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>