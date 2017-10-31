<?php
//echo 'update du billet <br>';
if(isset($_POST["titre"])){
	$id = $_POST["id"];
	$titre = $_POST["titre"];
	echo 'ID = ' . $id . '<br>';
	echo 'TITRE = ' . $titre . '<br>';
	if(strlen($titre) != 0){
		$content = $_POST["contenu"];	 
		$online = 0;
		if(isset($_POST["online"])){
			//$online = $_POST["online"];
			$online = 1;
		}
		echo 'CONTENT = ' . $content . '<br>';
		echo 'ONLINE = ' . $online . '<br>';
		echo 'executer <br>';
		require_once '../Modele/Billet.php';

		$billet = new Billet();
		$billet->modifierBillet($id, $titre, $content, $online);
		
	}else{
		//echo 'annuler';
	}
}
// redicrection
header("Location:http://localhost/monblog/admin/alist");

?>