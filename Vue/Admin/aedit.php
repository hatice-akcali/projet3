<?php $this->titre = "Mon Blog - Edition d'un billet" ?>
 
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
    menubar:false,
    setup:function(ed) {
       ed.on('keyup', function(e) {
           update();
       });
    },
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
	<h2>Modifier un billet (<?= $_GET['id'] ?>)</h2>

<?php
	$billet  = new Billet();
	$b = $billet->getBillet($_GET['id']);
?>

	<form action="../../DB/updateBillet.php" method="POST" >
	<table width="100%">
		<tr><td>
	    	<input type="hidden" name="id" id="id"
	            class="form-control" style="width:100%;"
	            placeholder="Le titre de votre billet" 
	            value="<?= $b['id'] ?>">	            
		</td></tr>
		<tr><td>
			<label for="titre">Titre</label>
		</td></tr>
		<tr><td>
	    	<input type="text" name="titre" id="title"
	            class="form-control" style="width:100%;"
	            placeholder="Le titre de votre billet" 
	            value="<?= $b['titre'] ?>">	            
		</td></tr>
		<tr><td>
			<label for="titre">Contenu</label>
		</td></tr>
		<tr><td>
		<textarea name="contenu" rows="10" id="content"
			class="form-control" placeholder="Votre texte ici..." >
				<?= $b['contenu'] ?>
		</textarea>
		</td></tr>
		<tr><td>
			<label><input type="checkbox" name="online" 
			id="publish" 
			<?php 
				echo ($b['pub'] == 1 ? 'checked' : '');
			 ?>
			>Mettre en ligne</label>
		</td></tr>
		<tr><td>
		</td></tr>
		<tr><td>
			<button class="btn btn-primary" 
				title="Annuler la creation" 
				style="float: right;width: 100px;"
				onclick="annuler()">Annuler</button>
			<button class="btn btn-primary" 
				title="Mettre à jour" 
				id="btok"
			style="float: right;width: 100px;margin-right:10px;"> Mettre a jour </button>
		</td></tr>
	</table>
	</form>
	<br>
</div> <!-- Div container -->

<script type="text/javascript">

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function update(){		
	var a = document.getElementById('title').value.trim();
	var b = tinyMCE.activeEditor.getContent().trim();	
	var r = isEmpty(a) || isEmpty(b);
	document.getElementById('btok').disabled = r;
}

function annuler(){
	document.getElementById('title').value = '';
}

$("#title").on('change paste input', function(){
     update();
});
document.getElementById('btok').disabled = false;

</script>