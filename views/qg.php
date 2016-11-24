<?php ob_start() ; ?>
	<div class="content_qg">
		<?php echo $header_team; ?>
		<div class="row">
			<div class="col s6">
				<div class="qg_card">
					<div class="flex">
						<img class="bar_portrait" src="../images/<?php echo $pilot->get_id() ?>.png" alt="">
						<h6><?php echo $pilot->get_name();?></h6>	
					</div>
					<ul class="qg_stats">
						<li>Intelligence: <?php  echo $pilot->get_stats('intelligence')?></li>
						<span>|</span>
						<li>Dextérité: <?php  echo $pilot->get_stats('dexterity')?></li>
						<span>|</span>
						<li>Endurance: <?php  echo $pilot->get_stats('stamina')?></li>
						<span>|</span>
						<li>Rapidité: <?php  echo $pilot->get_stats('speed')?></li>
						<span>|</span>
						<li>Force: <?php  echo $pilot->get_stats('strength')?></li>
					</ul>
					<form action="<?php echo url('qg') ?>" method="POST">
						<div class="input-field"   title="Activité assginé avant la course. Elle permet d'augmenter les compétences de ce personnage">
							<select name="activity1">
								<option value="" disabled selected>Activité</option>
								<?php foreach ($list_activities as $activity): ?>
									<?php if ($spaceship->get_pilot()->get_activity_id() == $activity['id']): ?>
										<option value="<?php echo $activity['id']?>" selected><?php echo $activity['name']?></option>
									<?php else: ?>
										<option value="<?php echo $activity['id']?>"><?php echo $activity['name']?></option>
									<?php endif ?>
								<?php endforeach ?>								
								<?php foreach ($list_equipment as $equipment): ?>
									<?php if ($spaceship->get_pilot()->get_activity_id()== $equipment->get_activity_id()): ?>
										<option value="<?php echo $equipment->get_activity_id()?>" selected><?php echo $equipment->get_activity()->get_name()?></option>
									<?php else: ?>
										<option value="<?php echo $equipment->get_activity_id() ?>"><?php echo $equipment->get_activity()->get_name()?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>
						<div class="input-field">
							<button class="btn waves-effect waves-light buy" type="submit">Entrainer</button>	
						</div>
					</form>
				</div>
			</div>
			<div class="col s6 qg_spaceship">
			 	<img class="qg_img" src="/images/vaisseaux/base_ship.png">
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="qg_card">
					<div class="flex">
						<img class="bar_portrait" src="../images/<?php echo $mechanic->get_id() ?>.png" alt="">
						<h6><?php echo $mechanic->get_name();?></h6>
					</div>
						<ul class="qg_stats">
							<li>Intelligence: <?php  echo $mechanic->get_stats('intelligence')?></li>
							<span>|</span>
							<li>Dextérité: <?php  echo $mechanic->get_stats('dexterity')?></li>
							<span>|</span>
							<li>Endurance: <?php  echo $mechanic->get_stats('stamina')?></li>
							<span>|</span>
							<li>Rapidité: <?php  echo $mechanic->get_stats('speed')?></li>
							<span>|</span>
							<li>Force: <?php  echo $mechanic->get_stats('strength')?></li>
						</ul>

					<form action="<?php echo url('qg') ?>" method="POST">
						<div class="input-field"   title="Activité assginé avant la course. Elle permet d'augmenter les compétences de ce personnage">
							<select name="activity2">
								<option value="" disabled selected>Activité</option>
								<?php foreach ($list_activities as $activity): ?>
									<?php if ($spaceship->get_mechanic()->get_activity_id() == $activity['id']): ?>
										<option value="<?php echo $activity['id']?>" selected><?php echo $activity['name']?></option>
									<?php else: ?>
										<option value="<?php echo $activity['id']?>"><?php echo $activity['name']?></option>
									<?php endif ?>
								<?php endforeach ?>								
								<?php foreach ($list_equipment as $equipment): ?>
									<?php if ($spaceship->get_mechanic()->get_activity_id()== $equipment->get_activity_id()): ?>
										<option value="<?php echo $equipment->get_activity_id()?>" selected><?php echo $equipment->get_activity()->get_name()?></option>
									<?php else: ?>
										<option value="<?php echo $equipment->get_activity_id() ?>"><?php echo $equipment->get_activity()->get_name()?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>
						<div class="input-field">
							<button class="btn waves-effect waves-light buy" type="submit">Entrainer</button>	
						</div>
					</form>
				</div>
			</div>
			<div class="col offset-s1 s4 qg_infos_spaceship">
				<div class="qg_card">
					<h6><?php echo $spaceship->get_name(); ?></h6>
					<ul class="qg_stats">
						<li>Aerodynamique: <?php echo $spaceship->get_stats('aerodynamics'); ?></li>
						<span>|</span>
						<li>Solidité: <?php echo $spaceship->get_stats('solidity'); ?></li>
						<span>|</span>
						<li>Confort: <?php echo $spaceship->get_stats('cosiness'); ?></li>
						<span>|</span>
						<li>Navigation: <?php echo $spaceship->get_stats('shipping'); ?></li>
						<span>|</span>
						<li>Vitesse: <?php echo $spaceship->get_stats('speed'); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="qg_module">
				<form action="<?php echo url('qg'); ?>" method ="POST">
					<div class="input-field" title="Module obligatoire. Il permet d'augmenter fortement sa navigation. Si non équipé, vous ne pourrez participer a la course">
						<select name="shipping">
							<option value="" disabled selected>Module Navigation</option>
							<?php foreach ($list_module as $module): ?>
								<?php if ($module->get_type() == 'shipping'): ?>
									<?php if ($spaceship->get_modules('nav')): ?>
										<?php if ($module->get_id()==$spaceship->get_modules('nav')->get_id()): ?>
											<option value='<?php echo $module->get_id();?>' selected><?php echo $module->get_name();?></option>
											<?php continue; ?>							
										<?php else: ?>	
											<option value="<?php echo $module->get_id(); ?>"><?php echo $module->get_name(); ?></option>							
										<?php endif ?>
									<?php endif ?>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="input-field"  title="Module obligatoire. Il permet d'augmenter fortement sa vitesse. Si non équipé, vous ne pourrez participer a la course">
						<select name="power">
							<option value="" disabled selected>Module Puissance</option>
							<?php foreach ($list_module as $module): ?>
								<?php if ($module->get_type() == 'speed'): ?>
									<?php if ($spaceship->get_modules('pow')): ?>
										<?php if ($module->get_id()==$spaceship->get_modules('pow')->get_id()): ?>
											<option value='<?php echo $module->get_id();?>' selected><?php echo $module->get_name();?></option>
											<?php continue; ?>							
										<?php else: ?>	
											<option value="<?php echo $module->get_id(); ?>"><?php echo $module->get_name(); ?></option>							
										<?php endif ?>
									<?php endif ?>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="input-field"  title="Module facultatif. Il permet d'augmenter ses charactéristique. Si non équipé, vous pourrez participer a la course">
						<select name='mod3'>
							<option value="" disabled selected>Module 3</option>
							<?php foreach ($list_module as $module): ?>
								<?php if ($module->get_type() == 'complementaire'): ?>
									<?php if ($spaceship->get_modules('comp_1')): ?>
										<?php if ($module->get_id()==$spaceship->get_modules('comp_1')->get_id()): ?>
											<option value='<?php echo $module->get_id();?>' selected><?php echo $module->get_name();?></option>
											<?php continue; ?>							
										<?php else: ?>
											<option value="<?php echo $module->get_id(); ?>"><?php echo $module->get_name(); ?></option>							
										<?php endif ?>
									<?php endif ?>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="input-field"  title="Module facultatif. Il permet d'augmenter ses charactéristique. Si non équipé, vous pourrez participer a la course">
						<select name='mod4'>
							<option value="" disabled selected>Module 4</option>
							<?php foreach ($list_module as $module): ?>
								<?php if ($module->get_type() == 'complementaire'): ?>
									<?php if ($spaceship->get_modules('comp_2')): ?>
										<?php if ($module->get_id()==$spaceship->get_modules('comp_2')->get_id()): ?>
											<option value='<?php echo $module->get_id();?>' selected><?php echo $module->get_name();?></option>
											<?php continue; ?>							
										<?php else: ?>
											<option value="<?php echo $module->get_id(); ?>"><?php echo $module->get_name(); ?></option>							
										<?php endif ?>
									<?php endif ?>
								<?php endif ?>
							<?php endforeach ?>	
						</select>
					</div>
					<div class="input-field mr0"   title="Valider vos changements !">
						<button class="btn waves-effect waves-light buy" type="submit">Changer</button>	
					</div>
				</form>	
			</div>
		</div>
	</div>
<style>body{background:#F4F4F4;</style>
<?php $content = ob_get_clean() ; ?>
<?php include 'master.php' ?>