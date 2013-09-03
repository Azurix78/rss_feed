<?php
require_once 'inc/model/connect.php';

//#################################################################
//########################## INSCRIPTION ##########################
//#################################################################
if ( isset($_POST['ok_in']))
{
	if ( 
		isset($_POST['pseudo_in']) 
		AND isset($_POST['nom_in']) 
		AND isset($_POST['prenom_in']) 
		AND isset($_POST['date_n_in']) 
		AND isset($_POST['sex']) 
		AND isset($_POST['email_in']) 
		AND isset($_POST['ville_in'])
		AND isset($_POST['pass'])
		AND !empty($_POST['pseudo_in']) 
		AND !empty($_POST['nom_in']) 
		AND !empty($_POST['prenom_in']) 
		AND !empty($_POST['date_n_in']) 
		AND !empty($_POST['sex']) 
		AND !empty($_POST['email_in']) 
		AND !empty($_POST['ville_in'])
		AND !empty($_POST['pass'])
		)
	{
		$pseudo = xmlentities($_POST['pseudo_in']);
		if (pseudo_dispo($bdd, $pseudo) == true )
		{
			$error = "Pseudo d&eacute;j&agrave; prit.";
		}
		$prenom = xmlentities($_POST['prenom_in']);
		$nom = xmlentities($_POST['nom_in']);
		$date = xmlentities($_POST['date_n_in']);
		if (xmlentities($_POST['sex']) == "Masculin"){$sex = "m";}
		elseif (xmlentities($_POST['sex']) == "Feminin"){$sex = "w";}
		else{$error = "don't fuck with meetic !";}
		if (preg_match("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email_in']))
			{
				$email = $_POST['email_in'];
			}
		else
			{
				$error = "Email non valide.";
			}


		$ville = xmlentities($_POST['ville_in']);
		$pass = xmlentities($_POST['pass']);
		if(strlen($pass) < 6)
		{
			$error = "Le mot de passe doit contenir au moins six carat&egrave;res.";
		}
		else
		{
			$pass = crypt("$pass");
		}
		
		unset($_POST);

		if ( !isset($error) )
		{
			inscription($bdd, $pseudo, $prenom, $nom, $date, $sex, $email, $ville, $pass);
			$success = "Vous &ecirc;tes inscrit ! Pour valider votre compte rendez-vous sur votre bo&icirc;te mail.";
		}
	}
	else
	{
		$error = "Tous les champs sont obligatoires.";
	}
}


//#################################################################
//########################## LOGIN ################################
//#################################################################

if ( isset($_POST['login']))
{
	if 	(
		isset($_POST['pseudo']) 
		AND !empty($_POST['pseudo']) 
		AND isset($_POST['mdp']) 
		AND !empty($_POST['mdp'])
		)
	{
		$pseudo = xmlentities($_POST['pseudo']);
		$mdp = xmlentities($_POST['mdp']);
		$login = login($bdd, $mdp, $pseudo);
		if ( $login === true )
		{
			header('location:index.php');
		}
		elseif ( $login == "nonactif" )
		{
			$error = "Veuillez activer votre compte.";
		}
		else
		{
			$error = "Mauvais Pseudo ou mot de passe.";
		}
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
require_once 'inc/view/connect.php';
?>