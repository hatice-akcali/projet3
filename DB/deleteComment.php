<?php
	require_once '../Modele/Commentaire.php';


try{
	$id = $_GET['id'];
	$commentaire = new Commentaire();
	$commentaire->supprimer($id);
	echo 'OK';
	
}catch(Exception $e){
	echo 'NOOK';
}
?>
