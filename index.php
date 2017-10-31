<?php
 
//Contrôleur frontal : instancie un routeur pour traiter la requête entrante

	require dirname(__FILE__) .'/Framework/Routeur.php';

	// Je crée un objet,  nouveau routeur
	$routeur = new Routeur(); 
	// Je fais appel a la methode routerRequete, du routeur.
	$routeur->routerRequete(); 
?>
