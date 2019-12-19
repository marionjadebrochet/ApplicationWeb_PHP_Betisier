<?php
$pdo=new Mypdo();
$villeManager = new VilleManager($pdo);
$villes=$villeManager->getListVilleSansDep();
?>

<div class="titre">
	<h1>Supprimer une ville</h1>
</div>

<?php
if (empty($_GET['numero'])) {
	?>
	<table>
		<tr><th>Nom</th><th>Supprimer</th></tr>
		<?php foreach ($villes as $ville){ ?>
			<tr>
				<td><?php echo $ville->getVilNom();?></td>
				<td><a href="index.php?page=12&numero=<?php echo $ville->getVilNum(); ?>"><img src="./image/erreur.png" alt=""> </a></td>
			</tr>
		<?php } ?>
	</table>
	<br />

<?php } else {

	$ville = $_GET['numero'];
	$villeManager->delete($ville);
	echo 'La ville a été supprimée';
	echo "Redirection automatique dans 2 secondes";
	header("Refresh:2; url=index.php?page=0");

}?>
