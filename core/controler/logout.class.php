<?php
class logout
{
	public function deco()
	{
		session_destroy();
		header('Location:'.ROOT);
	}
}
?>