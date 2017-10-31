<?php
require_once '../Modele/Billet.php';

try{
	$id = $_GET['id'];
	$billet = new Billet();
	$billet->supprimerBillet($id);
	echo 'OK';
	
}catch(Exception $e){
	echo 'NOOK';
}
		
?>