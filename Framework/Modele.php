<?php

require_once 'Configuration.php';

/**
 * Classe abstraite modèle.
 * Centralise les services d'accès à une base de données.
 *
 */
abstract class Modele
{
    /** Objet PDO d'accès à la BD 
      *Statique donc partagé par toutes les instances des classes dérivées */
    private static $bdd;

    /**
     * Exécute une requête SQL
     * 
     * @param string $sql Requête SQL
     * @param array $params Paramètres de la requête
     * @return Résultats de la requête
     */
    protected function executerRequete($sql, $params = null)
    {
        if ($params == null) {
            $resultat = self::getBdd()->query($sql);   // exécution directe
        }
        else {
            $resultat = self::getBdd()->prepare($sql); // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }
    
    /**
	* 
	* @param undefined $sqls	liste des clauses a executer
	* 
	* @return 
	*/
    protected function executerTransactionRequete($sqls)
    {
    	$resultat = 'error';
    	try{
    		self::getBdd()->beginTransaction();
	    	foreach ($sqls as &$sql) {
    	        $resultat = self::getBdd()->query($sql);   // exécution directe
			}
			self::getBdd()->commit();
			$resultat = 'ok';
		}
		catch(Exception $e) //en cas d'erreur
		{
    		//on annule la transation
    		self::getBdd()->rollback();
    		$resultat = 'error';
		}
        return $resultat;
    }
    
    

    /**
     * Renvoie un objet de connexion à la BDD en initialisant la connexion au besoin
     * 
     * @return PDO Objet PDO de connexion à la BDD
     */
    private static function getBdd()
    {
        if (self::$bdd === null) {
            // Récupération des paramètres de configuration BD
            $dsn = Configuration::get("dsn");
            $login = Configuration::get("login");
            $mdp = Configuration::get("mdp");
            // Création de la connexion
            self::$bdd = new PDO($dsn, $login, $mdp,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$bdd;
    }

}
