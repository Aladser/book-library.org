<?php
require_once(dirname(__DIR__, 1).'/config/config.php');

function writeLog($msg){
    $today = date("Y-m-d H:i:s");
    if(!file_exists(LOGS)){
        file_put_contents(LOGS, "$today $msg;\n");
    }
    else{
        file_put_contents(LOGS, "$today $msg;\n", FILE_APPEND);
    }
    // ограничение размера файла логов
    $arr = file(LOGS);
    if(count($arr)> 100) unset($arr[0]);
    file_put_contents(LOGS, $arr);
}