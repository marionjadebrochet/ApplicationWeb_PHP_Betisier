<?php
	$pdo=new Mypdo();
	$personneManager = new PersonneManager($pdo);
	$personnes=$personneManager->getList();
?>

<div class="titre">
	<h1>Liste des personnes enregistrées</h1>
</div>

<?php
echo "Actuellement ". $personneManager->countPersonne() . " personnes sont enregistrées"
?>
<br/>
<br/>
<table>
	<tr>
		<th> Numéro </th>
		<th> Nom </th>
		<th> Prénom </th>
	</tr>
	<?php foreach ($personnes as $personne){ ?>
			<tr>
				<td><a href="index.php?page=14&per_num=<?php echo $personne->getPerNum(); ?>
																			&per_nom=<?php echo $personne->getPerNom(); ?>">
																			<?php echo $personne->getPerNum(); ?></a></td>
				<td><?php echo $personne->getPerNom();?></td>
				<td><?php echo $personne->getPerPrenom();?></td>
			</tr>
	<?php } ?>
	</table>
	<br />

	<label> Cliquez sur le numéro de la personne pour obtenir plus d'informations </label>
	<br><br>
