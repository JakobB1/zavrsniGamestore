<?php

if($_SERVER['SERVER_ADDR']==='127.0.0.1'){
    $url='http://zavrsnigamestore.xyz/';
    $dev=true;
    $baza=[
        'server'=>'localhost',
        'baza'=>'gamestore',
        'korisnik'=>'edunova',
        'lozinka'=>'edunova'
    ];
}else{
    $url='https://polaznik36.edunova.hr/';
    $dev=false;
    $baza=[
        'server'=>'localhost',
        'baza'=>'gamestore',
        'korisnik'=>'cerera',
        'lozinka'=>'Jakob8765'
    ];
}

return [
    'dev'=>$dev,
    'url'=>$url,
    'rpp'=>10, // rows per page
    'titleApp'=>'Zavrsni APP',
    'basse'=>$base
];
