<?php 


	try
	{
         # $pdo_options=[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=bd_blog_connect','root',''/*,$pdo_options*/,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
		 die('Erreur : '.$e->getMessage());
	}
	return $bdd;


 ?>
