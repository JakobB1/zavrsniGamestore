<?php

class Igra
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
            , r.sifra as razvijac_id 
            , iz.sifra as izdavac_id
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
            , count(ni.sifra) as broj_narudzbi
            from igra i 
            inner join razvijac r on r.sifra = i.razvijac_id 
            inner join izdavac iz on iz.sifra = i.izdavac_id
            left join narudzba_igra ni on i.sifra = ni.igra_id
            group by  i.sifra, i.naziv, i.zanr, i.cijena , i.datumizlaska, r.naziv ,iz.naziv;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    //C - Create
    // $parametri su asocijativni niz - tako mi odgovara
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        
        insert into igra(naziv,zanr,cijena,datumizlaska,razvijac_id,izdavac_id)
        values (:naziv,:zanr,:cijena,:datumizlaska,:razvijac,:izdavac);
        
        '); 
        $izraz->execute([
            'naziv'=>$parametri['naziv'],
            'zanr'=>$parametri['zanr'],
            'cijena'=>$parametri['cijena'],
            'datumizlaska'=>$parametri['datumizlaska'],
            'razvijac'=>$parametri['razvijac'],
            'izdavac'=>$parametri['izdavac']
        ]);

        $zadnjaSifra = $veza->lastInsertId();
        $sifraIgra = $veza->lastInsertId();
        $veza->commit();   
        return $sifraIgra;
    }
    

    //U - Update
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        update igra set 
                naziv=:naziv,
                zanr=:zanr,
                cijena=:cijena,
                datumizlaska=:datumizlaska,
                razvijac_id=:razvijac,
                izdavac_id=:izdavac
                where sifra=:sifra;

        
        '); 
        $izraz->execute([
            'naziv'=>$parametri['naziv'],
            'zanr'=>$parametri['zanr'],
            'cijena'=>$parametri['cijena'],
            'datumizlaska'=>$parametri['datumizlaska'],
            'razvijac'=>$parametri['razvijac'],
            'izdavac'=>$parametri['izdavac'],
            'sifra'=>$parametri['sifra']
        ]);
        
    }

    //D - Delete
    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            delete from igra where sifra=:sifra;
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}