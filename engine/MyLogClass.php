<?php

class MyLogClass{
    private $logsFolder;
    private $logsSize;

    function __construct($logsFolder, $logsSize=100){
        $this->logsFolder = $logsFolder;
        $this->logsSize = $logsSize;
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
        if(count($arr)> $this->logsSize) unset($arr[0]);
        file_put_contents($this->logsFolder, $arr);
    }
}