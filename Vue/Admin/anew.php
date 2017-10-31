<?php $this->titre = "Mon Blog - Creation d'un billet" ?>

<!-- Lien TinyMCE -->
<script src="/MonBlog/Contenu/js/tinymce/tinymce.min.js"></script>
<script src="/MonBlog/Contenu/js/global.js"></script>
<script src="/MonBlog/Contenu/js/jquery.js"></script>
<script src="/MonBlog/Contenu/js/tinymce/jquery.tinymce.min.js"></script>

<!-- Editeur de texte TinyMCE pour le billet -->
<script type="text/javascript">
	
$( document ).ready(function() {
    tinymce.init({
    selector: "textarea", // Modifiez cette valeur en fonction de votre HTML
    language : "fr_FR",	
    setup:function(ed) {
       ed.on('keyup', function(e) {
           update();
       });
    },
    menubar:false,
	plugins: [
	    "advlist autolink lists link image charmap print preview anchor",
	    "searchreplace visualblocks fullscreen",
	    "insertdatetime media table contextmenu paste "
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft al			igncenter alignright alignjustify | bullist numlist outdent indent "
	});
});
</script>

 <div class="container">
<h2>Création d'un billet :</h2>

<form action="../DB/createBillet.php" method="POST" >
<table width="100%">
	<tr><td>
		<label for="titre">Titre</label>
	</td></tr>
	<tr><td>
	    <input type="text" name="titre" id="title"
	            class="form-control" style="width:100%;"
	            placeholder="Le titre de votre billet" >
	</td></tr>
	<tr><td>
		<label for="titre">Contenu</label>
	</td></tr>
	<tr><td>
		<textarea name="contenu" rows="10" id="content"
			class="form-control" placeholder="Votre texte ici..." ></textarea>
	</td></tr>
	<tr><td>
		<label><input type="checkbox" name="online" id="publish"> Mettre en ligne </label>
	</td></tr>
	<tr><td>
	</td></tr>
	<tr><td>
		<button class="btn btn-primary" 
			title="Annuler la creation" 
			style="float: right;width: 100px;"
			onclick="annuler()">Annuler</button>
		<button class="btn btn-primary" 
			title="Créer un nouveau billet" 
			id="btok"
			style="float: right;width: 100px;margin-right:10px;">Creer</button>
	</td></tr>
</table>
</form>
<br>
<!--div-->

<script type="text/javascript">

function isEmpty(str) {
    return (!str || 0 === str.length);
}

// Mise à jour
function update(){		
	var a = document.getElementById('title').value.trim();
	var b = tinyMCE.activeEditor.getContent().trim();	
	var r = isEmpty(a) || isEmpty(b);
	document.getElementById('btok').disabled = r;
}

// Annuler
function annuler(){
	document.getElementById('title').value = '';
}

$("#title").on('change paste input', function(){
     update();
});
document.getElementById('btok').disabled = true;

</script>