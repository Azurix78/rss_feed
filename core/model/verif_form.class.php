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
					return "Pseudo déjà prit.";
				}
			}
			else
			{
				return "Veuillez remplir tous les champs.";
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
}
?>