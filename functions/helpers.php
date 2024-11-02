<?php

define('BASE_URL', 'http://localhost/blog/');
function redirect($url){
    header('Location: ' . trim(BASE_URL,'/ ') . '/' . trim($url, '/ '));
}
//redirect('admin/category');

function asset($file)
{
    return trim(BASE_URL,'/ ') . '/' . trim($file, '/ ');
}

function url($url)
{
    return trim(BASE_URL,'/ ') . '/' . trim($url, '/ ');
}

function dd($var)
{
    var_dump($var);
    exit;
}