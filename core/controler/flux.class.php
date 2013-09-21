<?php
class flux
{

	public function liste()
	{
		$user =& $_SESSION['id'];
		$flux = new fluxRSS();
		$view = new display();
		$data[] = array();
		if(isset($_GET['id']))
		{
			$flux->setOld($_GET['id']);
			$list_flux=$flux->getFlux($user);
			$link=$flux->getLink($user);
			$article=$flux->getItem($_GET['id']);
			$data['flux'] = $list_flux;

			if(isset($link))
			{
				$data['link'] = $link;
				foreach ($data['link'] as $value)
				{
					$flux->isHot($value['adresse'],$value['id']);
				}
			}
			
			$data['article'] = $article;
			$view->show('article',$data);
			$flux->setOld($_GET['id']);
		}
		else
		{
			$list_flux=$flux->getFlux($user);
			$link=$flux->getLink($user);
			if(isset($link))
			{
				$data['link'] = $link;
				foreach ($data['link'] as $value)
				{
					$flux->isHot($value['adresse'],$value['id']);
				}
			}
			$data['flux'] = $list_flux;
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
			$link=$flux->getLink($user);
			$setError = new setError("Flux ajouté.");
			$success = $setError->showSuccess();
			$view = new display();
			$data[] = array();
			$data['flux'] = $list_flux;
			if(isset($link))
			{
				$data['link'] = $link;
				foreach ($data['link'] as $value)
				{
					$flux->isHot($value['adresse'],$value['id']);
				}
			}
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
			if(isset($link))
			{
				$data['link'] = $link;
				foreach ($data['link'] as $value)
				{
					$flux->isHot($value['adresse'],$value['id']);
				}
			}
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
			if(isset($link))
			{
				$data['link'] = $link;
				foreach ($data['link'] as $value)
				{
					$flux->isHot($value['adresse'],$value['id']);
				}
			}
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
			if(isset($link))
			{
				$data['link'] = $link;
				foreach ($data['link'] as $value)
				{
					$flux->isHot($value['adresse'],$value['id']);
				}
			}
			$view->show('flux',$data,$error);
		}

	}
}
?>