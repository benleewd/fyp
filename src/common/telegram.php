<?php

class telegram
{
    public $tid;
    public $eid;
    public $telegramID;
    public $chatID;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;
    public $nric;

    public function __construct($eid="", $telegramID="", $chatID="", 
        $createdDT="", $createdBy="", $lastModDT="", $lastModBy="", $tid="", $nric="")
    {
        $this->tid = $tid;
        $this->eid = $eid;
        $this->telegramID = $telegramID;
        $this->chatID = $chatID;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
        $this->nric = $nric;
    }
    
}

?>