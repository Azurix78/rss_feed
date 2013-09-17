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
			$pseudo =& $_POST['pseudo_in'];
			$pseudo = ucfirst($pseudo);
			$pass =& $_POST['pass_in'];
			$pass = crypt($pass);
			$user = new user;
			$user->register($pseudo, $pass);
			$user->login($pseudo,$pass);

			header("location:".ROOT);

		}
		else
		{
			$setError = new setError($valid);
			$error = $setError->showError();

			$view = new display();
			$view->show('connect',$error);

		}

	}

	public function login()
	{
		$verif_form = new verif_form();
		$valid = $verif_form->isFull("login");
		if($valid === TRUE)
		{
			$pseudo =& $_POST['pseudo_log'];
			$pseudo = ucfirst($pseudo);
			$pass =& $_POST['pass_log'];

			$user = new user;
			$login = $user->login($pseudo, $pass);
			if($login === TRUE)
			{
				header('Location:'.ROOT);
			}
			else
			{
				$setError = new setError($login);
				$error = $setError->showError();
				$view = new display();
				$view->show('connect',$error);
			}
		}
		else
		{
			$setError = new setError($valid);
			$error = $setError->showError();
			$view = new display();
			$view->show('connect',$error);
		}
	}
	
}

?>