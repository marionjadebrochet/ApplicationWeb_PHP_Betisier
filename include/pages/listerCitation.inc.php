<?php
	$pdo=new Mypdo();
	$citationManager = new CitationManager($pdo);
	$citations=$citationManager->getList();
?>
<div class="titre">
	<h1>Liste des citations déposées</h1>
</div>


<?php
echo "Actuellement ". $citationManager->countCitation() . " citations sont enregistrées"
?>

<br/>
<br/>
<table>
	<tr>
		<th> Nom de l'enseignant </th>
		<th> Libellé </th>
		<th> Date </th>
		<th> Moyenne des notes </th>
	</tr>
<?php foreach ($citations as $citation){ ?>
		<tr>
			<td><?php echo $citation->getCitNomEnseignant();?></td>
			<td><?php echo $citation->getCitLibelle();?></td>
			<td><?php echo getFrenchDate($citation->getCitDate());?></td>
			<td><?php echo $citation->getCitMoyenne();?></td>
		</tr>
<?php } ?>
</table>
<br />
