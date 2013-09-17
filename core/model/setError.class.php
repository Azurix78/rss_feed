<?php
class setError
{
	private $error;

	public function __construct($error)
	{
		$this->error = $error;
	}
	public function showError()
	{
		return "<div id='alert' onclick='closealert()' class='alert-error'>Erreur : ".$this->error."</div>";
	}

	public function showSuccess()
	{
		return "<div id='alert' onclick='closealert()' class='alert-success'>Succès : ".$this->error."</div>";
	}
}
?>