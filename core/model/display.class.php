<?php

class display
{

	public function show($view, $error=NULL)
	{
		if($view != 'connect')
		{
			require_once('core/view/header.php');
			echo $error;
			require_once('core/view/' . $view . '.php');
			require_once('core/view/footer.php');
		}
		else
		{
			echo $error;
			require_once('core/view/' . $view . '.php');
		}
	}
}




?>