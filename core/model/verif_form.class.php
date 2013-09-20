<?php
class verif_form
{
	private $db;

	public function __construct()
	{
		$this->db = new db;
	}

	public function isFull($category)
	{
		if($category == "inscription")
		{
			if(isset($_POST['pseudo_in']) AND !empty($_POST['pseudo_in']) AND isset($_POST['pass_in']) AND !empty($_POST['pass_in']) )
			{
				if($this->isDispo($_POST['pseudo_in'])===TRUE)
				{
					if(strlen($_POST['pass_in'])>=6)
					{
						return TRUE;
					}
					else
					{
						return "Mot de passe trop court.";
					}
				}
				else
				{
					return "Pseudo déjà utilisé.";
				}
			}
			else
			{
				return "Veuillez remplir tous les champs.";
			}
		}
		elseif($category == "login")
		{
			if(isset($_POST['pseudo_log']) AND !empty($_POST['pseudo_log']) AND isset($_POST['pass_log']) AND !empty($_POST['pass_log']))
			{
				if(strlen($_POST['pass_log'])>=6)
				{
					return TRUE;
				}
				else
				{
					return "Mauvais login.";
				}
			}
			else
			{
				return "Veuillez remplir tous les champs";
			}
		}
		elseif($category == "pass")
		{
			if(isset($_POST['oldpass_edit']) AND isset($_POST['newpass_edit']) AND !empty($_POST['oldpass_edit']) AND !empty($_POST['newpass_edit']))
			{
				if(strlen($_POST['newpass_edit'])>=6)
				{
					return TRUE;
				}
				else
				{
					return "Le mot de passe doit faire au moins 6 charactères.";
				}
			}
			else
			{
				return "Veuillez remplir tous les champs de la catégorie Mot de passe.";
			}
		}
		elseif ($category == "pseudo")
		{
			if(isset($_POST['pseudo_edit']) AND !empty($_POST['pseudo_edit']))
			{
				if($this->isDispo($_POST['pseudo_edit'])===TRUE)
				{
					return TRUE;
				}
				else
				{
					return "Pseudo déjà utilisé.";
				}
					
			}
			else
			{
				return "Veuillez remplir tous les champs de la catégorie Pseudo.";
			}
		}
		elseif ($category == "add_flux")
		{
			if(isset($_POST['new_flux']) AND !empty($_POST['new_flux']) AND isset($_POST['nom']) AND !empty($_POST['nom']))
			{
				if($this->exist_flux("nom",$_POST['nom'],$_SESSION['id']) === FALSE)
				{
					if(@simplexml_load_file($_POST['new_flux'])!=FALSE)
					{
						return TRUE;
					}
					else
					{
						return "Lien invalide";
					}
				}
				else
				{
					return "Vous avez déjà un flux qui porte ce nom.";
				}
				
			}
			else
			{
				return "Veuillez remplir tous les champs de la catégorie Ajouter un flux.";
			}
		}
		elseif ($category == "del_flux")
		{
			if(isset($_POST['nom']) AND !empty($_POST['nom']))
			{
				if($this->exist_flux("nom",$_POST['nom'],$_SESSION['id']) === TRUE)
				{
					return TRUE;
				}
				else
				{
					return "Ce flux n'existe pas.";
				}
			}
			else
			{
				return "Veuillez remplir tous les champs de la catégorie Ajouter un flux.";
			}
		}
	}

	public function isDispo($pseudo)
	{
		$res=$this->db->connect()->query("SELECT pseudo FROM membre");
		$res->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
		while ($membre = $res->fetch())
		{
			$all_pseudo[] = $membre->pseudo;
		}

		if(isset($all_pseudo))
		{
			foreach ($all_pseudo as $value)
			{
				if($value == ucfirst($pseudo))
				{
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	public function exist_flux($champ,$var,$id)
	{
		$req=$this->db->connect()->prepare("SELECT ? FROM flux WHERE $champ = ? AND id_user = ?");
		$req->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
		$req->bindParam(1, $champ, PDO::PARAM_STR);
		$req->bindParam(2, $var, PDO::PARAM_STR);
		$req->bindParam(3, $id, PDO::PARAM_INT);
		$req->execute();
		$req->setFetchMode(PDO::FETCH_OBJ);
		$flux = $req->fetch();
		if($flux!=FALSE)
		{
			return TRUE;
		}
		return FALSE;
	}
}
?>