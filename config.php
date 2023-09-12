<?php

function tt($str){
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}
function tte($str){
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    exit();
}

const APP_MAIN_PATH = 'mini-crm';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'crm';