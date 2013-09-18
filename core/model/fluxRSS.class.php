<?php
class fluxRSS
{
	private $db;

	public function __construct()
	{
		$this->db = new db;
	}

	public function add_flux($nom, $adresse, $id_user)
	{
		$req = $this->db->connect()->prepare("INSERT INTO flux (nom, adresse, id_user) VALUES (?,?,?)");
		$req->bindParam(1, $nom, PDO::PARAM_STR);
		$req->bindParam(2, $adresse, PDO::PARAM_STR);
		$req->bindParam(3, $id_user, PDO::PARAM_INT);
		$req->execute();
	}

	public function getFlux($id)
	{
		$req = $this->db->connect()->prepare("SELECT * FROM flux WHERE id_user = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
		$req->setFetchMode(PDO::FETCH_OBJ);
		$flux = $req->fetch();
		if($flux!=FALSE)
		{
			while($flux = $req->fetch())
			{
				$data[] = $flux->nom;
			}
			return $data;
		}
		else
		{
			return " ";
		}
	}
}

?>