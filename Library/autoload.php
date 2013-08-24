<?php
	function autoload($classname)
	{
		$classname = '../' . str_replace('\\', '/', $classname) . '.class.php';

		if(file_exists($classname))
		{
			require $classname;
		}
	}

	spl_autoload_register('autoload');