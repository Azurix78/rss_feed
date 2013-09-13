<?php

class connect
{
	
	public function signin()
	{
		$view = new display();
		$view->show('connect');
	}

	public function inscription()
	{
		$verif_form = new verif_form();
		$valid = $verif_form->isFull("inscription");
		if($valid === TRUE)
		{
			$user = new user;
			$name = ucfirst($_POST['pseudo_in']);
			$pass = crypt($_POST['pass_in']);
			$user->register($name, $pass);
			echo $name;
			echo $pass;
		}
		else
		{
			$setError = new setError($valid);
			echo $setError->showError();

			$view = new display();
			$view->show('connect');

		}

	}
	
}

?>