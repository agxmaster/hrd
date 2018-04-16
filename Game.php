<?php
class Game{

    private $checkerBoard;
    public $step = [];
    private $stepMask = [];
    public $success = [];
    public $goCount = 0;
    public $stepCount = 0;
    const GOMAX = 0;

    public function __construct()
    {
        $this->checkerBoard = new Checkerboard();
    }

    public function play(){
        ksort($this->checkerBoard->map);
        $this->step[] = $this->checkerBoard->map;
        $this->stepMask[] = md5(json_encode($this->checkerBoard->map));
        return $this->go();
    }
    public function go(&$laststep = null){
//        if(!empty($this->success)) exit;
        if(self::GOMAX && $this->goCount > self::GOMAX){
            return 'Max go Count.';
        }
        $this->stepCount ++;
        $backGenerals = $this->checkerBoard->generals;
        $backMap = $this->checkerBoard->map;
        $backStep = $this->step;
        foreach ($this->checkerBoard->generals as &$general){
            foreach(['down','up','left','right'] as $direction){
                $step = new Step($direction,$general);
                $this->goCount++;
                $step->stepCount = $this->stepCount;
                $step->goCount = $this->goCount;
                if($this->checkMove($general, $step) && $this->move($general, $step)){
                    $this->saveStep();
                    if(!$this->success($general,$step)){
                        $this->go($step);
                    }else{
                        return 'success';
                    }
                }
            }
        }
        $this->checkerBoard->generals = $backGenerals;
        $this->checkerBoard->map = $backMap;
        $this->step = $backStep;
        if(count($this->step) > 0){
            $this->back($laststep);
        }
        return 'Finished.';
    }

    public function saveStep(){

        ksort($this->checkerBoard->map);
        $this->stepMask[] = md5(json_encode($this->checkerBoard->map));
        $this->step[] = $this->checkerBoard->map;
    }

    public function checkMove(General $general, Step &$step){
        for($i = 0; $i < $general->{$step->range}; $i++){
            $step->move();
            if(!array_key_exists($step->getPoint($i),$this->checkerBoard->map) ||
                null != $this->checkerBoard->map[$step->getPoint($i)]){
                $step->moveBack();
                return false;
            }
        }
        return true;
    }

    public function checkStepd(){
        ksort($this->checkerBoard->map);
        if(in_array(md5(json_encode($this->checkerBoard->map)), $this->stepMask)){
            return true;
        }
        return false;
    }

    public function move($general, Step $step){
        for($i = 0; $i < $general->width; $i++){
            $step->moveBack();
            $this->checkerBoard->map[$step->getPoint($i)] = null;
            $step->move();
            $this->checkerBoard->map[$step->getPoint($i)] = $step->general->name;
        }
        if($this->checkStepd()){
            for($i = 0; $i < $general->width; $i++) {
                $step->moveBack();
            }
            $this->checkerBoard->map = $this->step[count($this->step) - 1];
            return false;
        }
        return true;
    }

    public function back(&$step){
        if($step != null){
            array_pop($this->step);
            array_pop($this->stepMask);
            $this->checkerBoard->map = $this->step[count($this->step) - 1];
            for($i = 0; $i < $step->general->width; $i++) {
                $step->moveBack();
            }
        }
    }
    public function success(&$general,&$step){
        if($general instanceof FuckFuck){
            if($general->xPoint == 2 && $general->yPoint == 4) {
                $this->success[] = $this->step;
                $this->back($step);
                echo "succes............";
                return true;
            }
        }
        return false;
    }
}