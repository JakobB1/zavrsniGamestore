<?php

class Template
{
    // CRUD
    public static function readOne($key)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
        
        '); 
        $expression->execute(['parameter'=>$key]);
        return $expression->fetch();
    }



    //R - Read
    public static function read()
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('

            
        ');
        $expression->execute();
        return $expression->fetchAll();
    }



    //C - Create
    public static function create($parameters)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
        
        
        '); 
        $expression->execute($parameters);
        
    }



    //U - Update
    public static function update($parameters)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
                       
        '); 
        $expression->execute($parameters);
        
    }


    //D - Delete
    public static function delete($id)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
            
        '); 
        $expression->execute(['id'=>$id]);

    }
}
