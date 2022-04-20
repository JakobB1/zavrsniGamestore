<?php

class RazvijacController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'razvijaci' . DIRECTORY_SEPARATOR;
    private $poruka;
    private $razvijac;

    public function __construct()
    {
        parent::__construct();
        $this->razvijac = new stdClass();
        $this->razvijac->naziv='';
        $this->razvijac->drzava='';
        $this->razvijac->webstranica='';
        }

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'entiteti' => Razvijac::read()
        ]);
    }

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',[
            'poruka'=>'',
            'razvijac'=>$this->razvijac
        ]);
    }

    public function promjena($id)
    {
        $this->razvijac = Razvijac::readOne($id);

        $this->view->render($this->viewDir . 'promjena',[
            'poruka'=>'Promjenite podatke',
            'razvijac'=>$this->razvijac
        ]);
    }

    public function dodajNovi()
    {
        $this->pripremiPodatke();

        if($this->kontrolaNaziv()
        && $this->kontrolaDrzava()
        && $this->kontrolaWebstranica()){
            Razvijac::create((array)$this->razvijac);
            header('location:' . App::config('url').'razvijac/index');
        }else{
            $this->view->render($this->viewDir.'novi',[
                'poruka'=>$this->poruka,
                'razvijac'=>$this->razvijac
            ]);
        }
    }

    public function promjeni()
    {
        $this->pripremiPodatke();
        
        if($this->kontrolaNaziv()
        && $this->kontrolaDrzava()
        && $this->kontrolaWebstranica()){
            Razvijac::update((array)$this->razvijac);
            header('location:' . App::config('url').'razvijac/index');
        }else{
            $this->view->render($this->viewDir.'promjena',[
                'poruka'=>$this->poruka,
                'razvijac'=>$this->razvijac
            ]);
        }
    }

    public function brisanje($sifra)
    {
        Razvijac::delete($sifra);
        //$this->index();
        header('location:' . App::config('url').'razvijac/index');
    }

    private function pripremiPodatke()
    {
        $this->razvijac=(object)$_POST;
    }

    private function kontrolaNaziv()
    {
        if(strlen($this->razvijac->naziv)===0){
            $this->poruka='Naziv obavezno';
            return false;
        }
        if(strlen($this->razvijac->naziv)>50){
            $this->poruka='Naziv ne smije biti duži od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaDrzava()
    {
        if(strlen($this->razvijac->drzava)===0){
            $this->poruka='Drzava obavezna';
            return false;
        }
        if(strlen($this->razvijac->drzava)>50){
            $this->poruka='Drzava ne smije biti duža od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaWebstranica()
    {
        if(strlen($this->razvijac->webstranica)===0){
            $this->poruka='Webstranica obavezna';
            return false;
        }
        if(strlen($this->razvijac->webstranica)>50){
            $this->poruka='Webstranica ne smije biti duža od 50 znakova';
            return false;
        }

        return true;
    }

    
}