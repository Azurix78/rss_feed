<div id="flux">
	<div class="article_full">
		<div class="bar_titre">
			<h1>Selectionnez un Flux à afficher</h1>
		</div>
		<article>
			<p>Vous pouvez ajouter un flux RSS grâce à l'encart "configuration".</p>
			<p>Vous pouvez supprimer un flux RSS grâce à l'encart "configuration".</p>
			<p>Accedez à vos Flux grâce à l'encart "menu".</p>
		</article>
	</div>
			
			
	</div>
	<div class="flux_gestion">
		<h2><img id="config" src="<?php echo ROOT;?>media/img/config.png" alt="config">Configuration</h2>
		<div id="sub_conf">
			<h3>Supprimer</h3>
			<form method="POST" action="<?php echo ROOT;?>flux/supprimer">
				<select name="nom">
					<?php
					foreach ($data['flux'] as $value)
					{
						?>
						<option value="<?php echo $value;?>"><?php echo $value;?></option>
						<?php
					}
					?>
				</select>
				<input onclick="loading()" type="submit" name="suppr_flux" id="supprimer" value="&#10006;">
			</form>
		</div>
		<div id='add_flux'>
			<h3>Ajouter</h3>
			<form method="POST" action="<?php echo ROOT;?>flux/add">
				<div><input onclick="loading()" type="submit" id="add" value="&#10004;" name="add_flux"></div>
				<div><input type="text" class="add_txt" placeholder="url" name="new_flux"></div>
				<div><input type="text" class="add_txt" placeholder="nom" name="nom"></div>
			</form>
		</div>
	</div>

	<div class="select_flux">
		<h2>Menu</h2>
		<?php
		if(isset($data['link']))
		{
			foreach ($data['link'] as $value)
			{
			?>
				<a onclick="loading()" href="<?php echo ROOT;?>flux/<?php echo $value['id'];?>">
					<?php if($value['new']==1){echo 'NEW : '.$value['nom'];}elseif($value['hot']==1){echo 'HOT : '.$value['nom'];}else{echo $value['nom'];}?>
				</a>
			<?php
			}
		}
		else
		{
			?>
			<p>Vous n'avez pas ajouté de flux.</p>
			<?php
		}
		?>
	</div>
<div id="loading"><img src='<?php echo ROOT;?>media/img/loading.gif' alt='chargement'></div>