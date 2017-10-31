<?php $this->titre = "Mon Blog"; ?>

<!-- Affichage des billets page d'accueil -->
<?php foreach ($billets as $billet):
    ?>
    <article>
        <header>
            <a href="<?= "billet/index/" . $this->nettoyer($billet['id']) ?>">
                <h2 class="titreBillet"><?= $this->nettoyer($billet['titre']) ?></h2>
            </a>
            <time>
                <?= $this->dateToFrench($billet['date']) ?>
            </time>
        </header>
        <p>
        	<?php
        	$str = $billet['contenu'];        	
        	echo substr($str, 0, 100 );
        	if(strlen($str) > 100)
        		echo '...';
        	//$str = $this->nettoyer($billet['contenu']);
        	/*
        	$result = Billet::truncate($str, 100);
        	echo $result;
        	*/
    	?></p>
        </p>
    </article>
    <hr />
<?php endforeach; ?>


<!-- Pagination-->
<table width="100%">
<tr> <td height="12" bgcolor="#222" align="center"><font color="white" ><b>Pages</b></font></td></tr>
<tr>
    <td align="center">
<?php 
	for($i = 1; $i <= $total ; $i++){
		if($i != $page){
			echo " <font size='6'><a href='accueil/index/" .$i ."'>" .$i ."</a></font> ";	
		}else{
			echo " <font size='8'>" .$i ."</font> ";	
		}
	}
?>
	</td>
</tr>
<tr> <td height="12" bgcolor="#222"> </td></tr>
</table>
