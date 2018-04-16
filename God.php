<?php
class God extends General{

    public function __construct($xPoint, $yPoint, $name = '')
    {
        $this->width = 2;
        $this->height = 1;
        $this->name = "guanyu";
        parent::__construct($xPoint, $yPoint, $name);
    }
}