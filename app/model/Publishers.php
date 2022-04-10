<?php

class Publishers
{
    // CRUD
    public static function readOne($key)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
            select * from publishers where id=:parameter;
        
        '); 
        $expression->execute(['parameter'=>$key]);
        return $expression->fetch();
    }



    //R - Read
    public static function read()
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('

            select a.id , a.name , a.country , a.website,
            count(b.id) as games
            from publishers a left join games b 
            on a.id  = b.id 
            group by a.id  , a.name , a.country , a.website;
        
        ');
        $expression->execute();
        return $expression->fetchAll();
    }



    //C - Create
    public static function create($parameters)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
            insert into publishers (name,country,website)
            values (:name,:country,:website);
        
        '); 
        $expression->execute($parameters);
        
    }



    //U - Update
    public static function update($parameters)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
            update publishers set 
                name=:name,
                country=:country,
                website=:website
                where id=:id;
                
        '); 
        $expression->execute($parameters);
        
    }


    //D - Delete
    public static function delete($id)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
            delete from publishers where id=:id;
        
        '); 
        $expression->execute(['id'=>$id]);

    }
}
