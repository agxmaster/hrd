<?php
class TigerGeneral extends General {
    public function __construct($xPoint, $yPoint, $name = '')
    {
        $this->width = 1;
        $this->height = 2;
        parent::__construct($xPoint, $yPoint, $name);
    }
}