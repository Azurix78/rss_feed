<?php
class fluxRSS
{
	private $db;

	public function __construct()
	{
		$this->db = new db;
	}

	public function add_flux($nom, $adresse, $id_user, $new)
	{
		$req = $this->db->connect()->prepare("INSERT INTO flux (nom, adresse, id_user) VALUES (?,?,?)");
		$req->bindParam(1, $nom, PDO::PARAM_STR);
		$req->bindParam(2, $adresse, PDO::PARAM_STR);
		$req->bindParam(3, $id_user, PDO::PARAM_INT);
		$req->execute();
	}

	public function getFlux($id)
	{
		$req = $this->db->connect()->prepare("SELECT nom FROM flux WHERE id_user = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
		if($req!=FALSE)
		{
			while($flux = $req->fetch())
			{
				$data[] = $flux['nom'];
			}
			if(isset($data))
			{
				return $data;
			}
			else
			{
				return " ";
			}
		}
		else
		{
			return " ";
		}
	}

	public function getItem($id)
	{
		$req = $this->db->connect()->prepare("SELECT adresse FROM flux WHERE id = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
		if($req!=FALSE)
		{
			$flux = $req->fetch();
			$xml = simplexml_load_file($flux['adresse']);
			return $xml;
		}
	}

	public function getAdresse($id)
	{
		$req = $this->db->connect()->prepare("SELECT adresse FROM flux WHERE id = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
		if($req!=FALSE)
		{
			$flux = $req->fetch();
			return $flux['adresse'];
		}
	}

	public function delFlux($nom,$id_user)
	{
		$req = $this->db->connect()->prepare("DELETE FROM flux WHERE nom = ? AND id_user = ?");
		$req->bindParam(1, $nom, PDO::PARAM_STR);
		$req->bindParam(2, $id_user, PDO::PARAM_INT);
		$req->execute();
	}

	public function getLink($id_user)
	{
		$req = $this->db->connect()->prepare("SELECT * FROM flux WHERE id_user = ?");
		$req->bindParam(1, $id_user, PDO::PARAM_INT);
		$req->execute();
		if($req!=FALSE)
		{
			while($flux = $req->fetch())
			{
				$data[] = $flux;
			}
			if(isset($data))
			{
				return $data;
			}
			else
			{
				return;
			}
		}
		else
		{
			return;
		}
	}

	public function setOld($id)
	{
		$req = $this->db->connect()->prepare("UPDATE flux SET new = 0, hot = 0 WHERE id = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
	}

	public function isHot($adresse, $id)
	{
		$req = $this->db->connect()->prepare("SELECT last_msg FROM flux WHERE id = ?");
		$req->bindParam(1, $id, PDO::PARAM_INT);
		$req->execute();
		$flux = $req->fetch();
		$ch = curl_init($adresse);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    	curl_setopt($ch, CURLOPT_HEADER, TRUE);
    	curl_setopt($ch, CURLOPT_NOBODY, TRUE);
    	$data = curl_exec($ch);
    	$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    	curl_close($ch);

     	if($size!=$flux['last_msg'])
		{
			$req = $this->db->connect()->prepare("UPDATE flux SET hot = 1, last_msg = ? WHERE id = ?");
			$req->bindParam(1, $size, PDO::PARAM_INT);
			$req->bindParam(2, $id, PDO::PARAM_INT);
			$req->execute();
		}
		
	}
}

?>