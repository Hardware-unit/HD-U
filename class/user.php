<?php
class User{

    private $ID;
    private $Nom;
    private $Prenom;
    private $Email;
    private $MotDePasse;
    private $Date_De_Naissance;
    private $Droit;
    private $tel;
    private $sexe;
    private $confirme;

    public function __construct($obj)
    {
        $_params = array_keys(get_class_vars(get_class($this)));// re demander a lvll
        foreach ($obj as $k => $v)
            if (in_array($k, $_params))
                $this->$k = $v;
    }


    public function getID()
    {
        return $this->ID;
    }
    public function setID($value)
    {
        return $this->ID=$value;
    }


    public function getNom()
    {
        return $this->Nom;
    }
    public function setNom($value)
    {
        return $this->Nom=$value;
    }


    public function getPrenom()
    {
        return $this->Prenom;
    }
    public function setPrenom($value)
    {
        return $this->Prenom=$value;
    }


    public function getEmail()
    {
        return $this->Email;
    }
    public function setEmail($value)
    {
        return $this->Email=$value;
    }


    public function getMotDePasse()
    {
        return $this->MotDePasse;
    }
    public function setMotDePasse($value)
    {
        return $this->MotDePasse=$value;
    }


    public function getDate_De_Naissance()
    {
        return $this->Date_De_Naissance;
    }
    public function setDate_De_Naissance($value)
    {
        return $this->Date_De_Naissance=$value;
    }


    public function getDroit()
    {
        return $this->Droit;
    }
    public function setDroit($value)
    {
        return $this->Droit=$value;
    }


    public function getTel()
    {
        return $this->tel;
    }
    public function setTel($value)
    {
        return $this->tel=$value;
    }


    public function getSexe()
    {
        return $this->sexe;
    }
    public function setSexe($value)
    {
        return $this->sexe=$value;
    }
    

    public function getConfirme()
    {
        return $this->confirme;
    }
    public function setConfirme($value)
    {
        return $this->confirme=$value;
    }

    
}



?>