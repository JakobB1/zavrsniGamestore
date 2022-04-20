<?php

class Korisnik
{


    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select k.sifra, 
                k.ime,
                k.prezime, 
                k.korisnicko, 
                k.oib, 
                k.email 
                from korisnik k left join narudzba n on
                n.korisnik_id = k.sifra
                where k.sifra = :parametar
        
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
        
        select k.sifra, 
            k.ime,
            k.prezime, 
            k.korisnicko, 
            k.oib, 
            k.email,
            count(n.sifra) as narudzba  
            from korisnik k left join narudzba n on
            n.korisnik_id = k.sifra
            group by k.sifra,k.ime,k.prezime, k.korisnicko, k.oib, k.email
        
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
        
        insert into korisnik(ime,prezime,korisnicko,oib,email)
        values (:ime,:prezime,:korisnicko,:oib,:email);
        
        '); 
        $izraz->execute([
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'korisnicko'=>$parametri['korisnicko'],
            'oib'=>$parametri['oib'],
            'email'=>$parametri['email']
        ]);
        
    }
    

    //U - Update
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        update korisnik set 
                ime=:ime,
                prezime=:prezime,
                korisnicko=:korisnicko,
                oib=:oib,
                email=:email
                where sifra=:sifra;
        
        '); 
        $izraz->execute($parametri);
        
    }

    //D - Delete
    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
             delete from korisnik where sifra=:sifra;
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}