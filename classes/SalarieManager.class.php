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

    $sql = 'select per_prenom, per_mail, per_tel, sal_telprof, fon_libelle from personne p
    join salarie s on p.per_num=s.per_num
    join fonction f on s.fon_num=f.fon_num
    where p.per_num = '. $num;
    $requete = $this->db->query($sql);
    $requete->execute();
    while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
    $listeSalarie[] = new Salarie($salarie);

    $requete->closeCursor();
    return $listeSalarie;
  }

  //fonction qui ajoute un salarié dans AjouterPersonne
  public function addSalarie($salarie) {
    $req = $this->db->prepare(
      'insert into salarie (per_num, sal_telprof, fon_num)
      values (:num, :telPro, :fonNum)');
      $req->bindValue(':num', $salarie->getSalNum());
      $req->bindValue(':telPro', $salarie->getTelPro());
      $req->bindValue(':fonNum', $salarie->getFonNum());
      $req->execute();
    }

    //fonction qui met à jour un salarié dans ModifierPersonne
    public function updateSalarie($salarie){
      $req = $this->db->prepare('update `salarie` set `sal_telprof` = :sal_telprof, `fon_num` = :fon_num where `salarie`.`per_num` = :per_num');
      $req->bindValue(':per_num',$salarie->getSalNum(),PDO::PARAM_STR);
      $req->bindValue(':sal_telprof',$salarie->getTelPro(),PDO::PARAM_STR);
      $req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);

      $retour=$req->execute();
    }

    //fonction qui met à jour un étudiant en salarié dans ModifierPersonne
    public function updateEtuEnSalarie($salarie){
      $req = $this->db->prepare('insert into salarie (per_num, sal_telprof, fon_num) values (:per_num, :sal_telprof, :fon_num)');
      $req->bindValue(':per_num',$salarie->getSalNum(),PDO::PARAM_STR);
      $req->bindValue(':sal_telprof',$salarie->getTelPro(),PDO::PARAM_STR);
      $req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);
      $retour=$req->execute();
    }

    //fonction qui supprime un salarié
    public function suppSal($numero){
      $req = $this->db->prepare('delete from `salarie` where `salarie`.`per_num` = :numero');
      $req->bindValue(':numero',$numero,PDO::PARAM_STR);
      $retour=$req->execute();
    }
  }
