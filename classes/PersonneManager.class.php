<?php
class PersonneManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }

  // FONCTIONS

  //fonction qui retourne un tableau d'objet personne.
  public function getList() {
          $listePersonne = array();

          $sql = 'select per_num, per_nom, per_prenom from personne';
          $requete = $this->db->query($sql);
          $requete->execute();
          while ($personne = $requete->fetch(PDO::FETCH_OBJ))
              $listePersonne[] = new Personne($personne);

          $requete->closeCursor();
          return $listePersonne;
    }

    //fonction qui retourne un tableau d'objet personne de type salarie.
    public function getListSalarie() {
            $listeSalarie = array();

            $sql = 'select per_nom, p.per_num from personne p join salarie s on p.per_num=s.per_num';
            $requete = $this->db->query($sql);
            $requete->execute();
            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                $listeSalarie[] = new Personne($personne);

            $requete->closeCursor();
            return $listeSalarie;
      }
    //fonction qui retourne un tableau d'objet personne qui n'existe pas dans citation
    //Cette fonction est utilisée pour ne pas supprimer une prsonne qui a une citation car sinon on doit aussi supprimer la citation.
    public function getListPersonneSansCitation() {
            $listePersonne1 = array();

            $sql = 'select p.per_num, p.per_nom from personne p where per_num not in (select per_num from citation)';
            $requete1 = $this->db->query($sql);
            $requete1->execute();
            while ($personne = $requete1->fetch(PDO::FETCH_OBJ))
                $listePersonne1[] = new Personne($personne);

            $requete1->closeCursor();
            return $listePersonne1;
      }
    //fonction qui retourne le nombre de personne
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

      //fonction pour supprimer une ville
      public function delete($personne) {
        $req = $this->db->prepare('delete from salarie where per_num ='. $personne);
        $req->execute();
        $req = $this->db->prepare('delete from etudiant where per_num ='. $personne);
        $req->execute();
        $req = $this->db->prepare('delete from personne where per_num ='. $personne);
        $req->execute();
        }

        public function isEtudiant($num) {
          $sql = 'SELECT count(*) as etudiant FROM etudiant where per_num ='.$num;
          $requete = $this->db->query($sql);
          $res = $requete->fetch();

          if ($res["etudiant"] == 1) {
            return true;
          } else {
            return false;
          }
          $requete->closeCursor();
        }
}

?>
