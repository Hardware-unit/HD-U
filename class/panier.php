<?php
class Panier{

    private $ID;
    private $ID_article;
    private $Qte;
    private $ID_user;

    public function __construct($ID, $ID_article, $Qte, $ID_user){
        $this->ID = $ID;
        $this->ID_article = $ID_article;
        $this->Qte = $Qte;
        $this->ID_user = $ID_user;
    }
    public function getID()
    {
        return $this->ID;
    }
    public function setID($value)
    {
        return $this->ID = $value;
    }

    public function getID_article()
    {
        return $this->ID_article;
    }
    public function setID_article($value)
    {
        return $this->ID_article = $value;
    }

    public function getQte()
    {
        return $this->Qte;
    }
    public function setQte($value)
    {
        return $this->Qte = $value;
    }

    public function getID_user()
    {
        return $this->ID_user;
    }
    public function setID_user($value)
    {
        return $this->ID_user = $value;
    }

}
?>