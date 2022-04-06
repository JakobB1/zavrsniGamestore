<?php

class OrdersController extends AuthorizationController
{

    private $viewDir = 
                'private' . DIRECTORY_SEPARATOR . 
                    'orders' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}