<div id="flux">
	<div class="article_full">
		<div class="bar_titre">
			<h1>Gestion de votre profil</h1>
		</div>
			<div class="flux_list">
				<ul>
					<li>Flux</li>
					<li>Flux</li>
					<li>Flux</li>
					<li>Flux</li>
					<li>Flux</li>
					<li>Flux</li>
				</ul>
			</div>
			
			
	</div>
	<div class="flux_gestion">
		<h2><img id="config" src="<?php echo ROOT;?>media/img/config.png" alt="config">Configuration</h2>
		<div id="sub_conf">
			<h3>Supprimer</h3>
			<form method="POST" action="<?php echo ROOT;?>flux/supprimer">
				<select>
					<?php
					foreach ($data['flux'] as $value)
					{
						?>
						<option><?php echo $value;?></option>
						<?php
					}
					?>
				</select>
				<input type="submit" name="suppr_flux" id="supprimer" value="&#10006;">
			</form>
		</div>
		<div id='add_flux'>
			<h3>Ajouter</h3>
			<form method="POST" action="<?php echo ROOT;?>flux/add">
				<div><input type="text" class="add_txt" placeholder="url" name="new_flux"></div>
				<div><input type="text" class="add_txt" placeholder="nom" name="nom"></div>
				<div><input type="submit" id="add" value="&#10004;" name="add_flux"></div>
			</form>
		</div>
	</div>