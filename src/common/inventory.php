<?php

class inventory
{
    public $sku;
    public $name;
    public $qty;
    public $desc;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($sku="", $name="", $qty="", $desc="",
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->qty = $qty;
        $this->desc = $desc;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>