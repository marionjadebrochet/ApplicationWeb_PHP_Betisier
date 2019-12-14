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
		<div class="row">
			<label class="auto" for="Nom">Nom :</label>
			<input class="auto" type="text" name="nom" id="Nom" />
		</div>
		<div class="row">
			<label class="auto" for="Prenom">Prenom :</label>
			<input class="auto" type="text" name="prenom" id="Prenom" />
		</div>
		<div class="row">
			<label class="auto" for="Telephone">Téléphone :</label>
			<input class="auto" type="tel" name="tel" id="Telephone" />
		</div>
		<div class="row">
			<label class="auto" for="Mail">Mail :</label>
			<input class="auto" type="email" name="mail" id="Mail" />
		</div>
		<div class="row">
			<label class="auto" for="Login">Login :</label>
			<input class="auto" type="text" name="login" id="Login" />
		</div>
		<div class="row">
			<label class="auto" for="Motdepasse">Mot de passe :</label>
			<input class="auto" type="password" name="mdp" id="Motdepasse" />
		</div>
		<div class="row">
			<label>Catégorie :</label>
		</div>
		<div class="row">
			<div class="radio">
				<input type="radio" name="categorie" id="Etudiant" value="etudiant"/>
				<label  for='Etudiant'>Etudiant</label>
			</div>
			<div class="radio">
				<input type="radio" name="categorie" id="Salarie" value="salarie"/>
				<label class="radio" for='Salarie'>Salarié</label>
			</div>
		</div>
			<input type="submit" name="submit" value="Valider" />
	</form>
<?php }

if(!empty($_POST["nom"]) && $_POST['categorie'] == "etudiant") {
	$salt="48@!alsd";
	$pwd_crypte = sha1(sha1($_POST['mdp']).$salt);
	$_SESSION['personne'] = serialize(new Personne(array ('per_nom' => $_POST['nom'],
	'per_prenom' => $_POST['prenom'],
	'per_tel' => $_POST['tel'],
	'per_mail' => $_POST['mail'],
	'per_login' => $_POST['login'],
	'per_pwd' => $pwd_crypte)));?>

	<h1>Ajouter un étudiant</h1>

	<form action="#" method="post">
		<div class="row">
			<label class="auto"for="annee">Année :</label>
			<select class="auto"id="annee" name="annee">
				<?php foreach ($divisions as $division) { ?>
					<option value="<?php echo $division->getDivNum();?>"><?php echo $division->getDivNom(); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="row">
			<label class="auto"for="departement">Département : </label>
			<select class="auto"id="dep" name="dep">
				<?php foreach ($departements as $departement) { ?>
					<option value="<?php echo $departement->getDepNum();?>"><?php echo $departement->getDepNom(); ?></option>
				<?php } ?>
			</select>
		</div>
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
		echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");
	} else {
		echo "Erreur";
		echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");
	}
}

if (!empty($_POST["nom"]) && $_POST['categorie'] == "salarie") {
	$salt="48@!alsd";
	$pwd_crypte = sha1(sha1($_POST['mdp']).$salt);
	$_SESSION['personne'] = serialize(new Personne(array ('per_nom' => $_POST['nom'],
	'per_prenom' => $_POST['prenom'],
	'per_tel' => $_POST['tel'],
	'per_mail' => $_POST['mail'],
	'per_login' => $_POST['login'],
	'per_pwd' => $pwd_crypte)));?>
	
	<h1>Ajouter une salarié</h1>

	<form action="#" method="post">
		<div class="row">
			<label class="auto"for="Nom">Téléphone professionnel :</label>
			<input class="auto"type="tel" name="tel" id="tel" />
		</div>
		<div class="row">
		<label class="auto"for="Nom">Fonction :</label>
		<select class="auto"id="fon" name="fon">
			<?php foreach ($fonctions as $fonction) {?>
				<option value="<?php echo $fonction->getFonNum() ?>"><?php echo $fonction->getFonLib(); ?></option>
			<?php }?>
		</select>
		</div>
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
		echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");
	} else {
		echo "Erreur";
		echo "Redirection automatique dans 2 secondes";
    header("Refresh:2; url=index.php?page=0");
	}
}
?>
