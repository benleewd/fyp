<?php

class loginAccess
{
    public $eid;
    public $username;
    public $passwordHashed;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($eid="", $username="", $passwordHashed="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->username = $username;
        $this->passwordHashed = $passwordHashed;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>