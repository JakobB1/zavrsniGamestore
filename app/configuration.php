<?php

if($_SERVER['SERVER_ADDR']==='127.0.0.1'){
    $url='http://zavrsnigamestore.xyz/';
    $dev=true;
    $base=[
        'server'=>'localhost',
        'base'=>'gamestore',
        'user'=>'edunova',
        'password'=>'edunova'
    ];
}else{
    $url='https://polaznik36.edunova.hr/';
    $dev=false;
    $base=[
        'server'=>'localhost',
        'base'=>'gamestore',
        'user'=>'edunova',
        'password'=>'edunova'
    ];
}

return [
    'dev'=>$dev,
    'url'=>$url,
    'rpp'=>10, // rows per page
    'titleApp'=>'Edunova APP',
    'base'=>$base
];
