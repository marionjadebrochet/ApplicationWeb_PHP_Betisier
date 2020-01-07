<?php
$pdo=new Mypdo();
$villeManager = new VilleManager($pdo);
$villes=$villeManager->getList();
?>

<div class="titre">
  <h1>Modifier une ville</h1>
</div>

<?php
if (empty($_GET['numero'])) {
  ?>
  <table>
    <tr>
      <th>Nom</th>
      <th>Modifier</th>
    </tr>
    <?php foreach ($villes as $ville){ ?>
      <tr>
        <td><?php echo $ville->getVilNom();?></td>
        <td><a href="index.php?page=11&numero=<?php echo $ville->getVilNum(); ?>"><img src="./image/modifier.png" alt=""> </a></td>
      </tr>
    <?php } ?>
  </table>
  <br />

<?php } else {
  if (empty($_POST['nom'])) { ?>

    <form action="#" method="post">
      <div class="row">
        <label for="Nom">Nom :</label>
        <input type="text" name="nom" id="nom" />
      </div>
      <input type="submit" name="submit" value="Valider" />
    </form>

  <?php } else {

    $nomVille = $_POST['nom'];
    $ville = $_GET['numero'];
    $villeManager->update($ville, $nomVille);
    echo 'La ville a été modifiée  <br>';
    echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");

  }
}?>
