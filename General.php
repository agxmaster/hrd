<?php
class General implements GeneralInterface {

    protected $width;
    protected $height;
    protected $name;
    protected $xPoint;
    public $yPoint;
    public function __construct($xPoint, $yPoint, $name = '')
    {
        if($name) $this->name = $name;
        $this->xPoint = $xPoint;
        $this->yPoint = $yPoint;
    }

    public function __get($attr)
    {
        if(!isset($this->$attr)) throw new Exception("not found attr {$attr}",500);
        return $this->$attr;
    }

    public function __set($attr, $value){
        if(!isset($this->$attr)) throw new Exception("not found attr {$attr}",500);
        $this->$attr = $value;
    }

    public function __toString()
    {
        return sprintf('%s : %d , %d',$this->name,$this->xPoint,$this->yPoint);
    }
}