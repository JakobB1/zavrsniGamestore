<?php

class IgraController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'igre' . DIRECTORY_SEPARATOR;
    private $poruka;
    private $igra;
    private $razvijac;
    private $izdavac;
    private $narudzba_igra;

    public function __construct()
    {
        parent::__construct();
        $this->igra = new stdClass();
        $this->razvijac = new stdClass();
        $this->izdavac = new stdClass();
        $this->narudzba_igra = new stdClass();
        $this->igra->sifra=0;
        $this->igra->naziv='';
        $this->igra->zanr='';
        $this->igra->cijena='';
        $this->igra->datumizlaska='';
        $this->igra->razvijac_id='';
        $this->igra->izdavac_id='';
        }

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'entiteti' => Igra::read()
        ]);

        
    }

    public function detalji($sifra=0)
    {
        if($sifra===0){
            $this->view->render($this->viewDir . 'detalji',[
                'igra'=>$this->igra,
                'poruka'=>'Unesite tražene podatke',
                'akcija'=>'Dodaj novi',
                'razvijaci'=>Razvijac::read(),
                'izdavaci'=>Izdavac::read()
            ]);
        }else{
            $this->view->render($this->viewDir . 'detalji',[
                'igra'=>Igra::readOne($sifra),
                'poruka'=>'Promjenite podatke',
                'akcija'=>'Promjena',
                'razvijaci'=>Razvijac::read(),
                'izdavaci'=>Izdavac::read()
            ]);
        }

    }

    public function akcija()
    {
        if($_POST['sifra']==0){
            // prvo kontrole
            $sifra = Igra::create($_POST);
        }else{
            Igra::update($_POST);
            
            $sifra=$_POST['sifra'];
        }

        if(isset($_FILES['slika'])){
            move_uploaded_file($_FILES['slika']['tmp_name'], 
            BP . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR
             . 'igre' . DIRECTORY_SEPARATOR . $sifra . '.jpg'
        );
        }


        header('location:' . App::config('url').'igra/index');

    }

    // public function novi()
    // {
    //     $this->view->render($this->viewDir . 'novi',[
    //         'poruka'=>'',
    //         'igra'=>$this->igra
    //     ]);
    // }

    // public function promjena($id)
    // {
    //     $this->igra = Igra::readOne($id);

    //     $this->view->render($this->viewDir . 'promjena',[
    //         'poruka'=>'Promjenite podatke',
    //         'igra'=>$this->igra
    //     ]);
    // }

    // public function dodajNovi()
    // {
    //     $this->pripremiPodatke();

    //     if($this->kontrolaNaziv()
    //     && $this->kontrolaDrzava()
    //     && $this->kontrolaWebstranica()){
    //         Razvijac::create((array)$this->razvijac);
    //         header('location:' . App::config('url').'razvijac/index');
    //     }else{
    //         $this->view->render($this->viewDir.'novi',[
    //             'poruka'=>$this->poruka,
    //             'razvijac'=>$this->razvijac
    //         ]);
    //     }
    // }

    // public function promjeni()
    // {
    //     $this->pripremiPodatke();
        
    //     if($this->kontrolaNaziv()
    //     && $this->kontrolaDrzava()
    //     && $this->kontrolaWebstranica()){
    //         Razvijac::update((array)$this->razvijac);
    //         header('location:' . App::config('url').'razvijac/index');
    //     }else{
    //         $this->view->render($this->viewDir.'promjena',[
    //             'poruka'=>$this->poruka,
    //             'razvijac'=>$this->razvijac
    //         ]);
    //     }
    // }

    public function brisanje($sifra)
    {
        Igra::delete($sifra);
        header('location:' . App::config('url').'igra/index');
    }

    // private function pripremiPodatke()
    // {
    //     $this->razvijac=(object)$_POST;
    // }

    // private function kontrolaNaziv()
    // {
    //     if(strlen($this->razvijac->naziv)===0){
    //         $this->poruka='Naziv obavezno';
    //         return false;
    //     }
    //     if(strlen($this->razvijac->naziv)>50){
    //         $this->poruka='Naziv ne smije biti duži od 50 znakova';
    //         return false;
    //     }

    //     return true;
    // }

    // private function kontrolaDrzava()
    // {
    //     if(strlen($this->razvijac->drzava)===0){
    //         $this->poruka='Drzava obavezna';
    //         return false;
    //     }
    //     if(strlen($this->razvijac->drzava)>50){
    //         $this->poruka='Drzava ne smije biti duža od 50 znakova';
    //         return false;
    //     }

    //     return true;
    // }

    // private function kontrolaWebstranica()
    // {
    //     if(strlen($this->razvijac->webstranica)===0){
    //         $this->poruka='Webstranica obavezna';
    //         return false;
    //     }
    //     if(strlen($this->razvijac->webstranica)>50){
    //         $this->poruka='Webstranica ne smije biti duža od 50 znakova';
    //         return false;
    //     }

    //     return true;
    // }

    
}