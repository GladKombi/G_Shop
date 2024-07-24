<?php
	#Demarer la session
	session_start();
	try {
		$connexion=new PDO('mysql:dbname=g_shop; host=localhost', 'root', '');
	} catch (Exception $e) {
		print $e->getMessage();
	}
