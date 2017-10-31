<?php
require_once '../Modele/Billet.php';

	$id = $_GET['id'];
	$billet = new Billet();
	$billet->retirerBillet($id);
?>