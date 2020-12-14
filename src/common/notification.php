<?php

class notification
{
    public $nid;
    public $title;
    public $body;
    public $type;
    public $eid;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;

    public function __construct($nid="", $title="", $body="", $type="", 
        $eid="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->nid = $nid;
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
        $this->eid = $eid;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }
    
}

?>