<?php ob_start() ; ?>
	<div class="content_bar">
		<?php echo $header_team; ?>
		 <div class="row content_bar_item">
			<div class="col s6 bar_left">
				<h5>Pilotes</h5>
				<div class="content_card_bar">
					<?php foreach ($npcs_pilotes as $pilote): ?>
						<?php $hide_stat=npc_stats_hide($pilote); ?>
						<?php $color_stat=npc_stats_color($pilote); ?>
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
										<li <?php echo 'class="'.$color_stat['intelligence'].'-text"' ?> >Intelligence : 
										<span <?php echo 'class="'.$color_stat['intelligence'].'-text"' ?> ><?php echo $hide_stat['intelligence']? '???' : h($pilote->get_stats('intelligence'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['dexterity'].'-text"' ?> >Dextérité : 
										<span <?php echo 'class="'.$color_stat['dexterity'].'-text"' ?> ><?php echo $hide_stat['dexterity']? '???' : h($pilote->get_stats('dexterity'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['stamina'].'-text"' ?> >Endurance : 
										<span <?php echo 'class="'.$color_stat['stamina'].'-text"' ?> ><?php echo $hide_stat['stamina']? '???' : h($pilote->get_stats('stamina'));?><span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['speed'].'-text"' ?> >Rapidité : 
										<span <?php echo 'class="'.$color_stat['speed'].'-text"' ?> ><?php echo $hide_stat['speed']? '???' : h($pilote->get_stats('speed'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['strength'].'-text"' ?> >Force : 
										<span <?php echo 'class="'.$color_stat['strength'].'-text"' ?> ><?php echo $hide_stat['strength']? '???' : h($pilote->get_stats('strength'));?><span>
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
						<?php $hide_stat=npc_stats_hide($mecanicien); ?>
						<?php $color_stat=npc_stats_color($mecanicien); ?>
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
										<li <?php echo 'class="'.$color_stat['intelligence'].'-text"' ?> >Intelligence : 
										<span <?php echo 'class="'.$color_stat['intelligence'].'-text"' ?> ><?php echo $hide_stat['intelligence']? '???' : h($mecanicien->get_stats('intelligence'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['dexterity'].'-text"' ?> >Dextérité : 
										<span <?php echo 'class="'.$color_stat['dexterity'].'-text"' ?> ><?php echo $hide_stat['dexterity']? '???' : h($mecanicien->get_stats('dexterity'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['stamina'].'-text"' ?> >Endurance : 
										<span <?php echo 'class="'.$color_stat['stamina'].'-text"' ?> ><?php echo $hide_stat['stamina']? '???' : h($mecanicien->get_stats('stamina'));?><span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['speed'].'-text"' ?> >Rapidité : 
										<span <?php echo 'class="'.$color_stat['speed'].'-text"' ?> ><?php echo $hide_stat['speed']? '???' : h($mecanicien->get_stats('speed'));?></span>
										</li>
										<span class="grey-span">|</span>
										<li <?php echo 'class="'.$color_stat['strength'].'-text"' ?> >Force : 
										<span <?php echo 'class="'.$color_stat['strength'].'-text"' ?> ><?php echo $hide_stat['strength']? '???' : h($mecanicien->get_stats('strength'));?><span>
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