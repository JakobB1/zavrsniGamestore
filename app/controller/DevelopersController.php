<?php

class DevelopersController extends AuthorizationController
{

    private $viewDir = 
                'private' . DIRECTORY_SEPARATOR . 
                    'developers' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}