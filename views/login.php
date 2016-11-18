<?php ob_start() ; ?>
 	<div class="content">
 		<div class="connect" id="connect">
 			<h4>Connexion</h4>
	 		<div>
	 			<div class="input-field">
	 				<i class="material-icons prefix">perm_identity</i>
			          		<input id="icon_prefix" type="text" class="validate">
			          		<label for="icon_prefix">Identifiants</label>		
	 			</div>
				<div class="input-field">
				          	<i class="material-icons prefix">lock_outline</i>
				          	<input id="icon_prefix" type="password" class="validate" >
				          	<label for="icon_prefix">Mot de passe</label>
				</div>
				<button class="btn waves-effect waves-light" type="submit" name="action">Connexion</button>
				<p>ou</p>
				<button class="btn waves-effect waves-light regbtn" type="submit" name="action" id="reg_link">S'inscrire</button>

	 		</div>
 		</div>
 		<div class="register dispnone" id="register">
 			<h4>Inscription</h4>
	 		<div>
	 			<div class="input-field">
	 				<i class="material-icons prefix">perm_identity</i>
			          		<input id="identifiants" type="text" class="validate">
			          		<label for="icon_prefix">Identifiants</label>		
	 			</div>
	 			<div class="input-field">
				          	<i class="material-icons prefix">email</i>
          					<input id="email" type="email" class="validate">
          					<label for="email">Email</label>
				</div>
				<div class="input-field">
				          	<i class="material-icons prefix">lock_outline</i>
				          	<input id="icon_prefix" type="password" class="validate">
				          	<label for="icon_prefix">Mot de passe</label>
				</div>
				<div class="input-field"></div>
				<button class="btn waves-effect waves-light subbtn1" type="submit" name="action" id="subscribe">S'inscrire</button>

	 		</div>
 		</div>
 	</div>
<?php $content = ob_get_clean() ; ?>
<?php include 'master_login.php' ?>