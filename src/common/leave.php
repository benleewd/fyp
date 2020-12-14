<?php

class leave
{
    public $eid;
    public $fromDate;
    public $toDate;
    public $status;
    public $leaveType;
    public $remarks;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;
    public $nric;


    public function __construct($eid="", $fromDate="", $toDate="", $status="", $leaveType="",
        $remarks="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="", $nric="")
    {
        $this->eid = $eid;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->status = $status;
        $this->leaveType = $leaveType;
        $this->remarks = $remarks;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
        $this->nric = $nric;
    }

}




?>