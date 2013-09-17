<!DOCTYPE html>
<html>
	<head>
		<title>Connexion My_rss</title>
		<meta name="author" content="rubio_n">
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="<?php echo ROOT; ?>/css/connect.css" />
		<script type="text/javascript" src="<?php echo ROOT; ?>js/js.js"></script>
	</head>
	<body>
		<nav></nav>
		<div class="container">
			<div class="article_full">
				<div class="bar_titre">
					<h1>Bienvenue sur MY_RSS</h1>
				</div>
				<p>My_RSS est un site n&eacute;c&eacute;ssitant un compte utilisateur.</p>
				<p>Inscrivez-vous pour acceder au site.</p>
				<input type="button" onclick="ins('inscription')" id="tog" class="btn" value="S'inscrire">
				<div id="inscription" style="display:none;">
					<form method="POST" action="<?php echo ROOT; ?>connect/inscription">
							<label for="pseudo_in">Pseudo :</label>
								<input type="text" name="pseudo_in" id="pseudo_in" required>
							<label for="pass">Mot de passe (*) :</label>
								<input type="password" name="pass_in" id="pass" placeholder="Au moins 6 caract&egrave;res" required>
							<input class="submit" type="submit" name="btn_in" value="Envoyer">
					</form>
				</div>
			</div>
			<div class="article_full">
				<div class="bar_titre">
					<h1>D&eacute;j&agrave; inscrit ?</h1>
				</div>
					<form method="POST" action="<?php echo ROOT; ?>connect/login">
						<label for="pseudo">Pseudo :</label><input name="pseudo_log" type="text" id="pseudo">
						<label for="mdp">Mot de passe :</label><input name="pass_log" type="password" id="mdp">
						<input type="submit" name="login" value="OK">
					</from>
			</div>
		</div>
	</body>
</html>