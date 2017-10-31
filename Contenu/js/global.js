$(document).ready(function()
	{
		tinymce.init
		({
			selector: "textearea"
			theme: "modern",
			height: 400,
			width: '100%',
			// Plugins que nous avons ajoutés dans TinyMCE, certains d'entre eux pourraient ne pas fonctionner car je ne les ai pas ajoutés dans mon dossier de plugins
			plugins: [ "advlist autolink image lists charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualcharts insertdatetime media nonbreaking",
						"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
						 ],
			toolbar1 : "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
			toolbar2 : "| responsivefilemanager | link  unlink anchor | image media | forcolor backcolor | print preview code | caption",
			
			// Cela nous donnera la possibilité d'ajouter des légendes à l'image.
			image_caption: true,
			image_advtab: true,

			// Chemin où nous mettons le dossier filemanager, télécharger à partir de Google Drive.
			external_filemamager_path: "/filemanager/",
			filemanager_title: "myPHPnotes",
			external_plugins : { "filemanager": "/filemanager/plugin.min.js"},

			// Les blocs visuels vous donneront le pouvoir de distinguer les différentes étiquettes
			visualblocks_default_state: true,

			//Ceci est pour si un style (prédéfini ou défini par l'utilisateur) répète le sien avec cache et fusionne les respectueux.
			style_formats_autohide: true,
			style_formats_merge: true,
		});
	});