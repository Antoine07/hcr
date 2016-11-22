<?php ob_start() ; ?>
	<div class="content_shop">
		<div class="row">
			<div class="col s12 shop_top">
				<h4>Magasin</h4>
				<ul class="shop_list">
					<li class="shop_team">team JOJO</li>
					<span>|</span>
					<li>50.000 c</li>
					<span>|</span>
					<li>203 points</li>
					<span>|</span>
					<li>7ème</li>
				</ul>
			</div>
		</div>
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
						<div class="sell_card">
							<h6>Objet 1</h6>
							<button class="btn btnsell waves-effect waves-light" id="btnsell">
								Vendre l'objet
							</button>
						</div>
						<div class="sell_card">
							<h6>Objet 1</h6>
							<button class="btn btnsell waves-effect waves-light" id="btnsell">
								Vendre l'objet
							</button>
						</div>
						<div class="sell_card">
							<h6>Objet 1</h6>
							<button class="btn btnsell waves-effect waves-light" id="btnsell">
								Vendre l'objet
							</button>
						</div>
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
									<button class="btn buy waves-effect waves-light"> <?php echo $module->get_price(); ?> crédits</button>	
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
									<button class="btn buy waves-effect waves-light"> <?php echo $equipment->get_price(); ?> crédits</button>	
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