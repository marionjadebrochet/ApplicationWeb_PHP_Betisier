<?php $db = new Mypdo();
$personneManager = new PersonneManager($db);
$listePersonnes = $personneManager->getList();
?>

<?php
if (empty($_GET['numero'])) {
  ?>
  <div class="titre">
    <h1>Modifier une personne enregistrées</h1>
  </div>
  <table>
    <tr><th>Nom</th><th>Prenom</th><th>Modifier</th></tr>
    <?php foreach ($listePersonnes as $personne){ ?>
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
  while ($listePersonnes[$iterator]->getPerNum() != $_GET['numero'] ) {
    $iterator = $iterator + 1;
  }
  $personne = $listePersonnes[$iterator];

  if ($personneManager->estSalarie($_GET["numero"]))  {
  ?>
    <h1>Modifier un salarié enregistré</h1>

    <form action="#" method="post">
      <label for="Nom">Nom :</label>
      <input type="text" name="nom" id="Nom" value="<?php echo $personne->getPerNom() ?>"/> <br>
      <label for="Prenom">Prenom :</label>
      <input type="text" name="prenom" id="Prenom"  value="<?php echo $personne->getPerPrenom(); ?>"/> <br>
      <label for="Telephone">Téléphone :</label>
      <input type="tel" name="tel" id="Telephone"  value="<?php echo $personne->getPerTel(); ?>"/> <br>
      <label for="Mail">Mail :</label>
      <input type="email" name="mail" id="Mail" value="<?php echo $personne->getPerMail(); ?>"/> <br>
      <label for="Login">Login :</label>
      <input type="text" name="login" id="Login" value="<?php echo $personne->getPerLogin(); ?>"/> <br>
      <label for="Motdepasse">Mot de passe :</label>
      <input type="password" name="mdp" id="Motdepasse" value=""/> <br>
      <label>Catégorie :</label>
      <input type="radio" name="categorie" id="Etudiant" value="etudiant" />
      <label for='Etudiant'>Etudiant</label>
      <input type="radio" name="categorie" id="Salarie" value="salarie" checked/>
      <label for='Salarie'>Salarié</label><br>
      <input type="submit" name="submit" value="Valider" />
    </form>
  <?php }

  if ($personneManager->isEtudiant($_GET["numero"]))  {
  ?>
    <h1>Modifier un étudiant enregistré</h1>

    <form action="#" method="post">
      <label for="Nom">Nom :</label>
      <input type="text" name="nom" id="Nom" value="<?php echo $personne->getPerNom() ?>"/> <br>
      <label for="Prenom">Prenom :</label>
      <input type="text" name="prenom" id="Prenom"  value="<?php echo $personne->getPerPrenom(); ?>"/> <br>
      <label for="Telephone">Téléphone :</label>
      <input type="tel" name="tel" id="Telephone"  value="<?php echo $personne->getPerTel(); ?>"/> <br>
      <label for="Mail">Mail :</label>
      <input type="email" name="mail" id="Mail" value="<?php echo $personne->getPerMail(); ?>"/> <br>
      <label for="Login">Login :</label>
      <input type="text" name="login" id="Login" value="<?php echo $personne->getPerLogin(); ?>"/> <br>
      <label for="Motdepasse">Mot de passe :</label>
      <input type="password" name="mdp" id="Motdepasse" value=""/> <br>
      <label>Catégorie :</label>
      <input type="radio" name="categorie" id="Etudiant" value="etudiant" checked/>
      <label for='Etudiant'>Etudiant</label>
      <input type="radio" name="categorie" id="Salarie" value="salarie" />
      <label for='Salarie'>Salarié</label><br>
      <input type="submit" name="submit" value="Valider" />
    </form>
  <?php } ?>


<?php } ?>
