<?php
$pdo=new Mypdo();
$citationManager = new CitationManager($pdo);
$citations=$citationManager->getAllCitations();
?>

<h1>Supprimer une citation</h1>

<?php if(empty($_GET['numero'])) { ?>
	<table>
		<tr>
			<th>Nom de l'enseignant</th>
			<th>Libellé</th>
			<th>Date</th>
			<th>Valider</th>
		</tr>
		<?php foreach ($citations as $citation) { ?>
			<tr>
				<td><?php echo $citation->getCitNomEnseignant(); ?></td>
				<td><?php echo $citation->getCitLibelle(); ?></td>
				<td><?php echo $citation->getCitDate(); ?></td>
				<td><a href="index.php?page=8&numero=<?php echo $citation->getCitNum();?>"><img src="image/erreur.png"></a></td>
			</tr>
		<?php } ?>
	</table>
<?php } else {

	$citationManager->supprimerCitation($_GET['numero']);
	echo "Citation supprimée";
	echo "Redirection automatique dans 2 secondes";
	header("Refresh:2; url=index.php?page=0");

} ?>
