<?php

require_once 'Controleur.php';
require_once 'Requete.php';
require_once 'Vue.php';

/**
 * Classe de routage des requêtes entrantes.
 *
 */
class Routeur
{

    /**
     * je crée une requete, avec les paramètres GET et POST, passés par le client
     * je crée le controleur
     * je crée l'action, qui correspond à la requete
     * Et on exécute
     */
    public function routerRequete()
    {
        try {          
            $requete = new Requete(array_merge($_GET, $_POST)); 
            $controleur = $this->creerControleur($requete);
            $action = $this->creerAction($requete);		
            $controleur->executerAction($action);
        }
        catch (Exception $e) {
            $this->gererErreur($e);
        }
    }

    /**
     * Le Contrôleur par défaut, qui est accueil
     * Si le paramètre controleur existe dans la requete,
     *  On remplace la variable controleur, avec le nom du bon controleur en question*
     *
     * A partir du Controlleur, on va créer le nom de la classe Controleur
     * On crée le nom du fichier
     * Si le fichier existe, on exécute le code de ce fichier
     * On crée une instance, de la classe controleur que l'on vient de récupérer
     *
     * Si ce fichier n'existe pas on lance une exception
     */
    private function creerControleur(Requete $requete)
    {  
        $controleur = "Accueil";  
        if ($requete->existeParametre('controleur')) {
            $controleur = $requete->getParametre('controleur');
            // Première lettre en majuscules
            $controleur = ucfirst(strtolower($controleur));
        }
        $classeControleur = "Controleur" . $controleur;
        $fichierControleur = "Controleur/" . $classeControleur . ".php";
        if (file_exists($fichierControleur)) {
            // Instanciation du contrôleur adapté à la requête
            require($fichierControleur);
            $controleur = new $classeControleur();
            $controleur->setRequete($requete);
            return $controleur;
        }
        else {
            throw new Exception("Fichier '$fichierControleur' introuvable et c'est bien fait");
        }
    }
    
    

    /**
     * l'Action par défaut, c'est index
     *  Qui détermine l'action à exécuter, en fonction de la requête reçue
     *
     */
    private function creerAction(Requete $requete)
    {   
        $action = "index";  
        if ($requete->existeParametre('action')) {
            $action = $requete->getParametre('action');
        }
        return $action;
    }
    
    

    /**
     * Gère une erreur d'exécution (exception)
     * 
     * @param Exception $exception Exception qui s'est produite
     */
    private function gererErreur(Exception $exception)
    {
        $vue = new Vue('erreur');
        echo 'Erreur : ' .$exception->getMessage();
    }

}
