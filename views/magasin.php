<?php ob_start() ; ?>
	<div class="content_shop">
	<?php echo $header_team; ?>
		<div class="row">
			<div class="col s12 shop_sell" align="center">
				<button class="btn btnsell waves-effect waves-light" id="btnsell"> Vendre des objets </button>
				<a href="#"><i class="material-icons dispnone close_sell" id="close_sell">close</i></a>
			</div> 
		</div>
		<div class="row">
			<div class="content_sell dispnone" id="content_sell">	
				<div class="col s6 sell_modules">
					<h5>Modules</h5>
					<div class="content_object">
						<?php foreach ($mod_salable_list as $key => $module): ?>
							<?php 
								$price = $module->get_price();
								$sell_price = $price/2;
							?>
							<div class="sell_card">
								<div class="shop_element">
									<div class="shop_less">
										<h6>
											<?php echo h($module->get_name()); ?>
										</h6>
										<form action="/index.php/sell" method="POST">
											<input name="item_category" type="text" hidden="none" value="module">
											<input name="item_id" type="number" hidden="none" value=<?php echo h($module->get_id()); ?>>
											<input type="submit" class="btn btnsell waves-effect waves-light" id="btnsell" value=" vendre : <?php echo h($sell_price) ?> c">
										</form>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="col s6 sell_equipments">
					<h5>Equipements</h5>
					<div class="content_object">
						<?php foreach ($equipment_salable_list as $key => $equipment): ?>
							<?php 
								$price = $equipment->get_price();
								$sell_price = $price/2;
							?>
							<div class="sell_card">
								<div class="shop_element">
									<div class="shop_less">
										<h6>
											<?php echo h($equipment->get_name()); ?>
										</h6>
										<form action="/index.php/sell" method="POST">
											<input name="item_category" type="text" hidden="none" value="equipment">
											<input name="item_id" type="number" hidden="none" value=<?php echo h($equipment->get_id()); ?>>
											<input type="submit" class="btn btnsell waves-effect waves-light" id="btnsell" value=" vendre : <?php echo h($sell_price) ?> c">
										</form>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row content_shop_item">
		 	<div class="col s6 shop_left">
				<h5>Modules</h5>
				<div class="content_card">
					<?php foreach ($mod_buyable_list as $key => $module): ?>
						<div class="shop_card">
							<div class="shop_element">
								<div class="shop_less">
									<h6>
										<?php echo h($module->get_name()); ?>
										<br>
										<span>
											<?php ;
												switch ($module->get_type()) {
													case 'shipping':
														echo "Navigation";
														break;
													case 'speed':
														echo "Puissance";
														break;
													case 'complementaire':
														echo "Complémentaire";
														break;
													default:
														# code...
														break;
												}
											 ?>
										</span>
									</h6>
									<form action="/index.php/buy" method="POST">
										<input name="item_category" type="text" hidden="none" value="module">
										<input name="item_id" type="number" hidden="none" value=<?php echo h($module->get_id()); ?>>
										<input type="submit" class="btn buy waves-effect waves-light" value=" <?php echo h($module->get_price()); ?> c">
									</form>
								</div>
								<div class="more">
									<ul class="shop_stats">
										<?php $stats = $module->get_stats(); ?>
										
										<li>Aerodynamique : 
										<span><?php echo $stats['aerodynamics']; ?><span>
										</li>
										<span class="grey-span">|</span>
										<li>Solidité : 
										<span><?php echo $stats['solidity']; ?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Confort : 
										<span><?php echo $stats['cosiness']; ?><span>
										</li>
										<span class="grey-span">|</span>
										<li>Navigation : 
										<span><?php echo $stats['shipping']; ?></span>
										</li>				
										<span class="grey-span">|</span>
										<li>Vitesse : 
										<span><?php echo $stats['speed']; ?></span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		 	<div class="col s6 shop_right">
		 		<h5>Equipements</h5>
				<div class="content_card">
					<?php foreach ($equipment_buyable_list as $key => $equipment): ?>
						<div class="shop_card">
							<div class="shop_element">
								<div class="shop_less">
									<h6>
										<?php echo h($equipment->get_name()); ?>
										<br>
										<span>
											<?php echo h($equipment->get_brand()); ?>
										</span>
									</h6>
									<form action="/index.php/buy" method="POST">
										<input name="item_category" type="text" hidden="none" value="equipment">
										<input name="item_id" type="number" hidden="none" value=<?php echo h($equipment->get_id()); ?>>
										<input type="submit" class="btn buy waves-effect waves-light" value=" <?php echo h($equipment->get_price()); ?> c">
									</form>	
								</div>
								<div class="more">
									<ul class="shop_stats">
										<?php $activity = $equipment->get_activity();
										$stats = $equipment->get_activity()->get_stats(); ?>
										<li>Intelligence : 
										<span><?php echo $stats['intelligence']; ?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Dextérité : 
										<span><?php echo $stats['dexterity']; ?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Endurance : 
										<span><?php echo $stats['stamina']; ?><span>
										</li>
										<span class="grey-span">|</span>
										<li>Rapidité : 
										<span><?php echo $stats['speed']; ?></span>
										</li>
										<span class="grey-span">|</span>
										<li>Force : 
										<span><?php echo $stats['strength']; ?><span>
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
<style>body{background:#F4F4F4;}</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>