<?php
class flux
{

	public function liste()
	{
		$user =& $_SESSION['id'];
		$flux = new fluxRSS();
		$list_flux=$flux->getFlux($user);
		$link=$flux->getLink($user);
		$view = new display();
		$data[] = array();
		$data['flux'] = $list_flux;
		$data['link'] = $link;
		if(isset($_GET['id']))
		{
			$article=$flux->getItem($_GET['id']);
			$data['article'] = $article;
			$view->show('article',$data);
		}
		else
		{
			$view->show('flux',$data);	
		}	
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
			$flux->add_flux($nom,$adresse,$user,1);
			$list_flux=$flux->getFlux($user);
			$setError = new setError("Flux ajouté.");
			$success = $setError->showSuccess();
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			if(isset($link)){ $data['link'] = $link; }
			$view->show('flux',$data,$success);
		}
		else
		{
			$user =& $_SESSION['id'];
			$setError = new setError($valid);
			$error = $setError->showError();
			$flux = new fluxRSS();
			$list_flux=$flux->getFlux($user);
			$link=$flux->getLink($user);
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			$data['link'] = $link;
			$view->show('flux',$data, $error);
		}

	}

	public function supprimer()
	{
		$verif_form = new verif_form;
		$valid = $verif_form->isFull("del_flux");
		if($valid === TRUE)
		{
			$nom =& $_POST['nom'];
			$user =& $_SESSION['id'];
			$flux = new fluxRSS();
			$flux->delFlux($nom,$user);
			$setError = new setError("Flux supprimé.");
			$success = $setError->showSuccess();
			$list_flux=$flux->getFlux($user);
			$link=$flux->getLink($user);
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			$data['link'] = $link;
			$view->show('flux', $data,$success);
		}
		else
		{
			$setError = new setError($valid);
			$error = $setError->showError();
			$user =& $_SESSION['id'];
			$flux = new fluxRSS();
			$list_flux=$flux->getFlux($user);
			$link=$flux->getLink($user);
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			$data['link'] = $link;
			$view->show('flux',$data,$error);
		}

	}
}
?>