<?php

class empC
{
    public $eid;
    public $emergencyCN;
    public $relationship;
    public $emergencyCD;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($emergencyCN="", $relationship="", $emergencyCD="", $eid="",
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->emergencyCN = $emergencyCN;
        $this->relationship = $relationship;
        $this->emergencyCD = $emergencyCD;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>