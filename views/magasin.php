<?php ob_start() ; ?>
	<div class="content_shop">
		<div class="row">
			<div class="col s12 shop_sell" align="center">
				<button class="btn btnsell waves-effect waves-light" id="btnsell">Vendre des objets</button>
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
											<?php echo $module->get_name(); ?>
										</h6>
										<form action="/index.php/sell" method="POST">
											<input name="item_category" type="text" hidden="none" value="module">
											<input name="item_id" type="number" hidden="none" value=<?php echo $module->get_id(); ?>>
											<input type="submit" class="btn btnsell waves-effect waves-light" id="btnsell" value=" <?php echo $sell_price ?> c">
										</form>
									</div>
								</div>
							</div>
						<?php endforeach ?>
						<div class="sell_card">
							<h6>Objet 1</h6>
							<button class="btn btnsell waves-effect waves-light" id="btnsell">
								Vendre l'objet
							</button>
						</div>
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
											<?php echo $equipment->get_name(); ?>
										</h6>
										<form action="/index.php/sell" method="POST">
											<input name="item_category" type="text" hidden="none" value="equipment">
											<input name="item_id" type="number" hidden="none" value=<?php echo $module->get_id(); ?>>
											<input type="submit" class="btn btnsell waves-effect waves-light" id="btnsell" value=" <?php echo $sell_price ?> c">
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
									<i class="material-icons drop">arrow_drop_down</i>
									<h6>
										<?php echo $module->get_name(); ?>
										<br>
										<span>
											<?php echo $module->get_type(); ?>
										</span>
									</h6>
									<form action="/index.php/buy" method="POST">
										<input name="item_category" type="text" hidden="none" value="module">
										<input name="item_id" type="number" hidden="none" value=<?php echo $module->get_id(); ?>>
										<input type="submit" class="btn buy waves-effect waves-light" value=" <?php echo $module->get_price(); ?> c">
									</form>
								</div>
								<div class="more" style="display: none;">
									<ul class="shop_stats">
										<?php $stats = $module->get_stats(); ?>
										<?php foreach ($stats as $name => $value):?>
											<?php if($value!=0): ?>
												<?php switch ($name) {
													case 'aerodynamics': $name = 'Aer';
														break;
													case 'solidity': $name = 'Sol';
														break;
													case 'cosiness': $name = 'Conf';
														break;
													case 'speed': $name = 'Vit';
														break;
													case 'shipping': $name = 'Nav';
														break;
													default:
														break;
												}?>
												<?php echo $name; ?>: 
												<?php echo $value; ?>
											<?php endif ?>
										<?php endforeach ?>
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
									<i class="material-icons drop">arrow_drop_down</i>
									<h6>
										<?php echo $equipment->get_name(); ?>
										<br>
										<span>
											<?php echo $equipment->get_brand(); ?>
										</span>
									</h6>
									<form action="/index.php/buy" method="POST">
										<input name="item_category" type="text" hidden="none" value="equipment">
										<input name="item_id" type="number" hidden="none" value=<?php echo $equipment->get_id(); ?>>
										<input type="submit" class="btn buy waves-effect waves-light" value=" <?php echo $equipment->get_price(); ?> c">
									</form>	
								</div>
								<div class="more" style="display: none;">
									<ul class="shop_stats">

										<?php $activity = $equipment->get_activity();
										$stats = $equipment->get_activity()->get_stats(); ?>
										<?php foreach ($stats as $name => $value):?>
											<?php if($value!=0): ?>
												<?php switch ($name) {

												}?>
												<?php echo $name; ?>: 
												<?php echo $value; ?>
											<?php endif ?>
										<?php endforeach ?>
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