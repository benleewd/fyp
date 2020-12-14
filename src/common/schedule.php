<?php

class schedule
{
    public $year;
    public $month;
    public $day;
    public $shifts;
    public $siteID;
    public $employeeID;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;

    public function __construct($year="", $month="", $day="", $siteID="", $shifts="",  $employeeID="", 
        $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->shifts = $shifts;
        $this->siteID = $siteID;
        $this->employeeID = $employeeID;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }
    
}

?>