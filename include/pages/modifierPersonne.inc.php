<?php $db = new Mypdo();
$personneManager = new PersonneManager($db);
$listePersonnes = $personneManager->getList();
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
        <td><a href="index.php?page=17&numero=<?php echo $personne->getPerNum(); ?>"><img src="./image/modifier.png" alt=""> </a></td>
      </tr>
    <?php } ?>
  </table>
  <br />
