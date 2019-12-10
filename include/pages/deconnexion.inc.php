<?php

  echo "Vous allez être déconnecté <br>";
  echo "Vous allez être redirigé dans 2 secondes";
  $_SESSION['nom'] = null;
  $_SESSION['num'] = null;
  $_SESSION['estEtu'] = null;
  $_SESSION['estAdmin'] = null;
  header("Refresh:2; url=index.php?page=0");

 ?>
