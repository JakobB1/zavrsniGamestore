<?php

abstract class AdminController extends AutorizacijaController
{

    

    public function __construct()
    {
        parent::__construct();
        if($_SESSION['autoriziran']->uloga!=='admin'){
            $this->view->render('login',[
                'email'=>'',
                'poruka'=>'Prvo se prijavite'
            ]);
            exit;
        }
    }
}