<?php

class View
{
    private $template;

    public function __construct($template='template')
    {
        $this->template=$template;
    }

    public function render($phtmlSite,$parameters=[])
    {
        ob_start();
        extract($parameters); 
        include_once BP_APP . 'view' . DIRECTORY_SEPARATOR . $phtmlSite . '.phtml';
        $content = ob_get_clean();
        include_once BP_APP . 'view' .  DIRECTORY_SEPARATOR . $this->template . '.phtml';
    }
}