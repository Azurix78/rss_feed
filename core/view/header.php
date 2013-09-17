<!DOCTYPE html>
<html>
	<head>
		<title>My_rss - lecteur RSS</title>
		<meta name="author" content="rubio_n">
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="<?php echo ROOT;?>media/img/favicon.ico" />
		<link rel="stylesheet" href="<?php echo ROOT;?>css/style.css" />
		<script type="text/javascript" src="<?php echo ROOT;?>js/js.js"></script>
		
	</head>
	<body>
		<nav>
			<div id="logo">
				<img src="/rss_feed/media/img/rss.png" alt="logo"><a href="<?php echo ROOT;?>">My Rss</a>
			</div>

			<div id="logout" onclick="deco('logout')" onmouseout="leavedeco('logout')">
				<p>• Bienvenue <?php echo $_SESSION['pseudo'];?></p>
			</div>


			<div id="h_link">
				<ul>
					<li><a href="<?php echo ROOT;?>home">Accueil</a></li>
					• <li><a href="<?php echo ROOT;?>gestion">Gestion</a></li> •
					<li><a href="<?php echo ROOT;?>flux">Mes Flux</a></li>
				</ul>
			</div>

			
		</nav>

		<div class="container">

		