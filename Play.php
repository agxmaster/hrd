<?php
error_reporting(1);
ini_set('display_errors','on');
ini_set('max_execution_time', '0');
ini_set('memory_limit','500M');
//set_time_limit(300);
include_once "AutoLoad.php";
AutoLoad::regist();
$game = new Game();
echo $game->play();

print_r($game->step);