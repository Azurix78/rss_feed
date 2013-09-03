<?php
require_once 'inc/model/validation.php';

if( isset($_GET['log']) AND isset($_GET['cle']) AND !empty($_GET['log']) AND !empty($_GET['cle']) )
{
	$pseudo = xmlentities($_GET['log']);
	$cle = xmlentities($_GET['cle']);
	$valid = validation($bdd, $pseudo, $cle);
	if ( $valid === true )
	{
		$valid_text = "Votre compte &agrave; &eacute;t&eacute; valid&eacute;.";
	}
	else
	{
		$valid_text = "Une erreur s'est produite lors de l'activation de votre compte ou votre compte est d&eacute;j&agrave; activ&eacute;.";
	}
}
else
{
	$valid_text = "Pourquoi venir sur cette page ?";
}

require_once 'inc/view/validation.php';
?>