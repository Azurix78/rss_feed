<?php
function validation($bdd, $pseudo, $cle)
{
	$req = mysqli_query($bdd, "SELECT actif, cle FROM users WHERE pseudo = \"$pseudo\" ");
	if (!$check = mysqli_fetch_assoc($req) )
	{
		return false;
	}
	if ( $check['cle'] == $cle AND $check['actif'] == 0)
	{
		mysqli_query($bdd, "UPDATE users SET actif = 1 WHERE pseudo = \"$pseudo\" ");
		return true;
	}
	else
	{
		return false;
	}
}


?>