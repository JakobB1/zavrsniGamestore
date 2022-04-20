<?php

class KorisnikController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'korisnici' . DIRECTORY_SEPARATOR;
    private $poruka;
    private $korisnik;

    public function __construct()
    {
        parent::__construct();
        $this->korisnik = new stdClass();
        $this->korisnik->sifra=0;
        $this->korisnik->ime='';
        $this->korisnik->prezime='';
        $this->korisnik->korisnicko='';
        $this->korisnik->oib='';
        $this->korisnik->email='';
        $this->korisnik->narudzba='';
        }

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'entiteti' => Korisnik::read()
        ]);
    }

    public function detalji($sifra=0)
    {
        if($sifra===0){
            $this->view->render($this->viewDir . 'detalji',[
                'korisnik'=>$this->korisnik,
                'poruka'=>'Unesite tražene podatke',
                'akcija'=>'Dodaj novi'
            ]);
        }else{
            $this->view->render($this->viewDir . 'detalji',[
                'korisnik'=>Korisnik::readOne($sifra),
                'poruka'=>'Promjenite podatke',
                'akcija'=>'Promjena'
            ]);
        }

    }

    public function akcija()
    {
        if($_POST['sifra']==0){
            // prvo kontrole
            Korisnik::create($_POST);
        }else{
            Korisnik::update($_POST);
        }
        header('location:' . App::config('url').'korisnik/index');

    }

    public function brisanje($sifra)
    {
        Korisnik::delete($sifra);
        header('location:' . App::config('url').'korisnik/index');
    }
}