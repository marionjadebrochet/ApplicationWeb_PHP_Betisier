<?php
$db = new MyPDO();
$connexionManager = new ConnexionManager($db);

$rand1 = rand(1,9);
$rand2 = rand(1,9);

?>
<h1>Pour vous connecter</h1>
<?php if(empty($_POST['nom']) || empty($_POST['mdp'])) {
  $_SESSION['res'] = $rand1 + $rand2;
?>

<form action="#" method="post">
  <div class="row">
    <label class="auto" for="nom">Nom d'utilisateur :</label>
    <input class="auto" type="text" name="nom">
  </div>
  <div class="row">
    <label class="auto" for="mdp">Mot de passe : </label>
    <input class="auto" type="password" name="mdp">
  </div>
  <div class="row">
    <img src="image/nb/<?php echo $rand1 ?>.jpg"> +
    <img src="image/nb/<?php echo $rand2 ?>.jpg"> =
    <input type="number" name="res">
  </div>
  <input type="submit" name="valider" value="valider">
</form>

<?php
} else {
  if($connexionManager->connexion($_POST['nom'],$_POST['mdp']) && $_POST['res'] == $_SESSION['res']) {
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['num'] = $connexionManager->connexion($_POST['nom'],$_POST['mdp'])[0];

    $_SESSION['res'] = null;
    echo "Vous avez été bien connecté <br>";
    echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");
  } else {
    $_SESSION['res'] = $rand1 + $rand2;?>
    <form action="#" method="post">
      <div class="row">
        <label class="auto" for="nom">Nom d'utilisateur :</label>
        <input class="auto" type="text" name="nom">
      </div>
      <div class="row">
        <label class="auto" for="mdp">Mot de passe : </label>
        <input class="auto" type="password" name="mdp">
      </div>
      <div class="row">
        <img src="image/nb/<?php echo $rand1 ?>.jpg"> +
        <img src="image/nb/<?php echo $rand2 ?>.jpg"> =
        <input type="number" name="res">
      </div>
      <p class="red">* Erreur, veuillez verifier les informations</p>
      <input type="submit" name="valider" value="valider">
    </form>

  <?php }
} ?>
