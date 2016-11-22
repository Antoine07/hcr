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
			<div class="col s6 offset-s3 shop_sell">
				<div class="input-field">
					<select>
						<option value="" disabled selected>Vendre un objet</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
					</select>
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
<style>body{background:#F4F4F4; overflow: scroll}</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>