<?php
	$pdo=new Mypdo();
	$villeManager = new VilleManager($pdo);
	$villes=$villeManager->getList();
?>
	<div class="titre">
		<h1>Liste des villes</h1>
	</div>
	<?php
	echo "Actuellement ". $villeManager->countVille() . " villes sont enregistrées"
	?>
	<br/>
	<br/>
	<table>
		<tr><th>Numéro</th><th>Nom</th></tr>
	<?php foreach ($villes as $ville){ ?>
			<tr><td><?php echo $ville->getVilNum();?>
			</td><td><?php echo $ville->getVilNom();?>
			</td></tr>
	<?php } ?>
	</table>
	<br />
