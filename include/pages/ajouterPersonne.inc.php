<?php
$pdo=new Mypdo();
$personneManager = new PersonneManager($pdo);
$divisionManager = new DivisionManager($pdo);
$divisions=$divisionManager->getList();
$departementManager = new DepartementManager($pdo);
$departements=$departementManager->getList();
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);
$fonctionManager = new FonctionManager($pdo);
$fonctions=$fonctionManager->getList();
?>

<?php
if (empty($_POST["nom"]) && empty($_POST["dep"]) && empty($_POST['annee']) && empty($_POST['tel'])) { ?>

	<h1>Ajouter une personne</h1>

	<form action="#" method="post">
		<label for="Nom">Nom :</label>
		<input type="text" name="nom" id="Nom" /> <br>
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
<?php }

if(!empty($_POST["nom"]) && $_POST['categorie'] == "etudiant") {
	$_SESSION['personne'] = serialize(new Personne(array ('per_nom' => $_POST['nom'],
	'per_prenom' => $_POST['prenom'],
	'per_tel' => $_POST['tel'],
	'per_mail' => $_POST['mail'],
	'per_login' => $_POST['login'],
	'per_pwd' => $_POST['mdp'])));?>

	<h1>Ajouter un étudiant</h1>

	<form action="#" method="post">
		<label for="annee">Année :</label>
		<select id="annee" name="annee">
			<?php foreach ($divisions as $division) { ?>
				<option value="<?php echo $division->getDivNum();?>"><?php echo $division->getDivNom(); ?></option>
			<?php } ?>
		</select> <br>
		<label for="departement">Département : </label>
		<select id="dep" name="dep">
			<?php foreach ($departements as $departement) { ?>
				<option value="<?php echo $departement->getDepNum();?>"><?php echo $departement->getDepNom(); ?></option>
			<?php } ?>
		</select> <br>
		<input type="submit" value="Valider">
	</form>

<?php }

if(empty($_POST['categorie']) && !empty($_POST['annee'])) {

	$personneManager->addPersonne(unserialize($_SESSION['personne']));
	$id = $personneManager->lastInsertId();
	$etudiant = new Etudiant(array('per_num' => $id,
	'dep_num' => $_POST['dep'],
	'div_num' => $_POST['annee']));

	$result = $etudiantManager->addEtudiant($etudiant);

	if($result == 0) {
		echo "L'étudiant à bien été ajouté";
	} else {
		echo "Erreur";
	}
}

if (!empty($_POST["nom"]) && $_POST['categorie'] == "salarie") {
	$_SESSION['personne'] = serialize(new Personne(array ('per_nom' => $_POST['nom'],
	'per_prenom' => $_POST['prenom'],
	'per_tel' => $_POST['tel'],
	'per_mail' => $_POST['mail'],
	'per_login' => $_POST['login'],
	'per_pwd' => $_POST['mdp'])));?>

	<h1>Ajouter une salarié</h1>

	<form action="#" method="post">
		<label for="Nom">Téléphone professionnel :</label>
		<input type="tel" name="tel" id="tel" /> <br>
		<br>
		<label for="Nom">Fonction :</label>
		<select id="fon" name="fon">
			<?php foreach ($fonctions as $fonction) {?>
				<option value="<?php echo $fonction->getFonNum() ?>"><?php echo $fonction->getFonLib(); ?></option>
			<?php }?>
		</select>
		<br>
		<input type="submit" name="submit" value="Valider" />
	</form>
<?php	}

if(empty($_POST['categorie']) && !empty($_POST['tel'])) {
	$personneManager->addPersonne(unserialize($_SESSION['personne']));
	$id = $personneManager->lastInsertId();
	$salarie = new Salarie(array('per_num' => $id,
																'sal_telprof' => $_POST['tel'],
																'fon_num' => $_POST['fon']));

	$result = $salarieManager->addSalarie($salarie);

	if($result == 0) {
		echo "Le salarié à bien été ajouté";
	} else {
		echo "Erreur";
	}
}
?>
