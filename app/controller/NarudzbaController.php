<?php

class NarudzbaController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'narudzbe' . DIRECTORY_SEPARATOR;
    private $poruka;
    private $narudzba;
    private $korisnik;

    public function __construct()
    {
        parent::__construct();
        $this->narudzba = new stdClass();
        $this->korisnik = new stdClass();
        $this->narudzba->sifra=0;
        $this->narudzba->korisnik='';
        $this->narudzba->cijena='';
        $this->narudzba->placanje='';
        $this->narudzba->datum='';
        }

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'narudzbe' => Narudzba::read(),
            'korisnici' => Korisnik::read()
        ]);
    }

    public function detalji($sifra=0)
    {
        if($sifra===0){
            $this->view->render($this->viewDir . 'detalji',[
                'narudzba'=>$this->narudzba,
                'poruka'=>'Unesite tražene podatke',
                'akcija'=>'Dodaj novi'
            ]);
        }else{
            $this->view->render($this->viewDir . 'detalji',[
                'narudzba'=>Narudzba::readOne($sifra),
                'poruka'=>'Promjenite podatke',
                'akcija'=>'Promjena'
            ]);
        }

    }

    public function akcija()
    {
        if($_POST['sifra']===0){
            // prvo kontrole
            Narudzba::create($_POST);
        }else{
            Narudzba::update($_POST);
        }
        header('location:' . App::config('url').'narudzba/index');

    }

    public function brisanje($sifra)
    {
        Narudzba::delete($sifra);
         
    }
}