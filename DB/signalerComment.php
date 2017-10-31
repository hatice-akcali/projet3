<?php
	require_once '../Modele/Commentaire.php';

	$id = $_GET['id'];
	$commentaire = new Commentaire();
	$commentaire->signaler($id);

?>
