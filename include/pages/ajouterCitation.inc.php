//Je n'ai pas fait les restrictions du texte Full texte et tout et tout .

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
		<div class="row">
    <label class="auto">Enseignant : </label>
    <select class="auto"name="nom">
      <?php foreach ($personnes as $personne) { ?>
        <option value="<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNom(); ?></option>
      <?php } ?>
    </select>
	</div>
		<div class="row">
    <label class="auto"> Date Citation : </label>
 		<input class="auto"type="date" name="date">
		</div>
		<div class="row">
    <label class="auto"> Citation :</label>
    <textarea class="auto" name="citation" rows="8">Ecrit ici ta citation</textarea>
		</div>
    <button type="submit" name="button">Valider</button>
  </form>

<?php } else {
	$dateDep =  date("Y-m-d H:i:s");
	$citation = new Citation (array('per_num' => $_POST['nom'],
																	'per_num_etu' => $_SESSION['num'],
								 									'cit_libelle' => $_POST['citation'],
							 	 									'cit_date' => $_POST['date'],
							   									'cit_date_depo' => $dateDep,));

  $citationManager->add($citation);
  echo "La citation a été ajouté";
} ?>
