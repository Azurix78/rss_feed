<?php
class home
{
	public function lire()
	{
		$obj = new frontcontrol();
		$obj->display('home');
	}
}
?>