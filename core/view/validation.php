<!DOCTYPE html>
<html>
	<head>
		<title>Validation My Meetic</title>
		<meta name="author" content="rubio_n">
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/connect.css" />
		<script type="text/javascript" src="js/js.js"></script>
		
	</head>
	<body>
		<div class="container">
			<div class="left_container">
				<h1>My meetic</h1>
			</div>
			<img src="img/coeurrose.png" style="visibility:hidden;width:303px;margin-top:250px;" id="blink">
			<div class="right_container">
				<div class="logs">
					<h1>Activation de votre compte</h1>
					<p><?php echo $valid_text ?></p>
				</div>
			</div>
		</div>
		<script type="text/javascript">blinkimg('blink');</script>
	</body>
</html>