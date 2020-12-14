<?php

class inventoryOrder
{
    public $eid;
    public $sku;
    public $dateOrdered;
    public $qtyOrdered;
    public $dateIssued;
    public $dateCollected;
    public $remarks;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($eid="", $sku="", $dateOrdered="", $qtyOrdered="", $dateIssued="",
    $dateCollected="", $remarks="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->sku = $sku;
        $this->dateOrdered = $dateOrdered;
        $this->qtyOrdered = $qtyOrdered;
        $this->dateIssued = $dateIssued;
        $this->dateCollected = $dateCollected;
        $this->remarks = $remarks;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>