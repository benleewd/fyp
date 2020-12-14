<?php

class shiftType
{
    public $shiftName;
    public $timeStart;
    public $timeEnd;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;

    public function __construct($shiftName="", $timeStart="", $timeEnd="", 
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->shiftName = $shiftName;
        $this->timeStart = $timeStart;
        $this->timeEnd = $timeEnd;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }
    
}

?>