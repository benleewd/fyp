<?php

class accessControl
{
    public $designation;
    public $pageAccess;
    public $accessible;
    public $module;
    public $type;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;

    public function __construct($designation="", $pageAccess="", $accessible=false, $module="", 
        $type="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->designation = $designation;
        $this->pageAccess = $pageAccess;
        $this->accessible = $accessible;
        $this->module = $module;
        $this->type = $type;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }
    
}

?>