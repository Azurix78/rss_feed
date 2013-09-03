<?php
function getallcity($bdd)
{
	$req = mysqli_query($bdd, "SELECT DISTINCT city FROM users");
	if (mysqli_num_rows($req) > 0 )
	{
		while ( $city = mysqli_fetch_assoc($req) )
		{
			$allcity[] = $city;
		}
	}
	return $allcity;
}

function recherche_advance($bdd, $req0, $req1, $req2 ,$id)
{
	$req = mysqli_query($bdd, "SELECT * FROM users $req0 AND ($req1) $req2 AND id_user != $id");
	if ( $req != false )
	{
		while ( $donnee = mysqli_fetch_assoc($req))
		{
			$recherche[] = $donnee;
		}
		if ( isset($recherche) )
		{
			return $recherche;	
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

function recherche_pseudo($bdd, $pseudo, $id, $type)
{
	if ( $type == "=")
	{
		$req = mysqli_query($bdd, "SELECT * FROM users WHERE pseudo ".$type." '$pseudo' AND id_user != $id");
	}
	elseif ($type == "LIKE")
	{
		$req = mysqli_query($bdd, "SELECT * FROM users WHERE pseudo ".$type." \"%$pseudo%\" AND id_user != $id");
	}
	if ( $req != false )
	{
		while ( $donnee = mysqli_fetch_assoc($req))
		{
			$recherche[] = $donnee;
		}
		if ( isset($recherche) )
		{
			return $recherche;	
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

?>