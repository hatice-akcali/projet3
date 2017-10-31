<?php

require_once  dirname(__FILE__) . '\..\Framework\Modele.php';

/**
 * 
 * Déclare une constante du nombre de billet à 5 
 */
class Billet extends Modele {

	const NB_BILLET_PER_PAGE = 5; 
	

    /** 
     *Renvoie la liste des billets du blog
     * 	par ordre décroissant
     * @return PDOStatement La liste des billets
     */
    public function getBillets() {
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
                . ' BIL_TITRE as titre, BIL_CONTENU as contenu, '
                . ' BIL_PUB as pub '
                . ' from T_BILLET'
                . ' order by BIL_ID desc';
        $billets = $this->executerRequete($sql);
        return $billets;
    }
    
    /**
	* Récupère le nombre de pages des billets 
	* en utilisant la constante NB_BILLET_PER_PAGE
	*  
	*/
    public function getTotalPage(){
		$sql = 'SELECT CEILING(COUNT(*) /' 
				.self::NB_BILLET_PER_PAGE 
				. ') as total FROM T_BILLET'
				. ' WHERE BIL_PUB = 1';	
        $result = $this->executerRequete($sql);
        $row = $result->fetch();     
    	$totalPage = $row[0];
        return $totalPage;
	}
    
    /**
	* getBilletsPage(), qui se trouve dans Modèle
    * On récupère le nombre total de page
    * cette fonction permet de recuperer par SQL.
    *
	* NB_BILLET_PER_PAGE billet (5 billets)
	* a l'offset (numero de la page -1 ) * NB_BILLET_PER_PAGE
	*/
    public function getBilletsPage($page){
    	$offset = ($page -1) * self::NB_BILLET_PER_PAGE;
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
                . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
                . ' WHERE BIL_PUB = 1'
                . ' ORDER BY BIL_ID desc'
                . ' LIMIT ' .self::NB_BILLET_PER_PAGE
                . ' OFFSET ' .$offset;
        $billets = $this->executerRequete($sql);
        return $billets;		
	}

    /** 
     *Renvoie les informations sur un billet 
     * @param int $id L'identifiant du billet
     * @throws Exception Si l'identifiant du billet est inconnu
     */
    public function getBillet($idBillet) {
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
                . ' BIL_TITRE as titre, BIL_CONTENU as contenu, '
                . ' BIL_PUB as pub '
                . ' from T_BILLET'
                . ' where BIL_ID=?';
        $billet = $this->executerRequete($sql, array($idBillet));
        if ($billet->rowCount() > 0)
            return $billet->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }

    /**
     * Renvoie le nombre total de billets
     * 
     * @return int Le nombre de billets
     */
    public function getNombreBillets()
    {
        $sql = 'select count(*) as nbBillets from T_BILLET';
        $resultat = $this->executerRequete($sql);
        $ligne = $resultat->fetch();  // Le résultat comporte toujours 1 ligne
        return $ligne['nbBillets'];
    }


     /**
     * permet d'ajouter un enregistrement ,
     * à une table MySQL pour la création d'un nouveau billet
     *
     */
    public function creerBillet($titre, $contenu, $publish) {
        $sql = 'insert into T_BILLET(BIL_DATE, BIL_TITRE, BIL_CONTENU, BIL_PUB) '
        	. ' values(?, ?, ?, ?)';        
        setlocale(LC_TIME, "fr_FR");
        date_default_timezone_set('Europe/Paris');
        //$date = date('Y-m-d H:i:s');
        $date = strftime('%Y-%m-%d %H:%M:%S');
        $this->executerRequete($sql, array($date, $titre, $contenu, $publish));
        
    }

     /**
     * pré-rempli le formulaire en fonction de son id et des paramètres passés
     * 
     */
     public function modifierBillet($id, $titre, $content, $publish)
     {
         $sql = 'UPDATE t_billet SET '
         	. ' BIL_TITRE = ?, '
         	. ' BIL_CONTENU = ?, '
         	. ' BIL_PUB = ? '
         	. ' WHERE BIL_ID = '. $id;
         $this->executerRequete($sql, array($titre, $content, $publish));
     }

     /**
     * Le billet sera supprimer par son id
     * 
     */
     public function supprimerBillet($id)
     {
        $sql0 = 'DELETE FROM t_commentaire WHERE BIL_ID = '.$id;
        $sql1 = 'DELETE FROM t_billet WHERE BIL_ID = '.$id;
        $sqls = array($sql0, $sql1);
        $resultat = $this->executerTransactionRequete($sqls);
     }



     /**
     * Si BIL_PUB = 1, alors le billet sera publié en ligne
     * 
     *
     */
     public function publierBillet($id)
     {
        $sql = 'UPDATE t_billet SET BIL_PUB = 1 WHERE BIL_ID = ' . $id;
        $resultat = $this->executerRequete($sql);	
		$ligne = $resultat->fetch();  	
     }

     /**
     * Si BIL_PUB = 0, le billet sera retiré d'internet
     * 
     */
     public function retirerBillet($id)
     {
        $sql = 'UPDATE t_billet SET BIL_PUB = 0 WHERE BIL_ID = '. $id;
        $resultat = $this->executerRequete($sql);	
		$ligne = $resultat->fetch();  	
     }
     
		
}