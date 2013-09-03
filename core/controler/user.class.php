<?php
require_once 'inc/model/user.php';

if ( isset($_GET['id']) )
{
	if ( $_GET['id'] != $_SESSION['id'] )
	{
		$userinfo = getUserinfos($bdd, $id);	
	}
	else
	{
		header('location:index.php?page=profil');
	}
	
}
else
{
	header('location:index.php?page=profil');
}

$pseudo = $userinfo['pseudo'];
$nom = $userinfo['nom'];
$prenom = $userinfo['prenom'];
$city = $userinfo['city'];
$age = getAge($userinfo['birthdate']);
$email = $userinfo['email'];
$sex = $userinfo['sex'];
$id = $_GET['id'];


if ($sex == "m")
{
	$type_img = "male";
}
else
{
	$type_img = "female";
}


ob_start();
?>
<table>

	<tr>
		<th>Pseudo :</th>
		<td><?php echo xmldecode(xmlentities($pseudo)); ?></td>
	</tr>
	<tr>
		<th>Nom :</th>
		<td><?php echo xmldecode(xmlentities($nom)); ?></td>
	</tr>
	<tr>
		<th>Pr&eacute;nom :</th>
		<td><?php echo xmldecode(xmlentities($prenom)); ?></td>
	</tr>
	<tr>
		<th>Ville :</th>
		<td><?php echo xmldecode(xmlentities($city)); ?></td>
	</tr>
	<tr>
		<th>Age :</th>
		<td><?php echo $age; ?> ans</td>
	</tr>
	<tr>
		<th>Email :</th>
		<td><?php echo xmldecode(xmlentities($email)); ?></td>
	</tr>

</table>
<?php
$tableau = ob_get_clean();

if ( isset($_POST['btn_creat_conv']) )
{
	if ( isset($_POST['titre']) AND !empty($_POST['titre']) AND isset($_POST['content']) AND !empty($_POST['content']) )
	{
		$titre = xmlentities($_POST['titre']);
		$content = xmlentities($_POST['content']);
		$id_sender = $_SESSION['id'];
		$id_receiver = xmlentities($_GET['id']);

		$id_conv = getIDCONV($bdd);
		$id_conv = intval($id_conv) +1;

		create_conv($bdd, $titre, $id_sender, $id_receiver, $content, $id_conv);
		$success = "Message envoy&eacute;.";
	}
	else
	{
		$error = "Veuillez remplir tous les champs.";
	}
}

//#################################################################
//########################## AFFICHAGE ERREUR #####################
//#################################################################
if ( isset($success) )
{
	?>
	<div class="success_alert" id="alert" onclick="closealert('alert')">
				<p><strong>Succ&egrave;s :</strong> <?php echo $success; ?></p>
	</div>
	<?php
}

if ( isset($error) )
{
	?>
	<div class="error_alert" id="alert" onclick="closealert('alert')">
				<p><strong>Erreur :</strong> <?php echo $error; ?></p>
	</div>
	<?php
}

require_once 'inc/view/user.php';

?>