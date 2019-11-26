<?php
class SalarieManager{

  // ATTRIBUTS
  private $db;

  // CONSTRUCTEUR
	public function __construct($db){
			$this->db = $db;
  }
  // FONCTIONS

  //fonction qui retourne un tableau d'objet citation.
  public function getListSal($num) {
          $listeSalarie = array();

          $sql = 'SELECT per_prenom, per_mail, per_tel, sal_telprof, fon_libelle FROM PERSONNE p
                  JOIN SALARIE s ON p.per_num=s.per_num
                  JOIN FONCTION f ON s.fon_num=f.fon_num
                  WHERE p.per_num = '. $num;
          $requete = $this->db->query($sql);
          $requete->execute();
          while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
              $listeSalarie[] = new Salarie($salarie);

          $requete->closeCursor();
          return $listeSalarie;
    }

    public function addSalarie($salarie) {
      $req = $this->db->prepare(
        'INSERT INTO salarie (per_num, sal_telprof, fon_num)
         VALUES (:num, :telPro, :fonNum)');
        $req->bindValue(':num', $salarie->getSalNum());
        $req->bindValue(':telPro', $salarie->getTelPro());
        $req->bindValue(':fonNum', $salarie->getFonNum());
        $req->execute();
    }
}
