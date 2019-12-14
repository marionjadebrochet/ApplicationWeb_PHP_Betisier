<?php
$pdo=new Mypdo();
$personneManager = new PersonneManager($pdo);
$personnes=$personneManager->getList();
?>

<div class="titre">
	<h1>Supprimer des personnes enregistrées</h1>
</div>

<?php
if (empty($_GET['numero'])) {
	?>
	<table>
		<tr><th>Nom</th><th>Supprimer</th></tr>
		<?php foreach ($personnes as $personne){ ?>
			<tr>
				<td><?php echo $personne->getPerNom();?></td>
				<td><a href="index.php?page=13&numero=<?php echo $personne->getPerNum(); ?>"><img src="./image/erreur.png" alt=""> </a></td>
			</tr>
		<?php } ?>
	</table>
	<br />

<?php } else {

	$personne = $_GET['numero'];
	$personneManager->delete($personne);
	echo 'La personne a été supprimée';
	echo "Redirection automatique dans 2 secondes";
	header("Refresh:2; url=index.php?page=0");

}?>
