<?php

class empE
{
    public $eid;
    public $joinDate;
    public $empType;
    public $contractSD;
    public $contractED;
    public $probationSD;
    public $probationED;
    public $confirmDate;
    public $designation;
    public $department;
    public $supervisorID;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($joinDate="", $empType="", $contractSD="", $contractED="", $probationSD="", $probationED="", $confirmDate="", 
    $designation="", $department="", $supervisorID="", $eid="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->joinDate = $joinDate;
        $this->empType = $empType;
        $this->contractSD = $contractSD;
        $this->contractED = $contractED;
        $this->probationSD = $probationSD;
        $this->probationED = $probationED;
        $this->confirmDate = $confirmDate;
        $this->designation = $designation;
        $this->department = $department;
        $this->supervisorID = $supervisorID;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>