<?php
	$pdo=new Mypdo();
	$citationManager = new CitationManager($pdo);
  $personneManager = new PersonneManager($pdo);
	$citations=$citationManager->getList();
?>
<div class="titre">
	<h1>Liste des citations déposées</h1>
</div>

<?php

if(empty($_GET['numero']) && empty($_POST['note'])) {
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
		<?php if(!empty($_SESSION['num']) && $personneManager->isEtudiant($_SESSION['num'])) { ?>
		<th>Noter</th>
		<?php	}?>
	</tr>
<?php foreach ($citations as $citation){ ?>
		<tr>
			<td><?php echo $citation->getCitNomEnseignant();?></td>
			<td><?php echo $citation->getCitLibelle();?></td>
			<td><?php echo getFrenchDate($citation->getCitDate());?></td>
			<td><?php echo $citation->getCitMoyenne();?></td>
			<?php if(!empty($_SESSION['num']) && $personneManager->isEtudiant($_SESSION['num'])) { ?>
				<td><?php if($citationManager->votedBy($_SESSION['num'],$citation->getCitNum()) == 0) { ?>
						<a href="index.php?page=5&numero=<?php echo $citation->getCitNum();?>"><img src="image/modifier.png"></a>
			<?php } else { ?>
						<img src="image/erreur.png">
			</td>
			<?php	}?>
		</tr>
		<?php } ?>
		<?php } ?>
</table>
<br />
<?php } else {
	if(empty($_POST['note'])) {
	$_SESSION['numero'] = $_GET['numero'];
	?>

	<form action="#" method="post">
		<label for="Note">Note : </label>
		<input type="number" min="0" max="20" name="note">
		<input type="submit" value="Valider">
	</form>

	<?php } else {

	$resultat = $citationManager->vote($_SESSION['num'], $_SESSION['numero'],$_POST['note']);

	echo "La citation a été notée"
			}?>
	<?php } ?>
