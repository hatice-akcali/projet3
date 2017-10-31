<?php $this->titre = "Mon Blog - Signalements commentaires" ?>

<div class="container" >
	<h2>Gestion des signalements des commentaires : </h2><hr ><br>

	<style>
	table, th, td {
    	border: 1px solid black;
	}
	</style>

 <script>
 
// Renvoie le commentaire de la fonction accepte, par son id.
function accepte(id){	
	var r = httpGet("/Monblog/DB/accepteComment.php?id=" + id);
	document.getElementById("bt" + id).style.display = 'none';
}

// Renvoie le commentaire à supprimer par son ID
function supprimer(id){	
	var r = httpGet("/Monblog/DB/deleteComment.php?id=" + id);
	document.getElementById("tr" + id).style.display = 'none';
}



function httpGet(theUrl)
{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
	xmlHttp.send( null );
	return xmlHttp.responseText;
}
</script>


<! -- Tableau liste des commentaires signalés -->
 <table class="table table-striped table-hover table-bordered">
	<tr style="background-color: #222; color: white;">
		<td style="text-align: center; width:5%">N°</td>
		<td style="text-align: center; width: 58%">Message</td>
		<td style="text-align: center; width: 15%">Pseudo</td>
		<td style="text-align: center; width:7%">N° billet</td>
		<td></td>
	</tr>
	
<?php foreach ($commentaires as $commentaire): ?>
   	<tr id="tr<?= $this->nettoyer($commentaire['id']) ?>">
		<td><?= $this->nettoyer($commentaire['id']) ?></td>
    	<td><?= $this->nettoyer($commentaire['contenu']) ?></td>
    	<td><?= $this->nettoyer($commentaire['auteur']) ?></td>   	  
    	<td><?= $this->nettoyer($commentaire['bid']) ?></td>
    	<td>
    		<?php if($commentaire['estsignaler'] != 2): ?>
    		<button id="bt<?= $this->nettoyer($commentaire['id']) ?>"
    			type="button" title="Accepter"
    			style="background-color: blue; color: white;"
    			onclick="accepte(<?= $this->nettoyer($commentaire['id']) ?>)">Accepter</button> 
			<?php endif; ?>    			
    		<button type="button" title="Supprimer"
    			style="background-color: red; color: white;"
    			onclick="supprimer(<?= $this->nettoyer($commentaire['id']) ?>)">Supprimer</button> 			
    	</td>
    </tr>  	      
<?php endforeach; ?>
</table>    

<br>
</div> <!-- Container -->