<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paramètre extranet GBAF</title>
    <meta name="description" content="L'extranet pour les salariés de GBAF">
    <link rel="stylesheet" href="styles.css"/>
  </head>

<body>     
  <div id="container">  
    <!-- Header  -->
      <header>
        <nav>
          <!-- Logo-->
          <div id="logo_GBAF">
            <img src="images_web/logo_fonbblanc.png" alt="Logo GBAF" />
          </div>

          <!-- Nom & prénom s'il y a connexion-->
          <div id="barreDidentite">
            <ul> 
              <li><img src="images_web/icone_identite.png" alt="Image identite"/></li>
              <li><a class="nomPrenom" href="parametres.php"> Nom & Prénom <a></li>
            </ul>
          </div>
          <!--Deconnexion s'il y a connexion -->
          <div id="deconnexion">
            <a class="deconnexion" href="connexion.html">Déconnexion</a>
          </div>

        </nav>
      </header>