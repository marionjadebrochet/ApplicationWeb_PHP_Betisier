<?php
	$pdo=new Mypdo();
	$personneManger = new PersonneManager($pdo);
	$salarieManager = new SalarieManager($pdo);
	$etudiantManger = new EtudiantManager($pdo);
	$salarie=$salarieManager->getListSal($_GET["per_num"]);
	$etudiant=$etudiantManger->getListEtu($_GET["per_num"]);

  if ($personneManger->estSalarie($_GET["per_num"])) {
?>

<div class="titre">
	<h1> Détail sur le salarié <?php $_GET["per_nom"] ?> </h1>
</div>
<br/>
<table>
	<tr>
		<th> Prénom </th>
		<th> Mail </th>
		<th> Tel </th>
    <th> Tel pro </th>
    <th> Fonction </th>
	</tr>
	<tr>
		<td><?php echo $salarie[0]->getPerPrenom();?></td>
		<td><?php echo $salarie[0]->getPerMail();?></td>
		<td><?php echo $salarie[0]->getTel();?></td>
		<td><?php echo $salarie[0]->getTelPro();?></td>
		<td><?php echo $salarie[0]->getFonction();?></td>
	</tr>
	</table>
	<br />

<?php } else { ?>

<div class="titre">
	<h1> Détail sur l'étudiant <?php $_GET["per_nom"]  ?></h1>
</div>
<br/>
<table>
	<tr>
		<th> Prénom </th>
		<th> Mail </th>
		<th> Tel </th>
		<th> Département </th>
		<th> Ville </th>
	</tr>
	<tr>
		<td><?php echo $etudiant[0]->getPerPrenom();?></td>
		<td><?php echo $etudiant[0]->getPerMail();?></td>
		<td><?php echo $etudiant[0]->getPerTel();?></td>
		<td><?php echo $etudiant[0]->getDepNom();?></td>
		<td><?php echo $etudiant[0]->getVilNom();?></td>
	</tr>
	</table>
	<br />

<?php }
?>
