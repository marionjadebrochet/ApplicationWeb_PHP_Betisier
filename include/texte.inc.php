<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];}
	else
	{$page=0;
	}
switch ($page) {
//
// Personnes
//

case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;
case 1:
	// inclure ici la page insertion nouvelle personne
	include("pages/listerPersonnes.inc.php");
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/ajouterPersonne.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/ModifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/ajouterCitation.inc.php');
    break;
//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
    include("pages/listerCitation.inc.php");
    break;

case 6:
	// inclure ici la page liste des citations
	include("pages/rechercherCitation.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	include("pages/validerCitation.inc.php");
    break;

case 8:
// inclure ici la page lister  ville
	include("pages/supprimerCitation.inc.php");
    break;

//

//
case 9:
	include("pages/listerVilles.inc.php");
    break;
case 10:
	include("pages/ajouterVille.inc.php");
    break;

case 11:
	include("pages/modifierVille.inc.php");
    break;

case 12:
	include("pages/supprimerVille.inc.php");
    break;

case 13:
	include("pages/supprimerPersonne.inc.php");
    break;

case 14:
	include("pages/detailPersonne.inc.php");
    break;

case 15:
			include("pages/connexion.inc.php");
 break;

case 16:
		include("pages/deconnexion.inc.php");
break;

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
