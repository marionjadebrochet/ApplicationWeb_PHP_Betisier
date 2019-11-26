<?php

class ConnexionManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  public function connexion($login,$password)
  {
    $pwd_crypte = $this->getPwdCrypt($password);
    return $this->bonneConnexion($login,$pwd_crypte);
  }

  public function bonneConnexion($login,$pwd_crypte) {
    $req=$this->db->prepare('SELECT per_num from personne where per_login=:login and per_pwd=:pwd');
    $req->bindValue(':login',$login);
    $req->bindValue(':pwd',$pwd_crypte);

    $req->execute();
    $num = $req->fetch(PDO::FETCH_NUM);
    return $num;
  }

  public function getPwdCrypt($pwd)
  {
    $salt="48@!alsd";
    $pwd_crypte = sha1(sha1($pwd).$salt);
    return $pwd_crypte;
  }
}
?>
