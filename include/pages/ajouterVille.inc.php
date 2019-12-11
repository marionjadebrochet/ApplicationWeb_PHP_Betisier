<?php
$pdo=new Mypdo();
$villeManager = new VilleManager($pdo);
?>

<h1>Ajouter une ville</h1>

<?php
if (empty($_POST["nom"])) { ?>

	<form action="#" method="post">
		<div class="row">
			<label for="Nom">Nom</label>
			<input type="text" name="nom" id="Nom" />
		</div>
		<input type="submit" name="submit" value="Valider" />
	</form>

<?php } else {

	$ville = new Ville(array('vil_nom' => $_POST['nom']));
	$villeManager->add($ville);
	echo 'La ville ' . $_POST["nom"] . '  a été ajoutée';
	echo "Redirection automatique dans 2 secondes";
	header("Refresh:2; url=index.php?page=0");

}
?>
