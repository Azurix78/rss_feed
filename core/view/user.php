<div class="left_container">
		<div id="info">
			<h1>Profil de <? echo $userinfo['pseudo']; ?></h1>
				<div class="info_profil">
					<div class="img_sex_profil">
						<img src="img/<?php echo $type_img; ?>.png" alt="sex">
					</div>
					<div class="legend_profil">
						<?php echo $tableau; ?>
					</div>
				</div>
		</div>
		<div id="message">
			<h1>Messagerie</h1>
				<img src="img/home.jpg" alt="photo">
				<div id="create_conv">
					<form method="POST" action="index.php?page=user&amp;id=<?php echo $id; ?>">
						<button onclick="switch_conv('add_conv')" type="button">D&eacute;buter une nouvelle couversation avec cette personne</button>
						<div class="conv hide" id="add_conv">
							<input id="titre_add" type="text" placeholder="Titre" name="titre">
							<textarea name="content"></textarea>
							<input class="sub" type="submit" name="btn_creat_conv" value="Envoyer">
						</div>
					</form>
				</div>
		</div>
</div>

<div class="right_container">
	<ul>
		<li><button type="button" onclick="profil_html('message')">Messagerie</button></li>
	</ul>	
</div>