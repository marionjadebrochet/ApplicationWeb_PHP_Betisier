<?php
	$pdo=new Mypdo();
	$villeManager = new VilleManager($pdo);
?>

<h1>Ajouter une ville</h1>

<?php
if (empty($_POST["nom"])) { ?>

<form action="#" method="post">
  <label for="Nom">Nom</label>
  <input type="text" name="nom" id="Nom" />
  <input type="submit" name="submit" value="Valider" />
</form>


<?php } else {

$ville = new Ville(
  array('vil_nom' => $_POST['nom'])
);

$villeManager->add($ville);
echo 'La ville' . $_POST["nom"] . 'a été ajoutée';

}
?>
