<?php
class flux
{

	public function liste()
	{
		$user =& $_SESSION['id'];
		$flux = new fluxRSS();
		$list_flux=$flux->getFlux($user);
		$view = new display();
		$data[] = array();
		$data['flux'] = $list_flux;
		$view->show('flux',$data);	
	}

	public function add()
	{
		$verif_form = new verif_form;
		$valid = $verif_form->isFull("add_flux");
		if($valid === TRUE)
		{
			$adresse =& $_POST['new_flux'];
			$nom =& $_POST['nom'];
			$user =& $_SESSION['id'];


			$flux = new fluxRSS();
			$flux->add_flux($nom,$adresse,$user);
			$list_flux=$flux->getFlux($user);
			$setError = new setError("Flux ajouté.");
			$success = $setError->showSuccess();
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			$view->show('flux',$data,$success);
		}
		else
		{
			$user =& $_SESSION['id'];
			$setError = new setError($valid);
			$error = $setError->showError();
			$flux = new fluxRSS();
			$list_flux=$flux->getFlux($user);
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			$view->show('flux',$data, $error);
		}

	}

	public function supprimer()
	{
		$verif_form = new verif_form;
		$valid = $verif_form->isFull("add_flux");
		if($valid === TRUE)
		{
			$adresse =& $_POST['new_flux'];
			$nom =& $_POST['nom'];
			$user =& $_SESSION['id'];


			$flux = new fluxRSS();
			$flux->add_flux($nom,$adresse,$user);
			$setError = new setError("Flux ajouté.");
			$success = $setError->showSuccess();
			$view = new display();
			$view->show('flux',$success);
		}
		else
		{
			$setError = new setError($valid);
			$error = $setError->showError();

			$view = new display();
			$view->show('flux',$error);
		}

	}
}
?>