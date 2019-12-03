<?php
$db = new MyPDO();
$personneManager = new PersonneManager($db);
 ?>
<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
		<?php if(empty($_SESSION['nom'])) { ?>
			<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
			<ul>
				<li><a href="index.php?page=1">Lister</a></li>
			</ul>
			<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
			<ul>
				<li><a href="index.php?page=5">Lister</a></li>
			</ul>
			<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
			<ul>
				<li><a href="index.php?page=9">Lister</a></li>
			</ul>
		<?php } else {
			if (!($personneManager->isAdmin($_SESSION['num']))) { ?>
				<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
				<ul>
					<li><a href="index.php?page=1">Lister</a></li>
					<li><a href="index.php?page=2">Ajouter</a></li>
				</ul>
				<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
				<ul>
          <?php if($personneManager->isEtudiant($_SESSION['num'])) { ?>
					<li><a href="index.php?page=4">Ajouter</a></li>
          <?php } ?>
					<li><a href="index.php?page=5">Lister</a></li>
					<li><a href="index.php?page=6">Rechercher</a></li>
				</ul>
				<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
				<ul>
					<li><a href="index.php?page=9">Lister</a></li>
					<li><a href="index.php?page=10">Ajouter</a></li>
					<li><a href="index.php?page=11">Modifier</a></li>
		<?php	} else { ?>
			<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
			<ul>
				<li><a href="index.php?page=1">Lister</a></li>
				<li><a href="index.php?page=2">Ajouter</a></li>
				<li><a href="index.php?page=3">Modifier</a></li>
				<li><a href="index.php?page=13">Supprimer</a></li>
			</ul>
			<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
			<ul>
				<li><a href="index.php?page=4">Ajouter</a></li>
				<li><a href="index.php?page=5">Lister</a></li>
				<li><a href="index.php?page=6">Rechercher</a></li>
				<li><a href="index.php?page=7">Valider</a></li>
				<li><a href="index.php?page=8">Supprimer</a></li>
			</ul>
			<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
			<ul>
				<li><a href="index.php?page=9">Lister</a></li>
				<li><a href="index.php?page=10">Ajouter</a></li>
				<li><a href="index.php?page=11">Modifier</a></li>
				<li><a href="index.php?page=12">Supprimer</a></li>
			</ul>
	<?php	}}?>
	</div>
</div>
