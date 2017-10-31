<?php

require_once 'Configuration.php';

/**
 * Classe modélisant une vue.
 */
class Vue
{
    /** Nom du fichier associé à la vue */
    protected $fichier;

    /** Titre de la vue (défini dans le fichier vue) */
    protected $titre;
    

    /**
     * Constructeur
     * 
     * @param string $action Action à laquelle la vue est associée
     * @param string $controleur Nom du contrôleur auquel la vue est associée
     * Détermination du nom du fichier vue à partir de l'action et du constructeur
     */
    public function __construct($action, $controleur = "")
    {
        $fichier = "Vue/";
        if ($controleur != "") {
            $fichier = $fichier . $controleur . "/";
        }
        $this->fichier = $fichier . $action . ".php";
    }
    
    
    

    /**
     * Génère et affiche la vue
     * 
     * @param array $donnees Données nécessaires à la génération de la vue
     */
    public function generer($donnees)
    {
        echo "Pas de vue definie";
    }




    /**
     * Génère un fichier vue et renvoie le résultat produit
     * 
     * @param string $fichier Chemin du fichier vue à générer
     * @param array $donnees Données nécessaires à la génération de la vue
     * @return string Résultat de la génération de la vue
     * @throws Exception Si le fichier vue est introuvable
     */
    protected function genererFichier($fichier, $donnees)
    {
        if (file_exists($fichier)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            if($donnees != null)
            	extract($donnees);         
            ob_start();	// Démarrage de la temporisation de sortie        
            require $fichier;	  // Inclut le fichier vue          
            return ob_get_clean();	// Arrêt de la temporisation et renvoi du tampon de sortie
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }
    
    
    
    

    /**
     * Nettoie une valeur insérée dans une page HTML
     * Doit être utilisée à chaque insertion de données dynamique dans une vue
     * Permet d'éviter les problèmes d'exécution de code indésirable (XSS) dans les vues générées
     * 
     * @param string $valeur Valeur à nettoyer
     * @return string Valeur nettoyée
     * E2viter les injections de codes, faille xss
     * Convertit les caractères spéciaux en entités HTML
     */
    protected  function nettoyer($valeur)
    {
        return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
    }
    
    
    
    

    /** Renvoie la date au format Français
    * Elle fait automatiquement le nettoyage de cette date
    *
    * @param datetime $date date à convertir
    * @return string date converti
    */
    private function dateToFrenchFormated($date)
    {  
        return $this->nettoyer(Vue::dateToFrench($date));
    }

    private static function dateToFrench($date){
        return date("d/m/Y H:i:s", strtotime($date));
    }

}




class VueUtilisateur extends Vue
{
    
    public function generer($donnees)
    {
        // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // On définit une variable locale accessible par la vue pour la racine Web
        // Il s'agit du chemin vers le site sur le serveur Web
        // Nécessaire pour les URI de type controleur/action/id
        $racineWeb = Configuration::get("racineWeb", "/");
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('Vue/gabarit.php',
                array('titre' => $this->titre, 'contenu' => $contenu, 'racineWeb' => $racineWeb));
        // Renvoi de la vue générée au navigateur
        echo $vue;
    }
}

class VueAdmin extends Vue{
    
    public function generer($donnees)
    {
        // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // On définit une variable locale accessible par la vue pour la racine Web
        // Il s'agit du chemin vers le site sur le serveur Web
        // Nécessaire pour les URI de type controleur/action/id
        $racineWeb = Configuration::get("racineWeb", "/");
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('Vue/admin.php',
                array('titre' => $this->titre, 'contenu' => $contenu, 'racineWeb' => $racineWeb));
        // Renvoi de la vue générée au navigateur
        echo $vue;
    }
    
    
    
    
    
    public function genererNew($donnees = array()){
    	$contenu = $this->genererFichier($this->fichier, $donnees);    	
    	$racineWeb = Configuration::get("racineWeb", "/");    	
    	$vue = $this->genererFichier('Vue/admin.php',
        	array('titre' => $this->titre, 
        	'contenu' => $contenu, 
        	'racineWeb' => $racineWeb));
    	echo $vue;
	}
}

?>
