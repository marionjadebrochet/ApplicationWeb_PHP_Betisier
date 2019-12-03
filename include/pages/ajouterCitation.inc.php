//NE FONCTIONNE PAS, je ne sais pas comment recupere le
per_num_etu c'est à dire l'étudiant qui ajoute la citation
//Je n'ai pas fait les restrictions du texte.

<?php
	$pdo=new Mypdo();
	$citationManager = new CitationManager($pdo);
  $personneManager = new PersonneManager($pdo);
  $personnes=$personneManager->getListSalarie();
	$citations=$citationManager->getList();
?>
<div class="titre">
<h1>Ajouter une citation</h1>
</div>

<?php if (empty($_POST["citation"])){ ?>

  <form class="" action="#" method="post">
    <label>Enseignant : </label>
    <select name="nom">
      <?php foreach ($personnes as $personne) { ?>
        <option value="<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNom(); ?></option>
      <?php } ?>
    </select><br><br>
    <label> Date Citation : </label>
 		<input type="date" name="date"><br><br>
    <label> Citation :</label><br><br>
    <textarea name="citation" rows="6" cols="60">Ecrit ici ta citation</textarea><br>
    <button type="submit" name="button">Valider</button>
  </form>

<?php } else {

	$citation = new Citation (array('per_num' => $_POST['nom'],
								 									'cit_libelle' => $_POST['citation'],
							 	 									'cit_date' => $_POST['date'],
							   									'cit_date_depo' => $_POST['date'],));

  $citationManager->add($citation);
  echo "La citation a été ajouté";
} ?>
