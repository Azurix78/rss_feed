<?php


function inscription($bdd, $pseudo, $prenom, $nom, $date, $sex, $email, $ville, $pass)
{

$ville = ucfirst($ville);
// Génération aléatoire d'une clé
$cle = md5(microtime(TRUE)*100000);

	$req = mysqli_prepare($bdd, "INSERT INTO users(nom, pseudo, prenom, birthdate, sex, email, city ,mdp, cle) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
	mysqli_stmt_bind_param( $req, "sssssssss", $nom, $pseudo, $prenom, $date, $sex, $email, $ville, $pass, $cle);
	mysqli_stmt_execute($req);

	// Préparation du mail contenant le lien d'activation
	$destinataire = $email;
	$sujet = "Activer votre compte" ;
	$entete = "From: inscription@my_meetic.com" ;
	 
	// Le lien d'activation est composé du pseudo(log) et de la clé(cle)
	$message = 'Bienvenue sur My_Meetic,
	 
	Pour activer votre compte, veuillez cliquer sur le lien ci dessous
	ou copier/coller dans votre navigateur internet.
	 
	http://rubio-n.wac.epitech.eu/my_meetic/index.php?page=validation&log='.urlencode($pseudo).'&cle='.urlencode($cle).'
	 
	 
	---------------
	Ceci est un mail automatique, Merci de ne pas y répondre.';
	 
	var_dump($message);
	mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail

}

function login($bdd, $pass, $pseudo)
{
	$req = mysqli_query($bdd, "SELECT mdp FROM users WHERE pseudo = \"$pseudo\" ");
	if (!$check = mysqli_fetch_assoc($req) )
	{
		return false;
	}
	if ( $check['mdp'] == crypt($pass, $check['mdp']) )
	{
		$req = mysqli_query($bdd, "SELECT id_user, actif FROM users WHERE pseudo = \"$pseudo\" ");
		$usersinfo = mysqli_fetch_assoc($req);

		if ( $usersinfo['actif'] > 0 )
		{
			$_SESSION['id'] = $usersinfo['id_user'];
			return true;
		}
		else
		{
			$error = "nonactif";
			return $error;
		}
		
	}
	else
	{
		return false;
	}
}



?>