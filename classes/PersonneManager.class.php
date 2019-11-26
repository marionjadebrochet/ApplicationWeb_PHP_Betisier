<?php
class PersonneManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet citation.
  public function getList() {
          $listePersonne = array();

          $sql = 'SELECT per_num, per_nom, per_prenom FROM personne';
          $requete = $this->db->query($sql);
          $requete->execute();
          while ($personne = $requete->fetch(PDO::FETCH_OBJ))
              $listePersonne[] = new Personne($personne);

          $requete->closeCursor();
          return $listePersonne;
    }

    //fonction qui retourne le nombre de citation
    public function countPersonne() {
            $sql = 'SELECT count(per_num) as nbrPersonne FROM PERSONNE';
            $requete = $this->db->query($sql);
            $count = $requete->fetch();
            $requete->closeCursor();
            return $count['nbrPersonne'];
      }

    //fonction qui permet de voir si le numero sur lequel on clique est un salarié
    public function estSalarie($numero) {
            $sql = 'SELECT count(*) as nbrSalarie from SALARIE where per_num =' . $numero;
            $requete = $this->db->query($sql);

            $nbrSalarie = $requete->fetch();

            if ($nbrSalarie['nbrSalarie']==0) {
              return false;
            } else {
              return true;
            }

            $requete->closeCursor();
    }

    public function addPersonne($personne) {
      $req = $this->db->prepare(
        'INSERT INTO PERSONNE (per_admin, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd)
         VALUES (:admin, :nom, :prenom, :tel, :mail, :login, :pwd)');
        $req->bindValue(':nom', $personne->getPerNom());
        $req->bindValue(':prenom', $personne->getPerPrenom());
        $req->bindValue(':tel', $personne->getPerTel());
        $req->bindValue(':mail', $personne->getPerMail());
        $req->bindValue(':login', $personne->getPerLogin());
        $req->bindValue(':pwd', $personne->getPerPWD());
        $req->bindValue(':admin', 0);
        $req->execute();
      }

    public function lastInsertId() {
      $req = $this->db->query("select LAST_INSERT_ID()");
      $req->execute();
      $lastId = $req->fetchColumn();
      return $lastId;
    }

    public function isAdmin($num) {
      $sql = 'SELECT count(*) as admin FROM personne where per_admin = 1 and per_num ='.$num;
      $requete = $this->db->query($sql);
      $res = $requete->fetch();

      if ($res["admin"] == 1) {
        return true;
      } else {
        return false;
      }
      $requete->closeCursor();
    }
}

?>
