<?php

class UsersController extends AuthorizationController
{

    private $viewDir =
    'private' . DIRECTORY_SEPARATOR .
        'users' . DIRECTORY_SEPARATOR;
    private $message;
    private $users;



    public function __construct()
    {
        parent::__construct();
        $this->users = new stdClass();
        $this->users->name='';
        $this->users->surname='';
        $this->users->username='';
        $this->users->password='';
        $this->users->gender='';
        $this->users->age='';
        $this->users->email='';
        $this->users->country='';
    }




    public function index()
    {
        $users = Users::read();

        $this->view->render($this->viewDir . 'index', [
            'users' => $users,
            'css' => '<link rel="stylesheet" href="' . App::config('url') . 'public/css/developersindex.css">'
        ]);
    }



    public function new()
    {
        $this->view->render($this->viewDir . 'new',[
            'messsage'=>'',
            'users'=>$this->users
        ]);
    }



    public function change($id)
    {
        $this->users = Users::readOne($id);

        $this->view->render($this->viewDir . 'change',[
            'messsage'=>'Change the Data',
            'users'=>$this->users
        ]);
    }



    public function addNew()
    {
        $this->prepareData();

        if($this->controlName()
        && $this->controlSurname()
        && $this->controlUsername()
        && $this->controlPassword()
        && $this->controlGender()
        && $this->controlAge()
        && $this->controlEmail()
        && $this->controlCountry()){
            Users::create((array)$this->users);
            $this->index();
        }else{
            $this->view->render($this->viewDir.'new',[
                'message'=>$this->message,
                'users'=>$this->users
            ]);
        }
    }



    public function changing()
    {
        $this->prepareData();
        
        if($this->controlName()
        && $this->controlSurname()
        && $this->controlUsername()
        && $this->controlPassword()
        && $this->controlGender()
        && $this->controlAge()
        && $this->controlEmail()
        && $this->controlCountry()){
            Users::update((array)$this->users);
            header('location:' . App::config('url').'users/index');
        }else{
            $this->view->render($this->viewDir.'change',[
                'message'=>$this->message,
                'users'=>$this->users
            ]);
        }
    }




    public function delete($id)
    {
        Users::delete($id);
        header('location:' . App::config('url').'users/index');
    }






    private function prepareData()
    {
        $this->users=(object)$_POST;
    }



    private function controlName()
    {
        if(strlen($this->users->name)===0){
            $this->message='Name Required';
            return false;
        }
        if(strlen($this->users->name)>50){
            $this->message='Name cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlSurname()
    {
        if(strlen($this->users->surname)===0){
            $this->message='Surname Required';
            return false;
        }
        if(strlen($this->users->surname)>50){
            $this->message='Surname cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlUsername()
    {
        if(strlen($this->users->username)===0){
            $this->message='Username Required';
            return false;
        }
        if(strlen($this->users->username)>50){
            $this->message='Username cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlPassword()
    {
        if(strlen($this->users->password)===0){
            $this->message='Password Required';
            return false;
        }
        if(strlen($this->users->password)>50){
            $this->message='Surname cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlGender()
    {
        if(strlen($this->users->gender)===0){
            $this->message='Gender Required';
            return false;
        }
        if(strlen($this->users->gender)>50){
            $this->message='Gender cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlAge()
    {
        if(strlen($this->users->age)===0){
            $this->message='Age Required';
            return false;
        }
        if(strlen($this->users->age)>50){
            $this->message='Age cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlEmail()
    {
        if(strlen($this->users->email)===0){
            $this->message='Email Required';
            return false;
        }
        if(strlen($this->users->email)>50){
            $this->message='Email cannot be longer than 50 characters';
            return false;
        }

        return true;
    }

    private function controlCountry()
    {
        if(strlen($this->users->country)===0){
            $this->message='Country Required';
            return false;
        }
        if(strlen($this->users->country)>50){
            $this->message='Country cannot be longer than 50 characters';
            return false;
        }

        return true;
    }
}
