<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';

/**
 * Contrôleur des actions liées aux billets
 *
 */
class ControleurBillet extends Controleur {

    private $billet;
    private $commentaire;

    /**
     * Constructeur 
     */
    public function __construct() {
        $this->billet = new Billet();
        $this->commentaire = new Commentaire();
    }

   

    // Affiche les détails sur un billet
    // voir le billet
    public function index() {
        //Cherche le paramètre id dans la requete
        $idBillet = $this->requete->getParametre("id");       
        $billet = $this->billet->getBillet($idBillet);
        $commentaires = $this->commentaire->getCommentaires($idBillet);      
        $this->genererVue(array('billet' => $billet, 'commentaires' => $commentaires));
    }
    
    

    // Ajoute un commentaire sur un billet
    public function commenter() {
        $idBillet = $this->requete->getParametre("id");
        $auteur = $this->requete->getParametre("auteur");
        $contenu = $this->requete->getParametre("contenu");     
        $this->commentaire->ajouterCommentaire($auteur, $contenu, $idBillet);    
        //$this->executerAction("index");
        $this->redirigerEx("billet", "index", $idBillet );
    }

  
}

