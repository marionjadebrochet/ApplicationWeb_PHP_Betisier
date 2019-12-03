<?php $db = new Mypdo();
  $personneManager = new PersonneManager($db);
	$listesPersonnes = $personneManager->getList();
?>

<div class="titre">
	<h1>Modifier une personne enregistrées</h1>
  <p> Pas du tout fini </p>
</div>

<?php
if (empty($_GET['numero'])) {
?>
 <table>
	 <tr><th>Nom</th><th>Prenom</th><th>Modifier</th></tr>
	 <?php foreach ($listesPersonnes as $personne){ ?>
	      <tr>
	        <td><?php echo $personne->getPerNom();?></td>
          <td><?php echo $personne->getPerPrenom();?></td>
	        <td><a href="index.php?page=3&numero=<?php echo $personne->getPerNum(); ?>"><img src="./image/modifier.png" alt=""> </a></td>
	      </tr>
	    <?php } ?>
	  </table>
	  <br />

<?php } else {
  $iterator = 0;

  while($listePersonnes[$iterator] != $_GET['numero']) {
    $iterator++;
  }

  $personne = $listePersonnes[$iterator];
?>

  <form action="#" method="post">
		<label for="Nom">Nom :</label>
		<input type="text" name="nom" id="Nom" value="$personne->getPerNum()"/> <br>
		<label for="Prenom">Prenom :</label>
		<input type="text" name="prenom" id="Prenom" /> <br>
		<label for="Telephone">Téléphone :</label>
		<input type="tel" name="tel" id="Telephone" /> <br>
		<label for="Mail">Mail :</label>
		<input type="email" name="mail" id="Mail" /> <br>
		<label for="Login">Login :</label>
		<input type="text" name="login" id="Login" /> <br>
		<label for="Motdepasse">Mot de passe :</label>
		<input type="password" name="mdp" id="Motdepasse" /> <br>
		<label>Catégorie :</label>
		<input type="radio" name="categorie" id="Etudiant" value="etudiant"/>
		<label for='Etudiant'>Etudiant</label>
		<input type="radio" name="categorie" id="Salarie" value="salarie"/>
		<label for='Salarie'>Salarié</label><br>
		<input type="submit" name="submit" value="Valider" />
	</form>

<?php	}?>
