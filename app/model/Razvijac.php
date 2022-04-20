<?php

class Razvijac
{
    // CRUD
    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from razvijac where sifra=:parametar;
        
        '); 
        $izraz->execute(['parametar'=>$kljuc]);
        return $izraz->fetch();
    }

    // R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select r.sifra , r.naziv , r.drzava , r.webstranica, 
            count(ig.sifra) as igre
            from razvijac r left join igra ig
            on r.sifra = ig.razvijac_id 
            group by r.sifra , r.naziv , r.drzava , r.webstranica;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    // C - Create
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            insert into razvijac (naziv,drzava,webstranica)
            values (:naziv,:drzava,:webstranica);
        
        '); 
        $izraz->execute($parametri);
        
    }

    //U - Update
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            update razvijac set 
                naziv=:naziv,
                drzava=:drzava,
                webstranica=:webstranica
                where sifra=:sifra;
        
        '); 
        $izraz->execute($parametri);
        
    }

    // D - Delete

    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            delete from razvijac where sifra=:sifra;
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}