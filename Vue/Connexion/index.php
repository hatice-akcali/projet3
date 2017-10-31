<?php $this->titre = "Mon Blog - Connexion" ?>
	

<!-- Formulaire de connexion -->	
<div class="jumbotron" style="margin-top: 8px; background-color : #798081;text-align: center;">
	<h3 style="color: white;">Connectez-vous</h3><br />

	<form action="connexion/connecter" method="post" class="well">
		<div class="form-group" >
	 		<label for="login">Login :</label>
    		<input name="login" type="text" class="form-control"  placeholder="Entrez votre login" required autofocus>
    	</div>
    	<div class="form-group" >
    		<label for="mdp">Password :</label>
    		<input name="mdp" type="password" class="form-control" placeholder="Entrez votre mot de passe" required>
    	</div>
    	<button type="submit" class="btn btn-primary">Connexion</button>
	</form>

</div> <!-- div jumbotron -->


<!-- S'il y a un message d'erreur, afficher l'erreur -->
<?php if (isset($msgErreur)): ?>
    <p><?= $msgErreur ?></p>
<?php endif; ?>