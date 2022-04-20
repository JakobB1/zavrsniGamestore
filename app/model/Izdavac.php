<?php

class Izdavac
{
    // CRUD
    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from izdavac where sifra=:parametar;
        
        '); 
        $izraz->execute(['parametar'=>$kljuc]);
        return $izraz->fetch();
    }

    // R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select i.sifra , i.naziv , i.drzava , i.webstranica, 
            count(ig.sifra) as igre
            from izdavac i left join igra ig
            on i.sifra = ig.izdavac_id 
            group by i.sifra , i.naziv , i.drzava , i.webstranica;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    // C - Create
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            insert into izdavac (naziv,drzava,webstranica)
            values (:naziv,:drzava,:webstranica);
        
        '); 
        $izraz->execute($parametri);
        
    }

    //U - Update
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            update izdavac set 
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
        
            delete from izdavac where sifra=:sifra;
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}