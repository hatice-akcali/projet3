<?php $this->titre = "Mon Blog - " . $this->nettoyer($billet['titre']); ?>

<!-- Affichage détail d'un billet dans son ensemble-->
<article>
    <header>
        <h1 class="titreBillet"><?= $this->nettoyer($billet['titre']) ?> 
        (<?= $this->nettoyer($billet['id']) ?>)</h1>
        <time>       
          <?= $this->dateToFrench($billet['date']) ?>
        </time>
    </header>
    <p><?= $billet['contenu'] ?></p>
</article>
<hr /><br>

<script type="text/javascript">




// lien signaler + message d'alert
function signalComment(id){
	//alert('signal = ' + id);
	var r = httpGet("/Monblog/DB/signalerComment.php?id=" + id);
	document.getElementById("p" + id).style.display = "none";
	alert('Le commentaire a été signalé a l\'administrateur\nMerci ...');
}





	
function httpGet(theUrl)
{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
	xmlHttp.send( null );
	return xmlHttp.responseText;
}
</script>


<!-- Affichage Commentaire lié au billet-->
<?php 
	if($commentaires->rowCount() != 0):
?>
	<header>
	    <h2 id="titreReponses">
	    Réponses à : <?= $this->nettoyer($billet['titre']) ?> 
	    </h2>
	</header>
	<?php foreach ($commentaires as $commentaire): ?>
	    <p><b>
	    <?= $this->nettoyer($commentaire['auteur']) ?> 
	    </b>
	    dit le 
	    <?= $this->nettoyer($this->dateToFrench($commentaire['date'])) ?> 
	    </p>
	    <p><?= $this->nettoyer($commentaire['contenu']) ?></p>
	    <?php   	
	    	if(!Commentaire::isSignaler($commentaire) &&
	    		!Commentaire::isAccepter($commentaire)){
					echo '<div id="p'
						.$commentaire['id']
						.'"><a id="s'
						.$commentaire['id']
						.'" href =javascript:signalComment(' 
						.$commentaire['id'] .');' .'>Signaler</a>'
						.'</div>';
				}
	    ?>
	    <hr><br>
	<?php endforeach; ?> <!-- Fin-->
<?php endif; ?> <!--Fin-->




<!-- Formulaire de commentaire -->
<h3 id="titreReponses">Commenter ce billet :</h3>
<form method="POST" action="billet/commenter" class="well"> 

  <div class="form-group" >
    <label for="auteur">Pseudo :</label>
    <input id="auteur" type="text" name="auteur" class="form-control" placeholder="Votre pseudo" required>
  </div>

  <div class="form-group">
    <label for="txtCommentaire">Votre message :</label>
    <textarea id="txtCommentaire" name="contenu" rows="3" class="form-control" placeholder="Votre message ici..." required></textarea>
  </div>

   <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Commenter" />
  
 </form>

