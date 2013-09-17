<div id="gestion">
	<div class="article_full">
		<div class="bar_titre">
			<h1>Gestion de votre profil</h1>
		</div>

		<form method="POST" action="<?php echo ROOT;?>gestion/pseudo ">
			<fieldset>
				<legend>Changer de Pseudo</legend>

				<div class="right">
					<input class="in_sub" type="submit" name="change_pseudo" value="Changer">
				</div>
				
				<div class="left">
					<div class="block">
						<label for="pseudo_edit">Nouveau Pseudo :</label>
							<input type="text" id="" name="pseudo_edit" placeholder="<?php echo $_SESSION['pseudo'];?>">
					</div>
				</div>
			</fieldset>
		</form>
		
		<form method="POST" action="<?php echo ROOT;?>gestion/pass ">
			<fieldset>
				<legend>Changer de mot de passe</legend>
				<div class="right">
					<input class="in_sub" type="submit" name="change_pass" value="Changer">
				</div>
				
				<div class="left">
					<div class="block">
						<label for="pass_old">Ancien mot de passe :</label>
							<input type="password" id="pass_old" name="oldpass_edit">
					</div>
					<div class="block">
						<label for="pass_new">Nouveau mot de passe :</label>
							<input type="password" id="pass_new" name="newpass_edit">
					</div>
				</div>
			</fieldset>
		</form>
	</div>