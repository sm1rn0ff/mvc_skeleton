<?php
	namespace Library;

	class PDOFactory
	{
		public static function getMySqlConnexion()
		{
			try
			{		
					$db = new \PDO('mysql:host=localhost;dbname=test', 'root', '');
					$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
					
					return $db;
			}
			catch(\Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
		}
	}
