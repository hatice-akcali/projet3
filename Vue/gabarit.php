<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="Contenu/style.css" />
    <base href="<?= $racineWeb ?>" >

    <title><?= $titre ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/MonBlog/Contenu/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/MonBlog/Contenu/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/MonBlog/Contenu/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <!-- Corps du document -->
  <body>
    <!-- entête du document-->
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Mon blog : </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/MonBlog/index.php"><i class="glyphycon glyphicon-home">Accueil</i></a></li>            
          </ul>

          <ul class="nav navbar-nav pull-right" >
            <li><a href="connexion"><span class="glyphicon glyphicon-cog"></span>Connexion</a></li>           
          </ul>

        </div><!--/.nav-collapse -->
      </div> <!-- div Container -->
    </nav> <!-- navbar-inverse -->
    <!-- Fin entete -->

    <!-- Partie principale de la page d'accueil -->
    <div class="container">
        <div class="blog-header">
            <img src="./image/banner.png" alt="banner"  class="img-responsive img-rounded"/>      
        </div><br/>

        <div class="row">
            <section class="col-sm-8"> 
                <h1>Billet Simple pour l'Alaska : </h1><hr><br>  
                <div id="contenu">
                    <?= $contenu ?>
                </div> <!-- #contenu -->  
            </section> <!-- Fin section-- >
            <!-- sidebar -->

            <?php include ('Sidebar/sidebar.php');  ?>
        </div> <!-- row-->
        <br >
    </div><!-- /.container -->
    <!-- Partie principale Fin -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/tests/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>

  <!-- Pied de page -->
  <div class="container-fluide">
    <div class="footer" style="background-color: #222;">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copyright" style="font-familly: Minecraftia: font-weight: 300;color: white;text-align:center;">
                    
                    <a href="/MonBlog/connexion">Administration</a>
                    <p>Blog réalisé avec PHP, Bootstrap, HTML5 et CSS. ET MOI !!!</p>
                                        
                </div>  <!-- footer-copyright -->           
            </div>  <!--col-lg-12 -->       
        </div> <!-- row -->     
    </div>  <!-- footer -->
</div> <!-- Container -->
<!-- Fin pied de page -->

</html>