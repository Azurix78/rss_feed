<?php

class home
{
	public function view()
	{
		require_once('core/model/display.class.php');
		$view = new display();
		$view->show('home');	
	}
}
?>