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
		return "<div class='alert-error'>Erreur : ".$this->error."</div>";
	}
}
?>