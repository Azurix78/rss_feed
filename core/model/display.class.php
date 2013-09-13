<?php

class display
{

	public function show($view)
	{
		if($view != 'connect')
		{
			require_once('core/view/header.php');
			if(isset($error))
			{
				echo $error;
			}
			require_once('core/view/' . $view . '.php');
			require_once('core/view/footer.php');
		}
		else
		{
			require_once('core/view/' . $view . '.php');
		}
	}
}




?>