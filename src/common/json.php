<?php

class json
{
    public $status;
    public $message;
    public $data;

    public function __construct($status=404, $message="Object creation error", $data=[])
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
    
}

?>