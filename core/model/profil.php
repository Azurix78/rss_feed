<?php

function checkPASS($bdd, $pass, $id_user)
{
	$req = mysqli_query($bdd, "SELECT mdp FROM users WHERE id_user = $id_user ");
		$check = mysqli_fetch_assoc($req);
		if ( $check['mdp'] == crypt($pass, $check['mdp']) )
		{
			return true;
		}
		else
		{
			return false;
		}
}

function changePASS($bdd, $pass, $id_user)
{
	$pass = crypt($pass);
	$req = mysqli_query($bdd, "UPDATE users SET mdp = \"$pass\" WHERE id_user = $id_user");
}

function changeMAIL($bdd, $mail, $id_user)
{
	$req = mysqli_query($bdd, "UPDATE users SET email = \"$mail\" WHERE id_user = $id_user");
}

function changePSEUDO($bdd, $pseudo, $id_user)
{
	$req = mysqli_query($bdd, "UPDATE users SET pseudo = \"$pseudo\" WHERE id_user = $id_user");
}

function getCONV($bdd, $id)
{
	$req = mysqli_query($bdd, "SELECT * FROM message WHERE (id_sender = $id OR id_receiver = $id) AND id_parent IS NULL");
		if ( $req != false )
		{
			if ( mysqli_num_rows($req) > 0 )
			{
				while ( $donnee = mysqli_fetch_assoc($req) )
				{
					$list[] = $donnee;
				}
				return $list;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
}


function getMSG($bdd, $id1, $id2, $id_conv)
{
	$req = mysqli_query($bdd, "SELECT * FROM message WHERE (id_sender = $id1 OR id_receiver = $id1) AND (id_sender = $id2 OR id_receiver = $id2) AND id_conv = $id_conv ORDER BY `date` ASC ");
		if ( $req != false )
		{
			if ( mysqli_num_rows($req) > 0 )
			{
				while ( $donnee = mysqli_fetch_assoc($req) )
				{
					$list[] = $donnee;
				}
				return $list;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
}


function sendMSG($bdd, $id_parent, $content, $id_sender, $id_receiver, $id_conv)
{
	$req = mysqli_query($bdd, "INSERT INTO message(id_parent, id_sender, id_receiver, content, date, id_conv ) VALUES ( $id_parent, $id_sender, $id_receiver, \"$content\", NOW(), $id_conv )" );
}

function quitCONV($bdd, $id, $id_conv)
{
	$req = mysqli_query($bdd, "UPDATE message SET del_conv = $id WHERE id_conv = $id_conv " );
}

function delCONV($bdd, $id_conv)
{
	$req = mysqli_query($bdd, "DELETE FROM message WHERE id_conv = $id_conv " );
}

?>