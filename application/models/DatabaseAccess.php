<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseAccess extends CI_Model 
{
    public function login($mail,$pass){
        $query="select * from admin where email=%s or name=%s and pass=%s";
        $query=sprintf($query,$this->db->escape($mail),$this->db->escape($mail),$this->db->escape($pass));
        $result=$this->db->query($query);
        if($result->num_rows()==1){
            return $result->result();
        } else {
            return false;
        }
    }

    public function getAllTitles()
    {
        $array=array();
        $query="select * from titles";
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row) {
            $array['idtitles'][]=$row['idtitles'];
            $array['name'][]=$row['name'];
            $array['importance'][]=$row['importance'];
        }
        return $array;
    }

    public function insertBaseInfo($values,$titles)
    {
        $query="insert into titleValues values";
        for ($i=0; $i <count($values) ; $i++) { 
            $query=$query."(default,'".$values['form_'.$titles['idtitles'][$i]]."',".$titles['idtitles'][$i].",'1')";
            if ($i<count($values)-1) {
                $query=$query.",";
            }
        }   
        $this->db->query($query);
    }

    public function getLegalInfo()
    {
        $array=array();
        $query="select * from legalInfo";
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['idinfo'][]=$row['idinfo'];
            $array['intitule'][]=$row['intitule'];
        }
        return $array;
    }

    public function insertLegalInfo($values,$legal){
        $query="insert into legalvalues values";
        for ($i=0; $i <count($values) ; $i++) { 
            $query=$query."(default,'".$legal['idinfo'][$i]."','".$values['legal_'.$legal['idinfo'][$i]]."')";
            if ($i<count($values)-1) {
                $query=$query.",";
            }
        }   
        $this->db->query($query);
    }

    public function insertPCG($numero,$nom){
        $verify="select * from pcg where numero=".$numero;
        $ver=$this->db->query($verify);
        if ($ver->num_rows()>=1) {
            throw new Exception("Ce numero est deja utilise");
        }
        if (strlen($numero)<5) {
            for ($i=0; $i <= 5-strlen($numero); $i++) { 
                $numero=$numero."0";
            }
        }
        $query="insert into pcg values(default,%s,%s)";
        $query=sprintf($query,$this->db->escape($numero),$this->db->escape($nom));
        $this->db->query($query);
    }

    public function insertJournal($numero,$nom){
        $query="insert into codeJournal values(default,%s,%s)";
        $query=sprintf($query,$this->db->escape($numero),$this->db->escape($nom));
        $this->db->query($query);
    }

    public function insertTier($numero,$nom){
        $query="insert into codetier values(default,%s,%s)";
        $query=sprintf($query,$this->db->escape($numero),$this->db->escape($nom));
        $this->db->query($query);
    }

    public function getAllCodeJoural()
    {
        $array=array();
        $query="select * from codejournal";
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['id'][]=$row['id'];
            $array['numero'][]=$row['numero'];
            $array['intitule'][]=$row['intitule'];
        }
        return $array;
    }
    public function newJournal($idcode,$date,$idexo)
    {
        $dateString="%Y-%m-%d";
        if (empty($date)) {
            $date=time();
        }
        $date=mdate($dateString,$date);
        $query="insert into journal values(default,%s,%s,%s,NULL) returning id";
        $query=sprintf($query,$this->db->escape($idcode ),$this->db->escape($idexo),$this->db->escape($date));
        $returnValue=$this->db->query($query);
        return $returnValue->row()->id;
    }
    public function getAllRef()
    {
        $query="select * from reference";
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['idref'][]=$row['idref'];
            $array['code'][]=$row['code'];
            $array['intitule'][]=$row['intitule'];
        }
        return $array;
    }
    public function getAllDevise()
    {
        $query="select * from devise";
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['iddevise'][]=$row['iddevise'];
            $array['intitule'][]=$row['intitule'];
            $array['typeDevise'][]=$row['typedevise'];
        }
        return $array;
    }
    public function getAllPcg()
    {
        $query="select * from pcg";
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['id'][]=$row['id'];
            $array['numero'][]=$row['numero'];
            $array['intitule'][]=$row['intitule'];
        }
        return $array;
    }
    public function getTier(){
        $query="select * from codetier";
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['id'][]=$row['id'];
            $array['numero'][]=$row['numero'];
            $array['intitule'][]=$row['intitule'];
        }
        return $array;
    }
    public function getTodaysChange($idDevise){
        $query="select valeur from detaildevise where iddevise=".$idDevise." order by jour limit 1";
        $result=$this->db->query($query);
        $row=$result->result_object();
        return $row->valeur;
    }

    public function getDetailJournalById($id)
    {
        $query="select * from codeJournal where id=".$id;
        $result=$this->db->query($query);
        return $result->result_array();
    }

    public function getInvalidJournal(){
        $query="select * from journal where datecloture is NULL";
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $journal=$this->getDetailJournalById($row['idcode']);
            $array['id'][]=$row['id'];
            $array['numero'][]=$journal[0]['numero'];
            $array['intitule'][]=$journal[0]['intitule'];
            $array['datedebut'][]=$row['datedebut'];
        }
        return $array;
    }

    public function getWritedEcriture($idjournal)
    {
        $query="select Ecriture.*,pcg.intitule as pcg,codetier.intitule as tier,devise.intitule as devise from Ecriture 
        join pcg on Ecriture.idpcg=pcg.id 
        left join codetier on Ecriture.idtier=codetier.id
        join devise on devise.iddevise=Ecriture.iddevise
        where idjournal=".$idjournal;
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['idecriture'][]=$row['idecriture'];
            $array['idjournal'][]=$row['idjournal'];
            $array['reference'][]=$row['reference'];
            $array['idpcg'][]=$row['idpcg'];
            $array['idtier'][]=$row['idtier'];
            $array['libelle'][]=$row['libelle'];
            $array['iddevise'][]=$row['iddevise'];
            $array['montantdevise'][]=$row['montantdevise'];
            $array['debit'][]=$row['debit'];
            $array['credit'][]=$row['credit'];
            $array['pcg'][]=$row['pcg'];
            $array['tier'][]=$row['tier'];
            $array['devise'][]=$row['devise'];
        }
        return $array;
    }

    public function insertEcriture($data)
    {
        $query="insert into ecriture values(default,%s,%s,%s,%s,%s,%s,%s,%s,%s)";
        $tier='NULL';
        if (!empty($data['idtier'])) {
            $tier=$data['idtier'];
        }
        $query=sprintf($query,$this->db->escape($data['idjournal']),$this->db->escape($data['piece'].$data['numero']),$this->db->escape($data['idpcg']),$tier,$this->db->escape($data['libelle']),$this->db->escape($data['iddevise']),$this->db->escape($data['montant']),$this->db->escape($data['debit']),$this->db->escape($data['credit']));
        $result=$this->db->query($query);
        return $result;
    }
    public function isValide($idjournal)
    {
        $bool=false;
        $query="select idjournal,sum(debit) as debit,sum(credit) as credit from Ecriture group by idjournal having idjournal=".$idjournal; 
        $result=$this->db->query($query);
        $row=$result->result_array();
        if ($row[0]['debit']==$row[0]['credit']) {
            $bool=true;
        }
        return $bool;
    }
    public function validate($idjournal)
    {
        if ($this->isValide($idjournal)==true) {
            $query="update journal set datecloture=CURRENT_DATE where id=".$idjournal;
            $this->db->query($query);
        } else {
            throw new Exception("Journal non balance");
        }
    }

    public function getBigBook($idcompte)
    {
       $query="select ecriture.*,pcg.intitule as pcg,codejournal.numero as num from ecriture join pcg on ecriture.idpcg=pcg.id join journal on ecriture.idjournal=journal.id 
       join codejournal on codejournal.id=journal.idcode 
       where idpcg=".$idcompte;
       $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['idecriture'][]=$row['idecriture'];
            $array['idjournal'][]=$row['idjournal'];
            $array['reference'][]=$row['reference'];
            $array['idpcg'][]=$row['idpcg'];
            $array['idtier'][]=$row['idtier'];
            $array['libelle'][]=$row['libelle'];
            $array['iddevise'][]=$row['iddevise'];
            $array['montantdevise'][]=$row['montantdevise'];
            $array['debit'][]=$row['debit'];
            $array['credit'][]=$row['credit'];
            $array['pcg'][]=$row['pcg'];
            $array['num'][]=$row['num'];
        }
        return $array;
    }
    public function Balance()
    {
        $query="select pcg.numero,pcg.intitule,sum(debit) as debit,sum(credit) as credit from Ecriture join pcg on pcg.id=Ecriture.idpcg group by pcg.numero,pcg.intitule";
        $array= array();
        $result=$this->db->query($query);
        foreach($result->result_array() as $row){
            $array['numero'][]=$row['numero'];
            $array['intitule'][]=$row['intitule'];
            $array['debit'][]=$row['debit'];
            $array['credit'][]=$row['credit'];
            $array['soldeDebiteur'][]=0;
            $array['soldeCrediteur'][]=0;
            if ($row['debit']>$row['credit']) {
                $array['soldeCrediteur'][]=$row['debit']-$row['credit'];
            } else if($row['debit']<$row['credit']){
                $array['soldeDebiteur'][]=$row['credit']-$row['debit'];
            }
        }
        return $array;
    }
}