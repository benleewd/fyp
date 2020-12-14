<?php

class constants
{
    public $cid;
    public $name;
    public $value;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;

    public function __construct($cid="", $name="", $value="", 
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->cid = $cid;
        $this->name = $name;
        $this->value = $value;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }
    
}

?>