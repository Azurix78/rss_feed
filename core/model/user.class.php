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
		$req->bindParam(1, $pseudo);
		$req->bindParam(2, $pass);
		$req->execute();
	}

	public function edit()
	{

	}

	public function login($pseudo, $pass)
	{
		$req = $this->db->connect()->prepare("SELECT * FROM membre WHERE pseudo = ?");
		$req->bindParam(1, $pseudo);
		$req->execute();
		$res->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
		$login=$req->fetch();

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
				return "Mauvais login."
			}
		}
		else
		{
			return "Mauvais login.";
		}

	}
}
?>