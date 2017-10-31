<?php

//echo 'Comment.php = ' . dirname(__FILE__). '<br>';
require_once dirname(__FILE__) . '\..\Framework\Modele.php';


class Commentaire extends Modele {

	// Renvoie la liste des commentaires associés à un billet
    public function getCommentaires($idBillet) {
        $sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu,' 
                . ' COM_ISSIGNALE as estsignaler from T_COMMENTAIRE'
                . ' where BIL_ID=?';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }
    
    
    // Renvoie la liste des commentaires signalés
    public function getCommentairesSignale(){
		 $sql = 'select COM_ID as id, COM_DATE as date,'
		 		. ' BIL_ID as bid,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu,' 
                . ' COM_ISSIGNALE as estsignaler from T_COMMENTAIRE'
                . ' where COM_ISSIGNALE <> 0';
        $commentaires = $this->executerRequete($sql);
        return $commentaires;
		
	}

	/**
	* ajouter un commentaire pour un billet
	* la date de l'ajout sera la date du jour
	* 
	* @param string $auteur	nom de l'auteur'
	* @param string $contenu texte du commentaire
	* @param int $idBillet numero du billet
	* 
	*/
    public function ajouterCommentaire($auteur, $contenu, $idBillet) {
        $sql = 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID) values(?, ?, ?, ?)';      
        setlocale(LC_TIME, "fr_FR");
        date_default_timezone_set('Europe/Paris');
        $date = strftime('%Y-%m-%d %H:%M:%S');
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }
    
    /**
     * Renvoie le nombre total de commentaires
     * 
     * @return int Le nombre de commentaires
     */
    public function getNombreCommentaires()
    {
        $sql = 'select count(*) as nbCommentaires from T_COMMENTAIRE';
        $resultat = $this->executerRequete($sql);
        $ligne = $resultat->fetch();  // Le résultat comporte toujours 1 ligne
        return $ligne['nbCommentaires'];
    }

	/**
	* permet de mettre le commentaire à l'état' signaler
	* @param int $idCommentaire numero index du commentaire
	* 
	*/
	public function signaler($id){
		$sql = 'UPDATE t_commentaire SET COM_ISSIGNALE=1 WHERE COM_ID='.$id;	
		$resultat = $this->executerRequete($sql);	
		$ligne = $resultat->fetch();  
	}
	
	/**
	* permet de mettre le commentaire a l'etat accepté
	* 
	* @param int $idCommentaire numero index du commentaire
	* 
	*/
	public function accepter($id){	
		$sql = 'UPDATE t_commentaire SET COM_ISSIGNALE=2 WHERE COM_ID='.$id;	
		$resultat = $this->executerRequete($sql);	
		$ligne = $resultat->fetch();  
	}
	
	/**
	* permet de supprimer un commentaire
	* 
	* @param int $idCommentaire numero index du commentaire
	* 
	*/
	public function supprimer($id){
		$sql = 'DELETE FROM t_commentaire WHERE COM_ID='.$id;
		$resultat = $this->executerRequete($sql);	
//		$ligne = $resultat->fetch();  	
	}
	
	public static function isAccepter($commentaires) {		
		return $commentaires['estsignaler'] == 2;
	}
	
	public static function isSignaler($commentaires){		
		return $commentaires['estsignaler'] == 1;
	}	


	public function toString(){
		return "[Commentaire]";
	}	
}