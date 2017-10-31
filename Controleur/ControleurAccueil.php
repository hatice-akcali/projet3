<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Billet.php';


// ControleurAccueil hérite de Controleur
class ControleurAccueil extends Controleur {

    private $billet;

	
    //Déclarer le constructeur 
    public function __construct() {
        $this->billet = new Billet();
    }
    
    
    
	
	/**
	* Action index, c'est l'action par défaut
	*
	* On regarde le nombre total de page
	* Par défaut la pagination se met a 1, 
	* Et le nombre total de pages possibles
	*/
	public function index(){	

		$numPage = 1;
		if($this->requete->existeParametre("id")){
			$numPage = $this->requete->getParametre("id"); 
		}		
		$totalPage = $this->billet->getTotalPage();
		if($numPage < 1)
			$numPage = 1;
		if($numPage > $totalPage)
			$numPage = $totalPage;	
		$billets = $this->billet->getBilletsPage($numPage);
		$this->genererVue(
			array_merge(
			array('billets' => $billets),
			array('page' => $numPage),
			array('total' => $totalPage)));
	}
}

