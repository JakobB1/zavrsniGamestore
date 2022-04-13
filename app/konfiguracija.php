<?php

if($_SERVER['SERVER_ADDR']==='127.0.0.1'){
    $url='http://gamestorehrv.xyz/';
    $dev=true;
    $baza=[
        'server'=>'localhost',
        'baza'=>'gametrgovina',
        'korisnik'=>'edunova',
        'lozinka'=>'edunova'
    ];
}else{
    $url='https://predavac01.edunova.hr/';
    $dev=false;
    $baza=[
        'server'=>'localhost',
        'baza'=>'cesar_edunovapp24',
        'korisnik'=>'cesar_korisnik',
        'lozinka'=>'xs7v,uMlH8hl'
    ];
}

return [
    'dev'=>$dev,
    'url'=>$url,
    'rps'=>10, // rezultata po stranici
    'naslovApp'=>'Gamestore APP',
    'baza'=>$baza
];
