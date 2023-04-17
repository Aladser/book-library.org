<?php

class MyLogClass{
    private $logsFolder;

    function __construct($logsFolder){
        $this->logsFolder = $logsFolder;
    }

    function writeLog($msg){
        $today = date("Y-m-d H:i:s");
        if(!file_exists($this->logsFolder)){
            file_put_contents($this->logsFolder, "$today $msg;\n");
        }
        else{
            file_put_contents($this->logsFolder, "$today $msg;\n", FILE_APPEND);
        }
        // ограничение размера файла логов
        $arr = file($this->logsFolder);
        if(count($arr)> 100) unset($arr[0]);
        file_put_contents($this->logsFolder, $arr);
    }
}