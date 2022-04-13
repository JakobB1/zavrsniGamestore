<?php

class Predlozak
{

    // select n.sifra          ** OPCIJA 1 readone
    // , k.ime 
    // , k.prezime 
    // , n.cijena 
    // , n.placanje 
    // , n.datum 
    // , i.naziv
    // from narudzba n 
    // inner join korisnik k on n.korisnik_id = k.sifra 
    // inner join narudzba_igra ni on n.sifra = ni.narudzba_id
    // inner join igra i on ni.igra_id = i.sifra 
    // where n.sifra = :parametar 


    // select i.naziv              **OPCIJA 2
    // from narudzba_igra ni 
    // inner join igra i on i.sifra = ni.igra_id 
    // where ni.narudzba_id = :parametar  

    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        
        
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
        
            select n.sifra , k.ime , k.prezime , n.cijena , n.placanje , n.datum 
            , count(ni.igra_id) as igre
            from narudzba n 
            inner join korisnik k on n.korisnik_id = k.sifra 
            left join narudzba_igra ni on n.sifra = ni.narudzba_id
            group by n.sifra , k.ime , k.prezime , n.cijena , n.placanje , n.datum
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function readMany($korisnik_kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select n.sifra , k.ime , k.prezime , n.cijena , n.placanje , n.datum 
            , count(ni.igra_id) as igre
            from narudzba n 
            inner join korisnik k on n.korisnik_id = k.sifra 
            left join narudzba_igra ni on n.sifra = ni.narudzba_id
            where k.sifra = :parametar
            group by n.sifra , k.ime , k.prezime , n.cijena , n.placanje , n.datum
        
        '); 
        $izraz->execute(['parametar'=>$korisnik_kljuc]);
        return $izraz->fetch(); // promjeniti u fetchAll po potrebi
    }

    //C - Create
    // $parametri su asocijativni niz - tako mi odgovara
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL INSERT
        
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