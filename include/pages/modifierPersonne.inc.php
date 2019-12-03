<?php $db = new Mypdo();
  $personneManager = new PersonneManager($db);
	$personnes = $personneManager->getList();
?>

<div class="titre">
	<h1>Modifier une personne enregistrées</h1>
  <p> Pas du tout fini </p>
</div>

<?php
if (empty($_GET['numero'])) {
?>
 <table>
	 <tr><th>Nom</th><th>Modifier</th></tr>
	 <?php foreach ($personnes as $personne){ ?>
	      <tr>
	        <td><?php echo $personne->getPerNom();?></td>
	        <td><a href="index.php?page=3&numero=<?php echo $personne->getPerNum(); ?>"><img src="./image/modifier.png" alt=""> </a></td>
	      </tr>
	    <?php } ?>
	  </table>
	  <br />

<?php } else {


	    echo 'La personne a été modifiée';

	}?>
