<?php
	$pdo=new Mypdo();
	$citationManager = new CitationManager($pdo);
  $personneManager = new PersonneManager($pdo);
  $personnes=$personneManager->getListSalarie();
	$citations=$citationManager->getList();
?>


<h1>Rechercher une citation</h1>
<?php  if(empty($_POST['nom']) && empty($_POST['citation']) && empty($_POST['date'])) {?>
  <form class="" action="#" method="post">
  <label>Enseignant : </label>
  <select name="nom">
    <?php foreach ($personnes as $personne) { ?>
      <option value="<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNom(); ?></option>
    <?php } ?>
  </select><br><br>
  <label for="date1">Compris entre le :</label>
  <input type="date" name="date1" value="2000-01-01">
  <label for="date2">et le :</label>
  <input type="date" name="date2" value="2020-01-01"><br><br>
  <label> Note comprise entre : </label>
  <input type="number" name="basse" value="0" min="0" max="19">
  <label> et : </label>
  <input type="number" name="haute" value="20" min="1" max="20">
  <br><br>
  <button type="submit" name="button">Rechercher</button>
  </form>

<?php } else {
  $bonneCitations=$citationManager->getBonnesCitations($_POST['nom'],$_POST['date1'],$_POST['date2'],$_POST['basse'],$_POST['haute']);

  ?>
  <table>
    <tr>
      <th>Nom de l'enseignant</th>
      <th>Libellé</th>
      <th>Date</th>
      <th>Moyenne des note</th>
    </tr>
    <?php foreach ($bonneCitations  as $citation) { ?>
    <tr>
        <td><?php echo $citation->getCitNomEnseignant(); ?></td>
        <td><?php echo $citation->getCitLibelle(); ?></td>
        <td><?php echo $citation->getCitDate(); ?></td>
        <td><?php echo $citation->getCitMoyenne();?></td>
    </tr>
    <?php } ?>
  </table>
<?php } ?>
