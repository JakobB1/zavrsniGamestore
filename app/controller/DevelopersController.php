<?php

class DevelopersController extends AuthorizationController
{

    private $viewDir =
    'private' . DIRECTORY_SEPARATOR .
        'developers' . DIRECTORY_SEPARATOR;
    private $message;
    private $developers;



    public function __construct()
    {
        parent::__construct();
        $this->developers = new stdClass();
        $this->developers->name='';
        $this->developers->country='';
        $this->developers->website='';
    }




    public function index()
    {
        $developers = Developers::read();

        $this->view->render($this->viewDir . 'index', [
            'developers' => $developers,
            'css' => '<link rel="stylesheet" href="' . App::config('url') . 'public/css/developersindex.css">'
        ]);
    }



    public function new()
    {
        $this->view->render($this->viewDir . 'new',[
            'messsage'=>'',
            'developers'=>$this->developers
        ]);
    }



    public function change($id)
    {
        $this->developers = Developers::readOne($id);

        $this->view->render($this->viewDir . 'change',[
            'messsage'=>'Change the Data',
            'developers'=>$this->developers
        ]);
    }



    public function addNew()
    {
        $this->prepareData();

        if($this->controlName()
        && $this->controlCountry()
        && $this->controlWebsite()){
            Developers::create((array)$this->developers);
            $this->index();
        }else{
            $this->view->render($this->viewDir.'new',[
                'message'=>$this->message,
                'developers'=>$this->developers
            ]);
        }
    }



    public function changing()
    {
        $this->prepareData();
        
        if($this->controlName()
        && $this->controlCountry()
        && $this->controlWebsite()){
            Developers::update((array)$this->developers);
            header('location:' . App::config('url').'developers/index');
        }else{
            $this->view->render($this->viewDir.'change',[
                'message'=>$this->message,
                'developers'=>$this->developers
            ]);
        }
    }




    public function delete($id)
    {
        Developers::delete($id);
        header('location:' . App::config('url').'developers/index');
    }






    private function prepareData()
    {
        $this->developers=(object)$_POST;
    }



    private function controlName()
    {
        if(strlen($this->developers->name)===0){
            $this->message='Name Required';
            return false;
        }
        if(strlen($this->developers->name)>50){
            $this->message='Name cannot be longer than 50 characters';
            return false;
        }

        return true;
    }



    private function controlCountry()
    {
        if(strlen($this->developers->country)===0){
            $this->message='Country Required';
            return false;
        }
        if(strlen($this->developers->country)>50){
            $this->message='Country cannot be longer than 50 characters';
            return false;
        }

        return true;
    }


    
    private function controlWebsite()
    {
        if(strlen($this->developers->website)===0){
            $this->message='Website Required';
            return false;
        }
        if(strlen($this->developers->website)>50){
            $this->message='Website cannot be longer than 50 characters';
            return false;
        }

        return true;
    }
}
