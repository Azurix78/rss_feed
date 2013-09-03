<?php

class frontcontrol
{

	public function controler_selecter()
	{
		if(isset($_GET['c']))
		{
			if(file_exists('core/controler/' . $_GET['c'] . '.class.php'))
			{
				require_once('core/controler/' . $_GET['c'] . '.class.php');
				$page = new $_GET['c']();
				if(isset($_GET['m']) AND method_exists($page, $_GET['m']))
				{
					$page->$_GET['m']();
				}
				else
				{
					$page->lire();
				}
			}
			else
			{
				$this->display('er404');
			}
		}
		else
		{
			require_once('core/controler/home.class.php');
			$page = new home();
			$page->lire();
		}
	}

	public function display($view)
	{
		require_once('core/view/header.php');
		require_once('core/view/' . $view . '.php');
		require_once('core/view/footer.php');
	}
}

$init = new frontcontrol();
$init->controler_selecter();

?>