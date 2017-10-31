<?php

require_once 'Framework/Controleur.php';

/**
 * Classe parente des contrôleurs soumis à authentification
 *
 * Vérifie si les informations utilisateur sont présents dans la session
 */
abstract class ControleurSecurise extends Controleur
{
    public function executerAction($action)
    {
            parent::executerAction($action);
    }
}

