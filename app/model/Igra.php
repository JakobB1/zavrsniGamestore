<?php

class Predlozak
{


    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select i.sifra 
            , i.naziv 
            , i.zanr 
            , i.cijena 
            , i.datumizlaska 
            , r.naziv as razvijac 
            , iz.naziv as izdavac
            from igra i 
            inner join razvijac r on r.sifra = i.razvijac_id 
            inner join izdavac iz on iz.sifra = i.izdavac_id 
            where i.sifra = :parametar;
        
        '); 
        $izraz->execute(['parametar'=>$kljuc]);
        return $izraz->fetch();
    }

    // CRUD

    //R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select i.sifra 
            , i.naziv 
            , i.zanr 
            , i.cijena 
            , i.datumizlaska 
            , r.naziv as razvijac 
            , iz.naziv as izdavac
            from igra i 
            inner join razvijac r on r.sifra = i.razvijac_id 
            inner join izdavac iz on iz.sifra = i.izdavac_id;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    //C - Create
    // $parametri su asocijativni niz - tako mi odgovara
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
          
        
        '); 
        $izraz->execute($parametri);
        
    }
    

    //U - Update
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL UPDATE
        
        '); 
        $izraz->execute($parametri);
        
    }

    //D - Delete
    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            SQL DELETE
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}