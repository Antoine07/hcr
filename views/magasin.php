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
			<div class="col s6 offset-s3 shop_buy">
				<p>Réacteur NSP-1 (NorthStar) : Module de puissance</p>
				<button class="btn waves-effect waves-light" type="submit" name="action" id="reg_link">acheter <span>500</span></button>
			</div> 
			<div class="col s6 offset-s3 shop_buy">
				<p>Simulateur Marka</p>
				<button class="btn waves-effect waves-light" type="submit" name="action" id="reg_link">acheter <span>100</span></button>
			</div> 
			<div class="col s6 offset-s3 shop_buy">
				<p>Introduction à la navigation : Manuel</p>
				<button class="btn waves-effect waves-light" type="submit" name="action" id="reg_link">acheter <span>55</span></button>
			</div> 
			<div class="col s6 offset-s3 shop_buy">
				<p>Radar PRX (Kuzo Tech) : Module optionnel</p>
				<button class="btn waves-effect waves-light" type="submit" name="action" id="reg_link">acheter <span>1500</span></button>
			</div> 
		</div>
	</div>
<style>body{background:#F4F4F4; overflow: scroll}</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>