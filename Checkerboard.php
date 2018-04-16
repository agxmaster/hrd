<?php
class Checkerboard{

    public $map = [];

    public $generals = [];

    const BEGINMAP = [
        Setting::MACHAO => [1,1],
        Setting::CAOCAO => [2,1],
        Setting::ZHAOYUN => [4,1],
        Setting::HUANGZHONG => [1,3],
        Setting::GUANYU => [2,3],
        Setting::ZHANGFEI => [4,3],
        Setting::ZU => [[1,5], [4,5], [2,4], [3,4]]
    ];

    public function __construct()
    {
        $this->initGeneral();
        $this->initMap();

    }
    public function initGeneral(){
        $this->generals[] = new FuckFuck(Self::BEGINMAP[Setting::CAOCAO][0],Self::BEGINMAP[Setting::CAOCAO][1]);
        $this->generals[] = new God(Self::BEGINMAP[Setting::GUANYU][0],Self::BEGINMAP[Setting::GUANYU][1]);
        $this->generals[] = new Soldier(Self::BEGINMAP[Setting::ZU][0][0], Self::BEGINMAP[Setting::ZU][0][1], 'zu');
        $this->generals[] = new Soldier(Self::BEGINMAP[Setting::ZU][1][0], Self::BEGINMAP[Setting::ZU][1][1],'zu');
        $this->generals[] = new Soldier(Self::BEGINMAP[Setting::ZU][2][0], Self::BEGINMAP[Setting::ZU][2][1],'zu');
        $this->generals[] = new Soldier(Self::BEGINMAP[Setting::ZU][3][0], Self::BEGINMAP[Setting::ZU][3][1],'zu');
        $this->generals[] = new TigerGeneral(Self::BEGINMAP[Setting::ZHANGFEI][0], Self::BEGINMAP[Setting::ZHANGFEI][1],Setting::ZHANGFEI);
        $this->generals[] = new TigerGeneral(Self::BEGINMAP[Setting::ZHAOYUN][0], Self::BEGINMAP[Setting::ZHAOYUN][1],Setting::ZHAOYUN);
        $this->generals[] = new TigerGeneral(Self::BEGINMAP[Setting::MACHAO][0], Self::BEGINMAP[Setting::MACHAO][1],Setting::MACHAO);
        $this->generals[] = new TigerGeneral(Self::BEGINMAP[Setting::HUANGZHONG][0], Self::BEGINMAP[Setting::HUANGZHONG][1],Setting::HUANGZHONG);

    }

    public function initMap(){

        for($i = 1; $i <= Setting::BOARDWIDTH; $i++){
            for ($j = 1;$j <= Setting::BOARDHEIGHT; $j++){
                $this->map[$i . ',' . $j] = null;
            }
        }
        $this->settingMap();
    }

    public function settingMap($generals = null){
        if($generals) $this->generals = $generals;
        foreach($this->generals as $general){
            for($i = $general->xPoint; $i < ($general->xPoint + $general->width); $i ++){
                for($j = $general->yPoint; $j < ($general->yPoint + $general->height); $j++){
                    $this->map[$i . ',' . $j] = $general->name;
                }
            }
        }
    }
}