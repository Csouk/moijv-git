<?php
require_once 'connection.dist.php';

//---------------------------- ENREGISTREMENT PRODUIT --------------------------
if (!empty($_POST)) {
  $photo_bdd = '';
  if(!empty($_FILES['photo']['name'])) {
    $nom_photo = $_FILES['photo']['name'];
    // debug($nom_photo);
    $photo_bdd = URL . "photo/$nom_photo";
    // debug($photo_bdd);
    $photo_dossier = RACINE_SITE . "photo/$nom_photo";
    // debug($photo_dossier);
    copy($_FILES['photo']['tmp_name'], $photo_dossier);
  }
}

if (!empty($_POST)) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = strip_tags($value);
  }

  $resultat = $connexion->prepare("INSERT INTO game VALUES (DEFAULT, :title, :description, :picture, :category, :available)");

  $content .= "<div class='alert alert-success col-md-8 col-md-offset-2 text-center'>Jeux enregistré</div>";

  $resultat->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
  $resultat->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
  $resultat->bindValue(':picture', $photo_bdd, PDO::PARAM_STR);
  $resultat->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
  $resultat->bindValue(':available', $_POST['available'], PDO::PARAM_STR);

  $resultat->execute();
  //debug($resultat);

}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moi JV</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Moi JV</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">A propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Location</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Connexion</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <?php
      if (!empty($content)) {
        echo $content;
      }
      ?>

      <div class="row">

        <form class="col-lg-12" action="" enctype="multipart/form-data" method="post">
          <h2 class="alert alert-info text-center">Ajouter un jeu</h2>

          <div class="form-group">
            <label for="title">Titre du jeu</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Titre">
          </div>
          <div class="form-group">
            <label for="description">Déscription du jeu</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Déscription ...">
          </div>
          <div class="form-group">
            <label for="photo">Photo du jeu</label>
            <input type="file" class="form-control" name="photo" id="photo"
          </div>
          <div class="form-group">
            <select class="form-group" name="category" id="category">
              <option value="">Sélectionner une catégorie</option>
              <option value="FPS">FPS</option>
              <option value="RPG">RPG</option>
              <option value="Puzzle Game">Puzzle Game</option>
            </select>
          </div>
          <label for="public">Disponibilité : </label>
          <div class="form-group">
            <label class="radio-inline col-lg-4">
              <input type="radio" name="available" id="available" value="1" checked> Disponible
            </label>
            <label class="radio-inline">
              <input type="radio" name="available" id="available" value="0"> Indisponible
            </label>
          </div>
          <button type="submit" class="btn btn-primary col-xs-12 col-lg-12">Ajouter le jeu</button>
        </form>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark col-lg-12">
      <p class="m-0 text-center text-white">Copyright &copy; Moi JV 2017</p>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
