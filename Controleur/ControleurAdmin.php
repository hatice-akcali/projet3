<?php

require_once 'ControleurSecurise.php';
require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';

/**
 * Contrôleur des actions d'administration
 * ControleurAdmin hérite de ControleurSecurise
 */
class ControleurAdmin extends ControleurSecurise
{
    private $billet;
    private $commentaire;
    private $mode = 0;

    /**
     * Constructeur 
     */
    public function __construct()
    {
        $this->billet = new Billet();
        $this->commentaire = new Commentaire();
    }

    public function index()
    {
        $nbBillets = $this->billet->getNombreBillets();
        $nbCommentaires = $this->commentaire->getNombreCommentaires();
        $login = $this->requete->getSession()->getAttribut("login");
        $this->genererVue(array('nbBillets' => $nbBillets, 'nbCommentaires' => $nbCommentaires, 'login' => $login));
    }
    
    
    // Surchage destiné a changer la vue utilisateur en vue administrateur pour ce controleur
	public function overridableVue($actionVue, $controleurVue){
		return new VueAdmin($actionVue, $controleurVue);
	}
	
	// Surcharge destinée a changer la génération de la vue dans le cas d'un mode particulier'
	protected function overrideGenerer($vue, $donneesVue){
	 	if($this->mode == 0){
			$vue->generer($donneesVue);
		}
		else{
			$vue->genererNew($donneesVue);
		}
	}
    	
	public function aNew(){		  
		$this->mode = 1;
        $this->genererVue();
        $this->mode = 0;
	}
	
	public function aList(){
		$this->mode = 1;
		$billets = $this->billet->getBillets();
        $this->genererVue(array('billets' => $billets));
        $this->mode = 0;
	}
	
	public function aComment(){
		$this->mode = 1;
		$commentaires = $this->commentaire->getCommentairesSignale();
        $this->genererVue(array('commentaires' => $commentaires));
        $this->mode = 0;
	}
	
	public function aEdit(){
		$this->mode = 1;	
		$id = -1;
		if($this->requete->existeParametre("id")){
			$id = $this->requete->getParametre("id"); 
		}
		$billet = $this->billet->getBillet($id);
        $this->genererVue(array('billet' => $billet));
        $this->mode = 0;
	}
	
}

