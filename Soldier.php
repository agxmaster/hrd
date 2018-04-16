<?php
class Soldier extends General{
    public function __construct($xPoint, $yPoint, $name = '')
    {
        $this->height = 1;
        $this->width = 1;
        parent::__construct($xPoint, $yPoint, $name);
    }
}