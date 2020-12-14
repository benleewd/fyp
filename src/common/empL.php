<?php

class empL
{
    public $eid;
    public $leaveType;
    public $daysRemaining;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($eid="", $leaveType="", $daysRemaining="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->leaveType = $leaveType;
        $this->daysRemaining = $daysRemaining;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>