<?php ob_start() ; ?>
	<div class="content_qg">
		<div class="row">
			<div class="col s12 qg_top">
				<h4>QG	</h4>
				<ul class="qg_list">
					<li class="qg_team">team JOJO</li>
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
			<div class="col s6">
				<div class="qg_card">
					<h6>Mitch Polid - Pilote</h6>
						<ul class="qg_stats">
							<li>Int: 34</li>
							<span>|</span>
							<li>Dex: 120</li>
							<span>|</span>
							<li>End: 200</li>
							<span>|</span>
							<li>Rap: 213</li>
							<span>|</span>
							<li>For: 304</li>
						</ul>

					<div class="input-field">
						<select>
							<option value="" disabled selected>Activité</option>
							<option value="1">Option 1</option>
							<option value="2">Option 2</option>
							<option value="3">Option 3</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col s6 qg_spaceship">
			 	<img class="qg_img" src="/images/vaisseaux/base_ship.png">
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="qg_card">
					<h6>Mitch Polid - Mécanicien</h6>
						<ul class="qg_stats">
							<li>Int: 34</li>
							<span>|</span>
							<li>Dex: 129</li>
							<span>|</span>
							<li>End: 200</li>
							<span>|</span>
							<li>Rap: 213</li>
							<span>|</span>
							<li>For: 304</li>
						</ul>

					<div class="input-field">
						<select>
							<option value="" disabled selected>Activité</option>
							<option value="1">Option 1</option>
							<option value="2">Option 2</option>
							<option value="3">Option 3</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col offset-s1 s4 qg_infos_spaceship">
				<div class="qg_card">
					<h6>Speed runner AS-250 - Vaisseau</h6>
					<ul class="qg_stats">
						<li>Aero: 34</li>
						<span>|</span>
						<li>Sol: 120</li>
						<span>|</span>
						<li>Conf: 200</li>
						<span>|</span>
						<li>Nav: 213</li>
						<span>|</span>
						<li>Vit: 105</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="qg_module">
				<div class="input-field">
					<select>
						<option value="" disabled selected>Module Navigation</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
					</select>
				</div>
				<div class="input-field">
					<select>
						<option value="" disabled selected>Module Puissance</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
					</select>
				</div>
				<div class="input-field">
					<select>
						<option value="" disabled selected>Module 3</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
					</select>
				</div>
				<div class="input-field">
					<select>
						<option value="" disabled selected>Module 4</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
					</select>
				</div>
			</div>
		</div>
	</div>
<style>body{background:#F4F4F4;</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>