<?php
class db
{
	private $PARAM_hote; // le chemin vers le serveur
	private $PARAM_port;
	private $PARAM_nom_bd; // le nom de votre base de données
	private $PARAM_utilisateur; // nom d'utilisateur pour se connecter
	private $PARAM_mot_passe; // mot de passe de l'utilisateur pour se connecter
	
	public function __construct()
	{
		$this->PARAM_hote='localhost'; // le chemin vers le serveur
		$this->PARAM_port='8888';
		$this->PARAM_nom_bd='rss_feed'; // le nom de votre base de données
		$this->PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
		$this->PARAM_mot_passe='root'; // mot de passe de l'utilisateur pour se connecter
	}

	public function connect()
	{
		try
		{
			return $bdd = new PDO('mysql:host='.$this->PARAM_hote.';dbname='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe);
		} 
		catch(Exception $e)
		{
			echo 'Erreur : '.$e->getMessage().'<br />';
        	echo 'N° : '.$e->getCode();
		}
	}
}
?>