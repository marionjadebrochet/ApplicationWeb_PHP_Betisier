<?php
	$pdo=new Mypdo();
	$citationManager = new CitationManager($pdo);
  $personneManager = new PersonneManager($pdo);
  $personnes=$personneManager->getListSalarie();
	$citations=$citationManager->getList();
?>
<h1>Ajouter une citation </h1>
<?php if ( empty($_POST["enseignant"]) && empty($_POST["Date"]) &&
empty($_POST["citation"]) ) { ?>

	<form name="ajCitation" id="ajCitation" action="#" method="post" >

    <label>Enseignant : </label>
    <select class="champ" id="enseignant" name="enseignant" required>
      <?php
			foreach ($personnes as $personne) { ?>
				<option value="<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNom(); ?></option>
			<?php } ?>
      </select>

		<label> Date citation : </label>
		<input type="date" size = 30 maxlength = 50 name="date" required>
    <label> Citation : </label>
		<textarea rows="3" size="30" name="citation" required></textarea>

		<input type=submit value="Valider">
	</form>

<?php } else {
	$citation = explode(" ", $_POST["citation"]);
	$citationCorrigee = "";
	 $iterateur = 0;
			while (!empty($citation[$iterateur]))  {
				$mot = $citation[$iterateur];
				if (!$citationManager->isValide($mot) ) {
					$citationCorrigee = $citationCorrigee.$mot.' ';
				} else {
					$citationCorrigee = $citationCorrigee.'--- ';
				}
				$iterateur++;
			}
  if ($citationCorrigee != $_POST["citation"]." " ) {?>

  <form name="ajCitation" id="ajCitation" action="#" method="post" >

    <label>Enseignant : </label>
		<select class="champ" id="enseignant" name="enseignant" required>
      <?php
			foreach ($personnes as $personne) { ?>
				<option value="<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNom(); ?></option>
			<?php } ?>
      </select>

		<label> Date Citation : </label>
		<input type="date" size = 30 maxlength = 50 name="date" value="<?php echo $_POST["date"]; ?>">
		<label> Citation : </label>
		<textarea rows="3" cols="30" name="citation" ><?php echo $citationCorrigee; ?></textarea>
<?php
		$iterateur = 0;
			 while (!empty($citation[$iterateur]))  {
				 $mot = $citation[$iterateur];
				 if ( $citationManager->isValide($mot) ) {
					echo '<img class = "icone" src="image/erreur.png" alt="ajCitation"/> Le mot : <label style="color : red;">'.$mot.'</label> n\'est pas autorisé<br />';
				 }
				 $iterateur++;
			 }
			 ?>

		 </p>
		<input type=submit value="Valider">
	</form>

<?php } else {
		$tab = array('per_num' => $_POST['enseignant'],
									'cit_date' => $_POST['date'],
									'cit_libelle' => $_POST['citation'],
									'per_num_etu' => $_SESSION['num'],
								'cit_date_depo' => $_POST['date']);
		$citation = new Citation($tab);
		$citationManager->add($citation); ?>

		<p><img class = "icone" src="image/valid.png" alt="ajCitation"/> La citation a été ajouté !</p>

		<meta http-equiv="refresh" content="2; URL=index.php?page=0">
		<p> Redirection automatique dans 2 secondes. </p>

<?php  }
}?>
