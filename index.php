<?php
session_start();

define('ROOT', "/rss_feed/");

function my_autoloader($class)
{
    if(file_exists('core/controler/'.$class.'.class.php'))
	{
    	require_once('core/controler/' .$class.'.class.php');
    }
    elseif(file_exists('core/model/'.$class.'.class.php'))
    {
    	require_once('core/model/'.$class.'.class.php');
    }
}

spl_autoload_register('my_autoloader');

$controler =& $_GET['c'];
$method =& $_GET['m'];


if(isset($controler))
{
	if(file_exists('core/controler/'.$controler.'.class.php') AND isset($_SESSION['id']) )
	{
		$page = new $controler();

		if(isset($method) AND method_exists($page, $method))
		{
			$page->$method();
		}
		else
		{
			$page = new display();
			$page->show('er404');
		}
	}
	elseif(file_exists('core/controler/'.$controler.'.class.php') AND !isset($_SESSION['id']))
	{
		$page = new connect();
		if(isset($method) AND method_exists($page, $method))
		{
			$page->$method();
		}
		else
		{
			$page->signin();
		}
	}
	else
	{
		$page = new display();
		$page->show('er404');
	}
}
?>