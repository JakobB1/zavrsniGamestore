<?php

class LoginController extends Controller
{
    public function index()
    {
        $this->loginView('Fill in the Email and Password','');
    }

    public function authorize()
    {
        if(!isset($_POST['email']) || !isset($_POST['password'])){
            $this->index();
            return; //short curcuiting
        }

        if(strlen(trim($_POST['email']))===0){
           $this->loginView('Email required','');
           return;
        }

        if(strlen(trim($_POST['password']))===0){
            $this->loginView('Password required',$_POST['email']);
            return;
        }

        // I am 100% sure that the user entered the email and password
        $operator = Operator::authorize($_POST['email'],$_POST['password']);
        if($operator==null){
            $this->loginView('Invalid email and password combination',$_POST['email']);
            return;
        }

        $_SESSION['authorized']=$operator;
         $dash = new DashboardController();
         $dash->index();
    }

    public function logout()
    {
        unset($_SESSION['authorized']);
        session_destroy();
        $this->loginView('You have been successfully logged out','');
    }


    private function loginView($message,$email)
    {
        $this->view->render('login',[
            'message'=>$message,
            'email'=>$email
        ]);
    }
}