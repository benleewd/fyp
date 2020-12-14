<?php

class site
{
    public $projectID;
    public $projectName;
    public $shifts;
    public $publicHoliday;
    public $siteAllowance;
    public $employeesRequired;
    public $qrCode;
    public $address;
    public $long;
    public $lat;
    public $active;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;

    public function __construct($projectID="", $projectName="", $shifts="", $publicHoliday=true, 
        $siteAllowance=0, $employeesRequired=0, $qrCode="", $address="", $long="", $lat="", $active=false, $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->projectID = $projectID;
        $this->projectName = $projectName;
        $this->shifts = $shifts;
        $this->publicHoliday = $publicHoliday;
        $this->siteAllowance = $siteAllowance;
        $this->employeesRequired = $employeesRequired;
        $this->qrCode = $qrCode;
        $this->address = $address;
        $this->long = $long;
        $this->lat = $lat;
        $this->active = $active;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }
    
}

?>