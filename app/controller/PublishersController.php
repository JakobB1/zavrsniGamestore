<?php

class PublishersController extends AuthorizationController
{

    private $viewDir =
    'private' . DIRECTORY_SEPARATOR .
        'publishers' . DIRECTORY_SEPARATOR;
    private $message;
    private $publishers;



    public function __construct()
    {
        parent::__construct();
        $this->publishers = new stdClass();
        $this->publishers->name='';
        $this->publishers->country='';
        $this->publishers->website='';
    }




    public function index()
    {
        $publishers = Publishers::read();

        $this->view->render($this->viewDir . 'index', [
            'publishers' => $publishers,
            'css' => '<link rel="stylesheet" href="' . App::config('url') . 'public/css/developersindex.css">'
        ]);
    }



    public function new()
    {
        $this->view->render($this->viewDir . 'new',[
            'messsage'=>'',
            'publishers'=>$this->publishers
        ]);
    }



    public function change($id)
    {
        $this->publishers = Publishers::readOne($id);

        $this->view->render($this->viewDir . 'change',[
            'messsage'=>'Change the Data',
            'publishers'=>$this->publishers
        ]);
    }



    public function addNew()
    {
        $this->prepareData();

        if($this->controlName()
        && $this->controlCountry()
        && $this->controlWebsite()){
            Publishers::create((array)$this->publishers);
            $this->index();
        }else{
            $this->view->render($this->viewDir.'new',[
                'message'=>$this->message,
                'publishers'=>$this->publishers
            ]);
        }
    }



    public function changing()
    {
        $this->prepareData();
        
        if($this->controlName()
        && $this->controlCountry()
        && $this->controlWebsite()){
            Publishers::update((array)$this->publishers);
            header('location:' . App::config('url').'publishers/index');
        }else{
            $this->view->render($this->viewDir.'change',[
                'message'=>$this->message,
                'publishers'=>$this->publishers
            ]);
        }
    }




    public function delete($id)
    {
        Publishers::delete($id);
        header('location:' . App::config('url').'publishers/index');
    }






    private function prepareData()
    {
        $this->publishers=(object)$_POST;
    }



    private function controlName()
    {
        if(strlen($this->publishers->name)===0){
            $this->message='Name Required';
            return false;
        }
        if(strlen($this->publishers->name)>50){
            $this->message='Name cannot be longer than 50 characters';
            return false;
        }

        return true;
    }



    private function controlCountry()
    {
        if(strlen($this->publishers->country)===0){
            $this->message='Country Required';
            return false;
        }
        if(strlen($this->publishers->country)>50){
            $this->message='Country cannot be longer than 50 characters';
            return false;
        }

        return true;
    }


    
    private function controlWebsite()
    {
        if(strlen($this->publishers->website)===0){
            $this->message='Website Required';
            return false;
        }
        if(strlen($this->publishers->website)>50){
            $this->message='Website cannot be longer than 50 characters';
            return false;
        }

        return true;
    }
}
