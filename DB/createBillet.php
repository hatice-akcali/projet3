<?php
//echo 'creation du billet <br>';
if(isset($_POST["titre"])){
	$titre = $_POST["titre"];
	if(strlen($titre) != 0){
		$content = $_POST["contenu"];	 
		$online = 0;
		if(isset($_POST["online"])){
			$online = 1;
		}
		
		
		require_once '../Modele/Billet.php';

		$billet = new Billet();
		$billet->creerBillet($titre, $content, $online);
		
	}else{
		//echo 'annuler';
	}
}

// redicrection
header("Location:http://localhost/monblog/admin/alist");

?>