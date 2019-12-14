<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonne = $personneManager->getList();
$estSalarie= $personneManager->estSalarie($_GET["numero"]);
$divisionManager = new DivisionManager($pdo);
$divisions=$divisionManager->getList();
$departementManager = new DepartementManager($pdo);
$departements=$departementManager->getList();
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);
$fonctionManager = new FonctionManager($pdo);
$fonctions=$fonctionManager->getList();



$listePersonne = $personneManager->getList();
$iterateur = 0;
while ($listePersonne[$iterateur]->getPerNum() != $_GET["numero"] ) {
  $iterateur = $iterateur + 1;
}
$personne = $listePersonne[$iterateur];

if((empty($_POST['anneeEtu'])) && (empty($_POST['telSal'])) && empty($_POST["prenom"])) {
   $estEtudiant = $personneManager->isEtudiant($_GET["numero"]);
  $_SESSION['etudiant'] = $estEtudiant;
  ?>

  <h1>Modifier une personne</h1>

  <form action="#" method="post">
    <label> Nom :</label>
    <input type="text" name="nom" value=<?php echo $personne->getPerNom();?> > <br>
    <label>Prénom : </label>
    <input type="text" name="prenom" value=<?php echo $personne->getPerPrenom();?>> <br>
    <label>Téléphone :</label>
    <input type="text" name="tel" value=<?php echo $personne->getPerTel();?>> <br>
    <label>Mail :</label>
    <input type="text" name="mail" value=<?php echo $personne->getPerMail();?>> <br>
    <label>Login :</label>
    <input type="text" name="login" value=<?php echo $personne->getPerLogin();?>> <br>
    <label for="Motdepasse">Mot de passe :</label>
    <input type="password" name="mdp" id="Motdepasse" value=""/> <br>
    <label>Catégorie : </label>
    <?php if ($_SESSION['etudiant'] == 1){ ?>
      <input type="radio" name="categorie" id="Etudiant" value="etudiant" checked/> Etudiant
      <input type="radio" name="categorie" id="Salarie" value="salarie"/> Salarié <br><br>
    <?php }else{ ?>
      <input type="radio" name="categorie" id="Etudiant" value="etudiant"/> Etudiant
      <input type="radio" name="categorie" id="Salarie" value="salarie" checked/> Salarié <br><br>
    <?php } ?>
    <button type="submit" name="Valider">Valider</button>
  </form>
<?php }else{
  if (!empty($_POST["categorie"]))
  {
    $_SESSION["categorie"] = $_POST["categorie"];

  }
  if(!empty($_POST) && empty($_POST["anneeEtu"]) && empty($_POST["telSal"]))
  {
    $_SESSION['personne'] = serialize(new Personne(array ('per_nom' => $_POST['nom'],
    'per_prenom' => $_POST['prenom'],
    'per_tel' => $_POST['tel'],
    'per_mail' => $_POST['mail'],
    'per_login' => $_POST['login'],
    'per_pwd' => $_POST['mdp'])));

  }
  //PARTIE CONCERNANT LA SELECTION ETUDIANT
  if ($_SESSION['etudiant'] == 1) {

    $personne = unserialize($_SESSION['personne']);
    $personneManager->update($personne, $_GET["numero"]);


    if($_SESSION['categorie'] == "etudiant"){


      if (empty($_POST["anneeEtu"])){ ?>
        <h1>Modifier un etudiant</h1>

        <form action="#" method="post">
          <label for="annee">Année :</label>
          <select id="anneeEtu" name="anneeEtu">
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
      <?php }else{ ?>
        <?php
        $etudiant = new Etudiant(array('per_num' => $_GET["numero"], 'dep_num' => $_POST['dep'],'div_num' => $_POST['anneeEtu']));
        $etudiantManager->updateEtudiant($etudiant);?>

        <p> L'étudiant à bien été modifié </p>
      <?php } ?>
    <?php }else{

      if (!empty($_POST["categorie"]))
      {
        $_SESSION["categorie"] = $_POST["categorie"];

      }

      $personne = unserialize($_SESSION['personne']);
      $personneManager->update($personne, $_GET["numero"]);
      $etudiantManager->suppEtu($_GET["numero"]);

      if (empty($_POST["telSal"])){
        ?>

        <h1>Changer en Salarie</h1>

        <form action="#" method="post">
          <label for="Nom">Téléphone professionnel :</label>
          <input type="tel" name="telSal" id="tel" /> <br>
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

        <?php
//NE PASSSE PAS DANS CETTE BOUCLE C4ETAIT PAS CA LERREUR CEST LA CONDITION
      } else {
        $salarie = new Salarie(array('per_num' => $_GET["numero"], 'sal_telprof' => $_POST['telSal'], 'fon_num' => $_POST['fon']));
        print_r($salarie);
        $salarieManager->updateEtuEnSalarie($salarie);

        ?><p> L'étudiant à bien été modifié,et c'est devenu un salarié</p><?php
      }  ?>
    <?php }

    //PARTIE CONCERNANT LA SELECTION SALARIE

  }else{

    $personne = unserialize($_SESSION['personne']);
    $personneManager->update($personne, $_GET["numero"]);
    $estSalarie= $personneManager->estSalarie($_GET["numero"]);

    if($_SESSION['categorie'] == "salarie"){

      if (empty($_POST["telSal"])){
        ?>

        <h1>Modifier un salarié</h1>

        <form action="#" method="post">
          <label for="Nom">Téléphone professionnel :</label>
          <input type="tel" name="telSal" id="tel" /> <br>
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

      <?php }else{
        $salarie = new Salarie(array('per_num' => $_GET["numero"], 'sal_telprof' => $_POST['telSal'], 'fon_num' => $_POST['fon']));
        $salarieManager->updateSalarie($salarie);

        ?>  <p> Le salarié à bien été modifié</p> <?php
      }
      ?>
    <?php }else{

      if (!empty($_POST["categorie"]))
      {
        $_SESSION["categorie"] = $_POST["categorie"];

      }
      $personne = unserialize($_SESSION['personne']);
      $personneManager->update($personne, $_GET["numero"]);
      $salarieManager->suppSal($_GET["numero"]);


      if (empty($_POST["anneeEtu"])){

        $_SESSION["categorie"] = $_POST["categorie"];

        ?>

        <h1>Changer en étudiant</h1>

        <form action="#" method="post">
          <label for="annee">Année :</label>
          <select id="anneeEtu" name="anneeEtu">
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

        <?php
      }else{
        $etudiant = new Etudiant(array('per_num' => $_GET["numero"], 'dep_num' => $_POST['dep'],'div_num' => $_POST['anneeEtu']));
        $etudiantManager->updateSalEnEtu($etudiant);

        ?>  <p> Le salarié à bien été modifié, et c'est devenu un étudiant</p> <?php
      }
      ?>


    <?php }
  }
} ?>
