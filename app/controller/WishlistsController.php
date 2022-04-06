<?php

class WishlistsController extends AuthorizationController
{

    private $viewDir = 
                'private' . DIRECTORY_SEPARATOR . 
                    'wishlists' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}