<?php
class Step{
    public $range = '';
    public $direction = '';
    public $general;
    public function __construct($direction,&$general){
        $this->general = &$general;
        $this->direction = $direction;
        switch ($direction){
            case 'down':
            case 'up':
                $this->range = 'width';
                break;
            case 'left':
            case 'right':
                $this->range = 'height';
                break;
        }
    }

    public function getPoint($i){
        switch ($this->direction){
            case 'down':
                return ($this->general->xPoint + $i) . ',' . ($this->general->yPoint);
                break;
            case 'up':
                return ($this->general->xPoint + $i) . ',' . ($this->general->yPoint);
                break;
            case 'left':
                return ($this->general->xPoint) . ',' . ($this->general->yPoint + $i);
                break;
            case 'right':
                return ($this->general->xPoint) . ',' . ($this->general->yPoint + $i);
                break;
        }
    }

    public function move(){
        switch ($this->direction){
            case 'down':
                $this->general->yPoint++;
                break;
            case 'up':
                $this->general->yPoint--;
                break;
            case 'left':
                $this->general->xPoint--;
                break;
            case 'right':
                $this->general->xPoint++;
                break;
        }
    }

    public function moveBack(){
        switch ($this->direction){
            case 'down':
                $this->general->yPoint--;
                break;
            case 'up':
                $this->general->yPoint++;
                break;
            case 'left':
                $this->general->xPoint++;
                break;
            case 'right':
                $this->general->xPoint--;
                break;
        }
    }
}