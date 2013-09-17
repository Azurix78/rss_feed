<?php
class gestion
{
	public function edit()
	{
		$view = new display();
		$view->show('gestion');	
	}

	public function pass()
	{
		$verif_form = new verif_form;
		$valid = $verif_form->isFull("pass");
		if($valid === TRUE)
		{
			$old =& $_POST['oldpass_edit'];
			$new =& $_POST['newpass_edit'];

			$user = new user;
			$valid = $user->checkpass($old, $_SESSION['id']);
			if($valid === TRUE)
			{
				$user->changepass(crypt($new),$_SESSION['id']);
				$setError = new setError("Mot de passe changé.");
				$success = $setError->showSuccess();
				$view = new display();
				$view->show('gestion',$success);
			}
			else
			{
				$setError = new setError($valid);
				$error = $setError->showError();
				$view = new display();
				$view->show('gestion',$error);
			}
		}
		else
		{
			$setError = new setError($valid);
			$error = $setError->showError();

			$view = new display();
			$view->show('gestion',$error);
		}

	}

	public function pseudo()
	{
		$verif_form = new verif_form;
		$valid = $verif_form->isFull("pseudo");
		if($valid === TRUE)
		{
			$new = ucfirst($_POST['pseudo_edit']);
			$user = new user;
			$user->changePseudo($new,$_SESSION['id']);
			$_SESSION['pseudo']=$new;
			$setError = new setError("Pseudo changé.");
			$success = $setError->showSuccess();
			$view = new display();
			$view->show('gestion',$success);

		}
		else
		{
			$setError = new setError($valid);
			$error = $setError->showError();
			$view = new display();
			$view->show('gestion',$error);
		}

	}
}
?>