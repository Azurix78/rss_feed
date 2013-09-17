<?php

class setSession
{
	public function setSession($pseudo, $id=NULL)
	{
		$_SESSION['pseudo']=$pseudo;
		if(isset($id)){$_SESSION['id']=$id;}
	}
}

?>