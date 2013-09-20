<div id="flux">
	<?php
	foreach ($data['article']->channel->item as $value)
	{
	?>
	<div class="article_full">
		<div class="bar_titre">
			<h1><a href="<?php echo $value->link;?>"><?php echo $value->title;?></a></h1><span class="date"><?php echo date("d/m/y H\hi", strtotime($value->pubDate))
			;?></span>
		</div>
		<article>
			<p><?php echo $value->description;?></p>
		</article>
	</div>
	<?php
	}	
	?>	
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
				<a onclick="loading()" href="<?php echo ROOT;?>flux/<?php echo $value['id'];?>"><?php echo $value['nom'];?></a>
			<?php
			}
		}
		?>
	</div>
<div id="loading"><img src='<?php echo ROOT;?>media/img/loading.gif' alt='chargement'></div>