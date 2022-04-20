<?php

class IzdavacController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'izdavaci' . DIRECTORY_SEPARATOR;
    private $poruka;
    private $izdavac;

    public function __construct()
    {
        parent::__construct();
        $this->izdavac = new stdClass();
        $this->izdavac->naziv='';
        $this->izdavac->drzava='';
        $this->izdavac->webstranica='';
        }

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'entiteti' => Izdavac::read()
        ]);
    }

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',[
            'poruka'=>'',
            'izdavac'=>$this->izdavac
        ]);
    }

    public function promjena($id)
    {
        $this->izdavac = Izdavac::readOne($id);

        $this->view->render($this->viewDir . 'promjena',[
            'poruka'=>'Promjenite podatke',
            'izdavac'=>$this->izdavac
        ]);
    }

    public function dodajNovi()
    {
        $this->pripremiPodatke();

        if($this->kontrolaNaziv()
        && $this->kontrolaDrzava()
        && $this->kontrolaWebstranica()){
            Izdavac::create((array)$this->izdavac);
            header('location:' . App::config('url').'izdavac/index');
        }else{
            $this->view->render($this->viewDir.'novi',[
                'poruka'=>$this->poruka,
                'izdavac'=>$this->izdavac
            ]);
        }
    }

    public function promjeni()
    {
        $this->pripremiPodatke();
        
        if($this->kontrolaNaziv()
        && $this->kontrolaDrzava()
        && $this->kontrolaWebstranica()){
            Izdavac::update((array)$this->izdavac);
            header('location:' . App::config('url').'izdavac/index');
        }else{
            $this->view->render($this->viewDir.'promjena',[
                'poruka'=>$this->poruka,
                'izdavac'=>$this->izdavac
            ]);
        }
    }

    public function brisanje($sifra)
    {
        Izdavac::delete($sifra);
        //$this->index();
        header('location:' . App::config('url').'izdavac/index');
    }

    private function pripremiPodatke()
    {
        $this->izdavac=(object)$_POST;
    }

    private function kontrolaNaziv()
    {
        if(strlen($this->izdavac->naziv)===0){
            $this->poruka='Naziv obavezno';
            return false;
        }
        if(strlen($this->izdavac->naziv)>50){
            $this->poruka='Naziv ne smije biti duži od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaDrzava()
    {
        if(strlen($this->izdavac->drzava)===0){
            $this->poruka='Drzava obavezna';
            return false;
        }
        if(strlen($this->izdavac->drzava)>50){
            $this->poruka='Drzava ne smije biti duža od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaWebstranica()
    {
        if(strlen($this->izdavac->webstranica)===0){
            $this->poruka='Webstranica obavezna';
            return false;
        }
        if(strlen($this->izdavac->webstranica)>50){
            $this->poruka='Webstranica ne smije biti duža od 50 znakova';
            return false;
        }

        return true;
    }

    
}