<?php
$db = new MyPDO();
$connexionManager = new ConnexionManager($db);

$rand1 = rand(1,20);
$rand2 = rand(1,20);

?>
<h1>Pour vous connecter</h1>
<?php if(empty($_POST['nom']) || empty($_POST['mdp'])) { ?>

<form action="#" method="post">
  <div class="row">
    <label class="auto" for="Nom">Nom d'utilisateur :</label>
    <input class="auto" type="text" name="nom">
  </div>
  <div class="row">
    <label class="auto" for="mdp">Mot de passe : </label>
    <input class="auto" type="password" name="mdp">
  </div>
  <div class="row">
    <input type="text" name="rand1" value="<?php echo $rand1 ?>"> +
    <input type="text" name="rand2" value="<?php echo $rand2 ?>"> =
    <input type="number" name="res" value="">
  </div>
  <input type="submit" name="valider" value="valider">
</form>

<?php } else {

  if($connexionManager->connexion($_POST['nom'],$_POST['mdp'])) {
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['num'] = $connexionManager->connexion($_POST['nom'],$_POST['mdp'])[0];

    echo "Vous avez été bien connecté <br>";
    echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");

  } else {
    echo 'ca marche pas bien';
  }


} ?>
