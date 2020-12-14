<?php

class empA
{
    public $eid;
    public $country;
    public $blockNo;
    public $unitNo;
    public $streetName;
    public $postalCode;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($country="", $blockNo="", $unitNo="", $streetName="", $postalCode="", $eid="",
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->country = $country;
        $this->blockNo = $blockNo;
        $this->unitNo = $unitNo;
        $this->streetName = $streetName;
        $this->postalCode = $postalCode;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>