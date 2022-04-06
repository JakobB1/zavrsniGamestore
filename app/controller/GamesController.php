<?php

class GamesController extends AuthorizationController
{

    private $viewDir = 
                'private' . DIRECTORY_SEPARATOR . 
                    'games' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}