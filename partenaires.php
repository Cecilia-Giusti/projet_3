<?php

// On démarre la session AVANT d'écrire du code HTML
session_start();
$_SESSION['id'] ;
$_SESSION['name'];
$_SESSION['firstname'] ;
$_SESSION['username'] ;
include("fonctions.php"); 
actualiser_session();

  // Connexion à la base de données
 
  try
  {
    
    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }


  if (isset($_SESSION['id'])){

  // Données de la base de données des acteurs - partenaires
  $req = $bdd->prepare('SELECT * FROM actors WHERE id = :id');
  $req->execute(array(
      'id' => $_GET['id'] 
      ));
  $resultat = $req->fetch();


  // Données de la base de données des users
 $req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
 $req->execute(array(
     'id' => $_SESSION['id'] 
     ));
 $donnees = $req->fetch();

 // Récupération des commentaires
 $reponse = $bdd->query("SELECT id_actor, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%i') AS date, post FROM posts WHERE id_actor= $_GET[id] ORDER BY ID DESC");
 
  // Récupération du nombre de commentaires
 $nombreDeCommentaire = $bdd->query("SELECT COUNT(*) AS nbCom FROM posts WHERE id_actor= $_GET[id]");
 $count_total = $nombreDeCommentaire->fetch();

   // Récupération du nombre de vote like
   $nombreDeLike = $bdd->query("SELECT COUNT(vote) AS nbLike FROM likes WHERE id_actor= $_GET[id] AND vote=1");
   $count_like = $nombreDeLike->fetch();
  
     // Récupération du nombre de vote dislike
     $nombreDeDislike = $bdd->query("SELECT COUNT(vote) AS nbDislike FROM likes WHERE id_actor= $_GET[id] AND vote=0");
     $count_dislike = $nombreDeDislike->fetch();

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Partenaires et acteurs de la GBAF</title>
    <meta name="description" content="L'extranet pour les salariés de GBAF">
    <link rel="stylesheet" href="styles.css"/>
  </head>

 <body>       
  <div id="container">  
    <!-- Header  -->
    <?php include("header.php"); ?>
   
   <!-- Section   -->
   <section id="acteurPartenaire">
    <img src="<?php echo(htmlspecialchars($resultat['logo']));?>" alt="Logo"/>
    <h2><?php echo(htmlspecialchars($resultat['actor']));?></h2>
    <p><?php echo(htmlspecialchars($resultat['description']));?>
    </p>
   </section> 

  <section id="commentaire">
    <div id="menuCommentaire">
      <p>
        <?php 
          if ($count_total['nbCom'] > 1) {
            echo ($count_total['nbCom']) . ' commentaires' ;
          }
          else {
            echo ($count_total['nbCom']) . ' commentaire' ;
          }
        ?>
      </p>
      
      <div class="like"><a  href="like_post.php?id=<?php echo(htmlspecialchars($resultat['id']));?>&amp;vote=1"><img src="images_web/like.png" alt="Like"/> <?php echo ($count_like['nbLike']);?> </a></div>
      <div class="like"><a href="like_post.php?id=<?php echo(htmlspecialchars($resultat['id']));?>&amp;vote=0"><?php echo ($count_dislike['nbDislike']);?>   <img src="images_web/dislike.png" alt="dislike"/> </a></div>
    
 <?php 

 // Ajouter un if l utilisateur à cliqué alors dans une autre couleur 

 ?>


    </div>

    <form action="commentaires_post.php?id=<?php echo(htmlspecialchars($resultat['id']));?>" method="post">  
      <article>
        <div class="emplacement">
          <input type="text" id="emplacementMessage" name="post" value="Votre commentaire" onFocus="this.value=''"/>
        </div>

        <input type="hidden" name="id" value="<?php echo($donnees['id']);?>" />

        <div id="boutonCommentaire">
          <input class="boutonCommentaire" type="submit" value="Envoyer"/>
        </div>
      </article>
    </form>

    <?php
  // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
  while ($donnees = $reponse->fetch())
  { 
  ?>  

    <article>
      <p>Prénom : <?php echo($_SESSION['firstname']);?></p>
      <p>Le : <?php echo($donnees['date']) ; ?></p>
      <p>Message : <?php echo($donnees['post']);?></p>
    </article>

    <?php 
  }
  $reponse->closeCursor();
  ?>
  </section>
 
     <?php include("footer.php"); ?>
  </div>
</body>
</html>

<?php
}
else {
  // Redirection
      header("Location: connexion.php");
}

?>
