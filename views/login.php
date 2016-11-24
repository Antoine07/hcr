<?php ob_start() ; ?>
 	<div class="content">
 		<form class="connect" method="POST" action="login_post" id="connect">
 			<h4>Connexion</h4>
	 		<div>
	 			<div class="input-field">
	 				<i class="material-icons prefix">perm_identity</i>
			          		<input id="icon_prefix" name="pseudo" type="text" class="validate">
			          		<label for="icon_prefix">Identifiants</label>		
	 			</div>
				<div class="input-field">
				          	<i class="material-icons prefix">lock_outline</i>
				          	<input id="icon_prefix" name="password" type="password" class="validate" >
				          	<label for="icon_prefix">Mot de passe</label>
				</div>
				<button class="btn waves-effect waves-light" type="submit" name="action">Connexion</button>
				<p>ou</p>
				<a class="btn waves-effect waves-light regbtn" id="reg_link">S'inscrire</a>

	 		</div>
 		</form>
 		<form class="register dispnone" method="POST" action="inscription_post" id="register">
 			<h4>Inscription</h4>
	 		<div>
	 			<div class="input-field">
	 				<i class="material-icons prefix">perm_identity</i>
			          		<input id="identifiants" name="pseudo" type="text" class="validate" autocomplete="off">
			          		<label for="icon_prefix">Identifiants</label>		
	 			</div>
	 			<div class="input-field">
	 				<i class="material-icons prefix">supervisor_account</i>
			          		<input id="team_name" name="team_name" type="text" class="validate" autocomplete="off">
			          		<label for="icon_prefix">Nom de votre team</label>		
	 			</div>
	 			<div class="input-field">
				          	<i class="material-icons prefix">email</i>
          					<input id="email" name="email" type="email" class="validate" autocomplete="off">
          					<label for="email">Email</label>
				</div>
				<div class="input-field">
				          	<i class="material-icons prefix">lock_outline</i>
				          	<input id="password" name="password" type="password" class="validate" autocomplete="off">
				          	<label for="password">Mot de passe</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">lock_outline</i>
				          	<input id="re_password" name="password" type="password" class="validate" autocomplete="off">
				          	<label for="re_password">Confirmez votre mot de passe</label>
				</div>
	 		</div>
 		</form>
 		<button class="btn waves-effect waves-light regbtn dispnone"  id="subscribe_post">S'inscrire</button>
 	</div>
<?php $content = ob_get_clean() ; ?>
<?php include 'master_login.php' ?>