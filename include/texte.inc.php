<?php
$db = new MyPDO();
$personneManager = new PersonneManager($db);
?>

<div id="texte">
	<?php
	if (!empty($_SESSION['num'])) {
	$_SESSION['estEtu'] = $personneManager->isEtudiant($_SESSION['num']);
	$_SESSION['estAdmin'] = $personneManager->isAdmin($_SESSION['num']);
	}

	if (!empty($_GET["page"])) {
		$page=$_GET["page"];
	}	else {
		$page=0;
	}
	switch ($page) {
		case 0:
			include_once('pages/accueil.inc.php');
			break;
		case 1:
			include("pages/listerPersonnes.inc.php");
			break;
		case 2:
			if ($_SESSION['estEtu'] == 1 || $_SESSION['estAdmin'] == 1) {
			include_once('pages/ajouterPersonne.inc.php');
			}
			break;
		case 3:
			if ($_SESSION['estAdmin'] == 1) {
			include("pages/ModifierPersonne.inc.php"); }
			break;
		case 4:
			if ($_SESSION['estEtu'] == 1 ) {
			include_once('pages/ajouterCitation.inc.php'); }
			break;
		case 5:
			include("pages/listerCitation.inc.php");
			break;
		case 6:
			if ($_SESSION['estEtu'] == 1 || $_SESSION['estAdmin'] == 1) {
			include("pages/rechercherCitation.inc.php"); }
			break;
		case 7:
			if ($_SESSION['estEtu'] == 1 || $_SESSION['estAdmin'] == 1) {
			include("pages/validerCitation.inc.php");}
			break;
		case 8:
			if ($_SESSION['estAdmin'] == 1) {
			include("pages/supprimerCitation.inc.php");}
			break;
		case 9:
			include("pages/listerVilles.inc.php");
			break;
		case 10:
			if ($_SESSION['estEtu'] == 1 || $_SESSION['estAdmin'] == 1) {
			include("pages/ajouterVille.inc.php");}
			break;
		case 11:
			if ($_SESSION['estEtu'] == 1 || $_SESSION['estAdmin'] == 1) {
			include("pages/modifierVille.inc.php");}
			break;
		case 12:
			if ($_SESSION['estAdmin'] == 1) {
			include("pages/supprimerVille.inc.php");}
			break;
		case 13:
			if ($_SESSION['estAdmin'] == 1) {
			include("pages/supprimerPersonne.inc.php");}
			break;
		case 14:
			if ($_SESSION['estAdmin'] == 1) {
			include("pages/detailPersonne.inc.php");}
			break;
		case 15:
			include("pages/connexion.inc.php");
			break;
		case 16:
			include("pages/deconnexion.inc.php");
			break;
		case 17:
		if ($_SESSION['estAdmin'] == 1) {
		include("pages/modifierPersonneBis.inc.php"); }
		break;
		default : include_once('pages/accueil.inc.php');
}?>
</div>
