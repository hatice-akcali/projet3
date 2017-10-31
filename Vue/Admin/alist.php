<?php $this->titre = "Mon Blog - Liste des billets" ?>


<style>
table, th, td {
	border: 1px solid black;
}
</style>

<script type="text/javascript">

function publier(id){
	//alert('publish = ' + id);
	var r = httpGet("/Monblog/DB/publishBillet.php?id=" + id);
	document.getElementById("pub" + id).style.display = "none";
	document.getElementById("unpub" + id).style.display = "";
}

function unpublier(id){
	//alert('unpublish = ' + id);
	var r = httpGet("/Monblog/DB/unpublishBillet.php?id=" + id);
	document.getElementById("pub" + id).style.display = "";
	document.getElementById("unpub" + id).style.display = "none";
}

function supprime(id){
	var r = httpGet("/Monblog/DB/deleteBillet.php?id=" + id);
	document.getElementById("del" + id).style.display = "none";
	alert("Billet correctement supprimé.");
}

// Ca appelle une requete en web 2.0
// On fait appelle à une page php
// Et on récupère le résultat	
function httpGet(theUrl)
{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
	xmlHttp.send( null );
	return xmlHttp.responseText;
}
</script>

<div class="container">
    <h1>Liste des billets : </h1><hr>

    <div class="btn-group" style="padding-left: 1000px;">
		<a class="btn btn-primary pull-right"  title="Créer un billet" href="../Admin/anew"  role="button"><span class="glyphicon glyphicon-plus"></span>Créer un billet...</a>
	</div><br /><br/>


<?php foreach ($billets as $billet):
    ?>
    <div id="del<?= $billet['id'] ?>">
	    <article>
	    	<table style="width:100%; " class="table table-striped table-hover table-bordered">
	    		<tr><td><?= $this->nettoyer($billet['titre']) ?></td></tr>
	    		<tr><td><?= $billet['contenu'] ?></td></tr>
	    		<tr><td><?= $this->dateToFrench($billet['date']) ?>  </td></tr>    		
	    	</table>    
	    	<p style="width:3px;"> </p>
	   	
	    	<button type="button" title="Publier" 
	    		id="pub<?= $billet['id'] ?>"
	    		onclick="publier(<?= $billet['id'] ?>)"
	    		style="background-color: #009300; color: white;<?= $billet['pub'] == 0 ? '' : 'display: none;'?>">Publier</button> 
	    		
	    	<button type="button" title="Dépublier" 
	    		id="unpub<?= $billet['id'] ?>"
	    		onclick="unpublier(<?= $billet['id'] ?>)"
	    		style="background-color: blue; color: white;<?= $billet['pub'] == 1 ? '' : 'display: none;'?>">Dépublier</button> 
	    	
	    	<button type="button" title="Supprimer" 
	    		onclick="supprime(<?= $billet['id'] ?>)"
	    		style="background-color: red; color: white;">Supprimer</button> 
	    		
	    	<a href="aedit/<?= $this->nettoyer($billet['id']) ?>">
	   			<input type="button" title="Modifier" value="Editer" 
	   				style="background-color: aqua; color: white;"/>
			</a>
	    </article> <!-- Fin article -->
	    <br><br>
    </div>
<?php endforeach; ?>
</div> <!--Conctainer -->