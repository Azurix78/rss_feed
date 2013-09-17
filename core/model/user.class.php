<?php
class user
{
	private $db;

	public function __construct()
	{
		$this->db = new db;
	}

	public function register($pseudo, $pass)
	{
		$req = $this->db->connect()->prepare("INSERT INTO membre (pseudo, password) VALUES (?,?)");
		$req->bindParam(1, $pseudo, PDO::PARAM_STR);
		$req->bindParam(2, $pass, PDO::PARAM_STR);
		$req->execute();
	}

	public function login($pseudo, $pass)
	{
		$req = $this->db->connect()->prepare("SELECT * FROM membre WHERE pseudo = ?");
		$req->bindParam(1, $pseudo, PDO::PARAM_STR);
		$req->execute();
		$req->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
		$login=$req->fetch();

		if($login!=FALSE)
		{
			if($login->pseudo == $pseudo)
			{
				if($login->password == crypt($pass, $login->password))
				{
					$_SESSION['id'] = $login->id;
					$_SESSION['pseudo'] = $login->pseudo;
					return TRUE;
				}
				else
				{
					return "Mauvais login.";
				}
			}
			else
			{
				return "Mauvais login.";
			}
		}
		else
		{
			return "Mauvais login";
		}
	}

	public function checkpass($pass, $id)
	{
		$req = $this->db->connect()->prepare("SELECT password FROM membre WHERE id = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
		$req->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
		$pwd=$req->fetch();

		if($pwd->password == crypt($pass, $pwd->password))
		{
			return TRUE;
		}
		else
		{
			return "Mauvais mot de passe.";
		}
	}

	public function changepass($new, $id)
	{
		$req = $this->db->connect()->prepare("UPDATE membre SET password = ? WHERE id = ?");
		$req->bindParam(1, $new, PDO::PARAM_STR);
		$req->bindParam(2, $id, PDO::PARAM_INT);
		$req->execute();
	}

	public function changePseudo($new, $id)
	{
		$req = $this->db->connect()->prepare("UPDATE membre SET pseudo = ? WHERE id = ?");
		$req->bindParam(1, $new, PDO::PARAM_STR);
		$req->bindParam(2, $id, PDO::PARAM_INT);
		$req->execute();
	}
}
?>