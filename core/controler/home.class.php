<?php

class home
{
	public function accueil()
	{
		$view = new display();
		$view->show('home');	
	}
}
?>