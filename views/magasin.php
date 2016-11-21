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
		<div class="row">
			<?php foreach ($mod_buyable_list as $key => $module): ?>
				<div class="col s6 offset-s3 shop_buy">
					<p>
					<?php echo $module->get_name(); ?> : 
					<?php echo $module->get_type(); ?>
					</p>
					<p style="font-size:.9em">
						<?php $stats = $module->get_stats(); ?>
						<?php foreach ($stats as $name => $value):?>
							<?php if($value!=0): ?>
								<?php switch ($name) {
									case 'aerodynamics': 	$name = 'Aer';
										break;
									case 'solidity': 			$name = 'Sol';
										break;
									case 'cosiness': 			$name = 'Conf';
										break;
									case 'speed': 				$name = 'Vit';
										break;
									case 'shipping': 			$name = 'Nav';
										break;
									default:
										break;
								}?>
								<?php echo $name; ?>: 
								<?php echo $value; ?>
								<span>|</span>
							<?php endif ?>
						<?php endforeach ?>
					</p>
					<button class="btn waves-effect waves-light" type="submit" name="action" id="reg_link">acheter 
					<span><?php echo $module->get_price(); ?></span>
					</button>
				</div> 

			<?php endforeach ?>
		</div>
	</div>
<style>body{background:#F4F4F4; overflow: scroll}</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>