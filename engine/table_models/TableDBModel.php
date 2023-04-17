<?php

namespace table_models;
require_once(dirname(__DIR__, 1).'/DB.php');
use \DB;

// Класс модели таблицы БД
class TableDBModel{
    protected $db;

    function __construct(DB $db){
        $this->db = $db;
    }
}