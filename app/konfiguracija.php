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
    $url='https://polaznik36.edunova.hr/';
    $dev=false;
    $baza=[
        'server'=>'localhost',
        'baza'=>'cerera_edunovapp24',
        'korisnik'=>'cerera_korisnik',
        'lozinka'=>'5I;Efs8kIU,i'
    ];
}

return [
    'dev'=>$dev,
    'url'=>$url,
    'rps'=>10, // rezultata po stranici
    'naslovApp'=>'Gametrgovina APP',
    'baza'=>$baza
];