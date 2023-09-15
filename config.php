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

function isComparedUrl($url){

    if($_SERVER['REQUEST_URI'] == $url){
      return  'active'; 
    }else {
        return '';
        }
    // print_r($_SERVER['REQUEST_URI']);
}
const APP_MAIN_PATH = 'mini-crm';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'crm';