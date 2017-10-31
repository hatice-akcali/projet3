<?php

require_once 'Configuration.php';
require_once 'Requete.php';
require_once 'Vue.php';

/**
 * Classe abstraite contrôleur. 
 * Fournit des services communs aux classes contrôleurs dérivées.
 * 
 * @author Hatice AKCALI
 */
abstract class Controleur
{
    /** Action à réaliser */
    private $action;

    /** Requête entrante */
    protected $requete;

    /**
     * Définit la requête entrante
     * 
     * @param Requete $requete Requete entrante
     */
    public function setRequete(Requete $requete)
    {
        $this->requete = $requete;
    }

    /**
     * Qui Exécute l'action à réaliser.
     *
     *  On vérifie, qu'il y a bien une méthode, qui porte le nom de l'action, 
     *  qui s'appelle action ou pas.
     * S'il existe, on lance l'action en question, (qui sera exécuter sur la classe enfant *ControlleurAccueil)
     *
     * S'il n'existe pas il lance une exception
     */
    public function executerAction($action)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();  // 
        }
        else {
            $classeControleur = get_class($this);
            throw new Exception("Action '$action' non définie dans la classe $classeControleur");
        }
    }

    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par défaut
     */
    public abstract function index();

    /**
     * GénéreVue va créer une classe Vue, qui remplit un template*
     *
     * Et on récupère la classe controleur
     *
     * @param array $donneesVue Données nécessaires pour la génération de la vue
     * @param string $action Action associée à la vue (permet à un contrôleur de générer une vue pour une action spécifique)
     */
    protected function genererVue($donneesVue = array(), $action = null)
    {
        // Utilisation de l'action actuelle par défaut
        $actionVue = $this->action;
        if ($action != null) {
            // Utilisation de l'action passée en paramètre
            $actionVue = $action;
        }
        // Utilisation du nom du contrôleur actuel
        $classeControleur = get_class($this);
        $controleurVue = str_replace("Controleur", "", $classeControleur);

        // Instanciation et génération de la vue
        $vue = $this->overridableVue($actionVue, $controleurVue);
        // {$Nom} = creer des object du type contenu dans le nom
        // si dans $nom = 'ControlerConexion' et qu'on fait new {$nom}
        // on obtien un objet ColertroleurConnexion
        $this->overrideGenerer($vue, $donneesVue);
    }
    
    // Génération standard surchargeable
    protected function overrideGenerer($vue, $donneesVue){
		$vue->generer($donneesVue);
	}
    
    // Création de la vue surchageable.
    protected function overridableVue($actionVue, $controleurVue){
		return new VueUtilisateur($actionVue, $controleurVue);
	}

    /**
     * Effectue une redirection vers un contrôleur et une action spécifiques
     * 
     * @param string $controleur Contrôleur
     * @param type $action Action Action
     */
    protected function rediriger($controleur, $action = null)
    {
        $racineWeb = Configuration::get("racineWeb", "/");
        // Redirection vers l'URL /racine_site/controleur/action
        header("Location:" . $racineWeb . $controleur . "/" . $action);
    }
    
    protected function redirigerEx($controleur, $action, $id)
    {
        $racineWeb = Configuration::get("racineWeb", "/");
        // Redirection vers l'URL /racine_site/controleur/action
        header("Location:" . $racineWeb . $controleur . "/" . $action ."/" .$id);
    }
    
    public static function redirect($controler , $action = null){
		$racineWeb = Configuration::get("racineWeb", "/");
        // Redirection vers l'URL /racine_site/controleur/action
        header("Location:" . $racineWeb . $controleur . "/" . $action);
	}
}
