<?php

class PracticeController
{
    public function example1()
    {
        echo 'Edunova';
    }

    public function example2()
    {
        $sb = rand(2,9);
        $name = 'Edunova';
        $g = new stdClass();
        $g->name='Pero';
        $g->surname='Perić';
        $row=[
            'Osijek', 'Zagreb', 'Donji Miholjac'
        ];
        shuffle($row);

        $view = new View();
        $view->render('parameters',[
            'randomNumber'=>$sb,
            'school'=>$name,
            'guide'=>$g,
            'cities'=>$row
        ]);
    }

    public function testbase()
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('select * from publishers');
        $expression->execute();
        print_r($expression->fetchAll());
    }

}