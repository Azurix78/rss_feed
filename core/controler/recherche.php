<?php
require_once 'inc/model/recherche.php';

$allcity = getallcity($bdd);

ob_start();
foreach ($allcity as $key => $value)
{
	?>
	<option><?php echo $value['city']; ?></option>
	<?php
}
$listcity = ob_get_clean();

if ( isset($_POST['btn_recherche_av']) )
{
	if ( isset($_POST['recherche_age']) AND !empty($_POST['recherche_age']) AND $_POST['recherche_age'] != "Choisissez une tranche d'âge")
	{
		$recherche_age = xmlentities($_POST['recherche_age']);
		switch ($recherche_age) :
	        case  "moins de 18 ans":
	        	$datemin=(date("Y")-18) . "-" . date("m") . "-" . date("d");
	        	$recherche_age_sql="WHERE birthdate > '". $datemin ."' ";
	        	break;
	        case  "18-25 ans":
	        	$datemax=(date("Y")-18) . "-" . date("m") . "-" . date("d");
	        	$datemin=(date("Y")-25) . "-" . date("m") . "-" . date("d");
	        	$recherche_age_sql="WHERE birthdate >= '" . $datemin ."' AND birthdate <= '" . $datemax . "'";
	        	break;
	        case  "25-35 ans":
	        	$datemax=(date("Y")-25) . "-" . date("m") . "-" . date("d");
	        	$datemin=(date("Y")-35) . "-" . date("m") . "-" . date("d");
	        	$recherche_age_sql="WHERE birthdate >= '" . $datemin ."' AND birthdate <= '" . $datemax . "'";
	        break;
	        case  "35-50 ans":
	        	$datemax=(date("Y")-35) . "-" . date("m") . "-" . date("d");
	        	$datemin=(date("Y")-50) . "-" . date("m") . "-" . date("d");
	        	$recherche_age_sql="WHERE birthdate >= '" . $datemin ."' AND birthdate <= '" . $datemax . "'";
	        break;
	        case  "plus de 50":
	        	$datemin=(date("Y")-50) . "-" . date("m") . "-" . date("d");
	        	$recherche_age_sql="WHERE birthdate < '" . $datemin ."' ";
		        break;
    	endswitch;       	
	}
	else
	{
		$recherche_age_sql = "WHERE birthdate > 1 ";
	}

	if ( isset($_POST['recherche_ville']) AND !empty($_POST['recherche_ville']) AND $_POST['recherche_ville'] != "Choisissez une ville")
	{
		$recherche_ville = "";
		foreach ($_POST as $key => $value)
		{
			if ( $value == "on" )
			{
				$recherche_ville .= $key . ";";
			}
		}
		$recherche_ville = str_replace("_", " ", $recherche_ville);
		$recherche_ville = explode(";", $recherche_ville);

		$recherche_ville_sql = "";
		foreach ($recherche_ville as $key => $value)
		{
			if ( $value != "" AND $recherche_ville_sql == "" )
			{
				$recherche_ville_sql .= " city ='" . $value . "' ";
			}
			elseif( $value != "" )
			{
				$recherche_ville_sql .= "OR city ='" . $value . "' ";
			}
		}
	}
	else
	{
		$recherche_ville_sql = " 1=1 ";
	}

	if ( isset($_POST['recherche_sex']) AND !empty($_POST['recherche_sex']) AND $_POST['recherche_sex'] != "Choisissez un sexe")
	{
		$recherche_sex = xmlentities($_POST['recherche_sex']);

		switch ($recherche_sex) :
	        case  "Homme":
	        	$recherche_sex_sql=" AND sex = 'm'";
	        	break;
	        case  "Femme":
	        	$recherche_sex_sql=" AND sex = 'w'";
	        	break;
    	endswitch;    
	}
	else
	{
		$recherche_sex_sql="AND 1=1 ";
	}
}

if ( isset($recherche_sex_sql) AND isset($recherche_age_sql) AND isset($recherche_ville_sql) )
{
	$recherche_tri = recherche_advance($bdd, $recherche_age_sql, $recherche_ville_sql, $recherche_sex_sql, $_SESSION['id']);
}
elseif ( isset($_POST['btn_recherche_pseudo']) AND isset($_POST['recherche_pseudo']) )
{
	$pseudo = xmlentities($_POST['recherche_pseudo']);
	if ( isset($_POST['exact']) )
	{
		$recherche_tri = recherche_pseudo($bdd, $pseudo, $_SESSION['id'], "=");
	}
	else
	{
		$recherche_tri = recherche_pseudo($bdd, $pseudo, $_SESSION['id'], "LIKE");
	}
}

if ( isset($recherche_tri) )
{
	if ( $recherche_tri != 0 )
	{
		ob_start();
		?>
		<table id="list_recherche">
			<tr><th>SEXE</th><th>PSEUDO</th><th>NOM</th><th>PRENOM</th><th>AGE</th><th>VILLE</th></tr>
		<?php
		foreach ($recherche_tri as $key => $value)
		{
			?>
			<tr class="ligne" onclick="linkprofil('<?php echo $value['id_user'];?>')">
				<td><?php echo imgSEX($value['sex']); ?></td>
				<td><?php echo $value['pseudo']; ?></td>
				<td><?php echo $value['nom']; ?></td>
				<td><?php echo $value['prenom']; ?></td>
				<td><?php echo getAge($value['birthdate']); ?></td>
				<td><?php echo $value['city']; ?></td>
			</tr>
			<?php
		}
		?>
		</table>	
		<?php
		$list_recherche = ob_get_clean();
	}
	else
	{
		$list_recherche = "<p>Aucun r&eacute;sultat n'a &eacute;t&eacute; trouv&eacute;</p>";
	}
}
else
{
	$list_recherche = "<p>Faites une recherche et trouvez le profil qu'il vous faut !</p>";
}


require_once 'inc/view/recherche.php';
?>