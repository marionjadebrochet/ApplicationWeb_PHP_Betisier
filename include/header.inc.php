<?php
  session_start();
 ?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">
		<div id="connect">
      <?php if(empty($_SESSION['nom'])) {?>
      <a href="index.php?page=15">Connexion</a>
    <?php } else {
      echo "Utilisateur: ".$_SESSION['nom'];?>
      <a href="index.php?page=16">Déconnexion</a>
    <?php } ?>
		</div>
		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
