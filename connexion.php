<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Extranet GBAF</title>
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

          <!--Deconnexion s'il y a connexion -->

        </nav>
      </header>
   
    <!-- Formulaire de connexion   -->
      <section id="formulaireDeConnexion">
        <form action="connexion_post.php" method="post">
          
          <h1> Se connecter</h1>
            <div id="connexion">
              <div class="label">
                <label for="username">Identifiant :</label>
              </div>

              <div class="emplacement">
                <input type="text" id="name" name="username" required />
              </div>

              <div class="label">
                <label for="password">Mot de passe :</label>
              </div>

              <div class="emplacement">
                <input type="password" id="password" name="password" required/>
              </div>

              <div id="motDePasseOublie">
                <i><a href="motDePasse.php">Mot de passe oublié ? </a> </i>
              </div>

              <div class="submit">
                <input type="submit" id='submit' value='Connexion' >
              </div>  

              <div id="inscription">
                <input onclick="window.location.href='inscription.php'" class="inscription" type="button" value="Inscription"/>
              </div>

            </div>
        </form>

      </section> 


   
      <footer>
        <div id="menuFooter">
          <ul>
            <Li>|<a href="mentionslegales.html"> Mentions Légales </a>|</Li>
            <li><a href="contact.php">Contact </a>|</li>
          </ul>
        </div>
      </footer>
  </div>


  <?php
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
  }
  catch (Exception $e)
  {
          die('Erreur : ' . $e->getMessage());
  }
  ?>  



</body>

</html>
