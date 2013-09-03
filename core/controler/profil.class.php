<?php
require_once "inc/model/profil.php";

$userinfo = getUserinfos($bdd, $_SESSION['id']);

if (isset($_POST['quitt_conv']))
{
	if(isset($_POST['n_id_conv']))
	{
		$id_conv = abs(intval($_POST['n_id_conv']));

			if ( $id_conv == 0 )
			{
				$error = "Don't fuck with My meetic !";
			}
			else
			{
				quitCONV($bdd, $_SESSION['id'], $id_conv);
				$success = "Vous avez quitter la conversation.";
			}	

	}
}

if (isset($_POST['sup_conv']))
{
	if(isset($_POST['n_id_conv']))
	{
		$id_conv = abs(intval($_POST['n_id_conv']));

			if ( $id_conv == 0 )
			{
				$error = "Don't fuck with My meetic !";
			}
			else
			{
				delCONV($bdd, $id_conv);
				$success = "Vous avez quitter la conversation.";
			}	

	}
}

if( isset($_POST['btn_rep']) )
{
	if ( isset($_POST['rep']) AND !empty($_POST['rep']) AND isset($_POST['id_parent']) AND !empty($_POST['id_parent']) AND isset($_POST['id_receiver']) AND !empty($_POST['id_receiver']) AND isset($_POST['id_conv']) AND !empty($_POST['id_conv']) )
	{
		$id_parent = $_POST['id_parent'];
		$id_sender = $_SESSION['id'];
		$id_receiver = $_POST['id_receiver'];
		$content = $_POST['rep'];
		$id_conv = abs(intval($_POST['id_conv']));
			if ( $id_conv == 0 )
			{
				$error = "Don't fuck with My meetic !";
			}
			else
			{
				sendMSG($bdd, $id_parent, $content, $id_sender, $id_receiver, $id_conv);
				$success = "Message envoy&eacute;.";
			}	
	}
	else
	{
		$error = "Veuillez remplir tous les champs.";
	}
}

if ( isset($_POST['btn_mdp']) )
{
	if ( isset($_POST['old_pass']) AND !empty($_POST['old_pass']) 
		AND isset($_POST['new_pass']) AND !empty($_POST['new_pass']) 
		AND isset($_POST['verif_pass']) AND !empty($_POST['verif_pass']) )
	{
		$new_pass = xmlentities($_POST['new_pass']);
		$old_pass = xmlentities($_POST['old_pass']);
		$verfi_pass = xmlentities($_POST['verif_pass']);
		$check = checkPASS($bdd, $old_pass, $_SESSION['id']);
		if ( $check === true )
		{
			if ( $new_pass == $verfi_pass )
			{
				changePASS($bdd, $new_pass, $_SESSION['id']);
				$success = "Mot de passe chang&eacute;.";
			}
			else
			{
				$error = "Les deux mot de passe ne correspondent pas.";
			}
		}
		else
		{
			$error = "Mauvais mot de passe.";
		}
	}
	else
	{
		$error = "Veuillez remplir les tous les champs de la section Mot de passe.";
	}
}

if ( isset($_POST['btn_email']) )
{
	if ( isset($_POST['new_mail']) AND !empty($_POST['new_mail']) )
	{
		$new_mail = xmlentities($_POST['new_mail']);
		if (preg_match("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $new_mail))
			{
				changeMAIL($bdd, $new_mail, $_SESSION['id']);
				$success = "Email chang&eacute;.";
				$userinfo = getUserinfos($bdd, $_SESSION['id']);
			}
		else
			{
				$error = "Email non valide.";
			}
	}
	else
	{
		$error = "Veuillez remplir le champs de la section Email.";
	}
}

if ( isset($_POST['btn_pseudo']) )
{
	if ( isset($_POST['new_pseudo']) AND !empty($_POST['new_pseudo']) )
	{
		$new_pseudo = xmlentities($_POST['new_pseudo']);
		if ( pseudo_dispo($bdd, $new_pseudo) === true )
			{
				$error = "Pseudo d&eacute;j&agrave; prit.";
			}
		else
			{
				changePSEUDO($bdd, $new_pseudo, $_SESSION['id']);
				$userinfo = getUserinfos($bdd, $_SESSION['id']);
				$success = "Pseudo chang&eacute;.";
			}
	}
	else
	{
		$error = "Veuillez remplir le champ de la section Pseudo.";
	}
}

$pseudo = xmldecode($userinfo['pseudo']);
$nom = xmldecode($userinfo['nom']);
$prenom = xmldecode($userinfo['prenom']);
$city = xmldecode($userinfo['city']);
$age = getAge($userinfo['birthdate']);
$email = xmldecode($userinfo['email']);
$sex = $userinfo['sex'];


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
								<td><?php echo $pseudo; ?></td>
							</tr>
							<tr>
								<th>Nom :</th>
								<td><?php echo $nom; ?></td>
							</tr>
							<tr>
								<th>Pr&eacute;nom :</th>
								<td><?php echo $prenom; ?></td>
							</tr>
							<tr>
								<th>Ville :</th>
								<td><?php echo $city; ?></td>
							</tr>
							<tr>
								<th>Age :</th>
								<td><?php echo $age; ?> ans</td>
							</tr>
							<tr>
								<th>Email :</th>
								<td><?php echo $email; ?></td>
							</tr>

</table>
<?php
$tableau = ob_get_clean();
$id_conver = 1;
$list_conv = getCONV($bdd, $_SESSION['id']);

ob_start();
if ( $list_conv != 0 )
{
	foreach ($list_conv as $key => $value)
	{
		?>
		<form action="index.php?page=profil" method="POST">
		<?php
		if( $value['del_conv'] == NULL )
		{
			if ( $value['id_sender'] == $_SESSION['id'] )
			{
				?>
				<button type="button" onclick="switch_conv('conv<?php echo $id_conver; ?>')">Objet : <?php echo $value['titre']; ?></button>
				<div id="conv<?php echo $id_conver; ?>" class="hide">
					<span class="who_conv">Conversation avec <a href="index.php?page=user&amp;id=<?php echo $value['id_receiver']; ?>"><?php echo getNAME($bdd,$value['id_receiver']); ?></span>
					<div class="conv">
						<?php
						$list_msg = getMSG($bdd, $value['id_receiver'], $value['id_sender'], $value['id_conv']);
						foreach ($list_msg as $val)
						{
							if ( $val['id_sender'] == $_SESSION['id'] )
							{
								$c = "own";
							}
							else
							{
								$c = "other";
							}
							?>
							<div class="msg_container">
							<p class="rep<?php echo $c; ?>"><a href="index.php?page=user&amp;id=<?php echo $val['id_sender']; ?>" ><?php echo getNAME($bdd,$val['id_sender']); ?></a> : <?php echo xmldecode($val['content']); ?></p>
							</div>
							
							<?php
						}
						?>
					</div>
					<div class="conv_rep">
							<textarea name="rep"></textarea>
							<input type="hidden" name="id_receiver" value="<?php echo $value['id_receiver']; ?>" >
							<input type="hidden" name="id_parent" value="<?php echo $value['id']; ?>" >
							<input type="hidden" name="id_conv" value="<?php echo $value['id_conv']; ?>" >
							<input type="submit" class="sub" name="btn_rep" value="Envoyer">
							<input type="submit" onclick="return verifsupp()" class="sub" name="quitt_conv" value="Quitter la conversation">
							<input type="hidden" name="n_id_conv" value="<?php echo $value['id_conv'];?>">
					</div>
				</div>
				<?php
			}
			else
			{
				?>
				<button type="button" onclick="switch_conv('conv<?php echo $id_conver; ?>')">Objet : <?php echo $value['titre']; ?></button>
				<div id="conv<?php echo $id_conver; ?>" class="hide">
					<span class="who_conv">Conversation avec <a href="index.php?page=user&amp;id=<?php echo $value['id_sender']; ?>"><?php echo getNAME($bdd,$value['id_sender']); ?></span>
					<div class="conv">
						<?php
						$list_msg = getMSG($bdd, $value['id_receiver'], $value['id_sender'], $value['id_conv']);
						foreach ($list_msg as $val)
						{
							if ( $val['id_sender'] == $_SESSION['id'] )
							{
								$c = "own";
							}
							else
							{
								$c = "other";
							}
							?>
							<div class="msg_container">
							<p class="rep<?php echo $c; ?>"><a href="index.php?page=user&amp;id=<?php echo $val['id_sender']; ?>" ><?php echo getNAME($bdd,$val['id_sender']); ?></a> : <?php echo xmldecode($val['content']); ?></p>
							</div>
							
							<?php
						}
						?>
					</div>
					<div class="conv_rep">
						<textarea name="rep"></textarea>
						<input type="hidden" name="id_receiver" value="<?php echo $value['id_sender']; ?>" >
						<input type="hidden" name="id_parent" value="<?php echo $value['id']; ?>" >
						<input type="hidden" name="id_conv" value="<?php echo $value['id_conv']; ?>" >
						<input type="submit" class="sub" name="btn_rep" value="Envoyer">
						<input type="submit" onclick="return verifsupp()" class="sub" name="quitt_conv" value="Quitter la conversation">
						<input type="hidden" name="n_id_conv" value="<?php echo $value['id_conv'];?>">
					</div>
				</div>
				<?php
			}
		}
		else
		{
			if ( $value['del_conv'] != $_SESSION['id'] )
			{
				if ( $value['id_sender'] == $_SESSION['id'] )
				{
					?>
					<button type="button" onclick="switch_conv('conv<?php echo $id_conver; ?>')">Objet : <?php echo $value['titre']; ?></button>
					<div id="conv<?php echo $id_conver; ?>" class="hide">
						<span class="who_conv">Conversation avec <a href="index.php?page=user&amp;id=<?php echo $value['id_receiver']; ?>"><?php echo getNAME($bdd,$value['id_receiver']); ?></span>
						<div class="conv">
							<?php
							$list_msg = getMSG($bdd, $value['id_receiver'], $value['id_sender'], $value['id_conv']);
							foreach ($list_msg as $val)
							{
								if ( $val['id_sender'] == $_SESSION['id'] )
								{
									$c = "own";
								}
								else
								{
									$c = "other";
								}
								?>
								<div class="msg_container">
								<p class="rep<?php echo $c; ?>"><a href="index.php?page=user&amp;id=<?php echo $val['id_sender']; ?>" ><?php echo getNAME($bdd,$val['id_sender']); ?></a> : <?php echo xmldecode($val['content']); ?></p>
								</div>
								
								<?php
							}
							?>
						</div>
						<div class="conv_rep">
								<p>Votre interlocuteur a quitt&eacute; la conversation</p>
								<input type="submit" class="sub" name="sup_conv" value="Supprimer la conversation">
								<input type="hidden" name="n_id_conv" value="<?php echo $value['id_conv']; ?>">
						</div>
					</div>
					<?php
				}
				else
				{
					?>
					<button type="button" onclick="switch_conv('conv<?php echo $id_conver; ?>')">Objet : <?php echo $value['titre']; ?></button>
					<div id="conv<?php echo $id_conver; ?>" class="hide">
						<span class="who_conv">Conversation avec <a href="index.php?page=user&amp;id=<?php echo $value['id_sender']; ?>"><?php echo getNAME($bdd,$value['id_sender']); ?></span>
						<div class="conv">
							<?php
							$list_msg = getMSG($bdd, $value['id_receiver'], $value['id_sender'], $value['id_conv']);
							foreach ($list_msg as $val)
							{
								if ( $val['id_sender'] == $_SESSION['id'] )
								{
									$c = "own";
								}
								else
								{
									$c = "other";
								}
								?>
								<div class="msg_container">
								<p class="rep<?php echo $c; ?>"><a href="index.php?page=user&amp;id=<?php echo $val['id_sender']; ?>" ><?php echo getNAME($bdd,$val['id_sender']); ?></a> : <?php echo xmldecode($val['content']); ?></p>
								</div>
								
								<?php
							}
							?>
						</div>
						<div class="conv_rep">
								<p>Votre interlocuteur a quitt&eacute; la conversation</p>
								<input type="submit" class="sub" name="sup_conv" value="Supprimer la conversation">
								<input type="hidden" name="n_id_conv" value="<?php echo $value['id_conv']; ?>">
						</div>
					</div>
					<?php
				}
			}
		}
		?>
		</form>
		<?php
		$id_conver++;
	}
}
else
{
	?>
	<div class="noconv">
		<p>Vous n'avez pas de conversation en cours, utilisez la recherche et ouvrez une discussion avec la personne de votre choix.</p>
	</div>
	<?php
}
$conversation = ob_get_clean();

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

require_once "inc/view/profil.php";
?>