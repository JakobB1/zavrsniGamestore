<?php

class Users
{
    // CRUD
    public static function readOne($key)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
            select * from users where id=:parameter;
        
        '); 
        $expression->execute(['parameter'=>$key]);
        return $expression->fetch();
    }



    //R - Read
    public static function read()
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('

            select a.id , a.name , a.surname , a.username , a.password , a.gender , a.age , a. email , country,
            count(b.id) as wishlists
            from users a left join wishlists b
            on a.id = b.users  
            group by a.id , a.name , a.surname , a.username , a.password , a.gender , a.age , a. email , country;

        ');
        $expression->execute();
        return $expression->fetchAll();
    }



    //C - Create
    public static function create($parameters)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
        insert into users (name,surname,username,password,gender,age,email,country) values
        (:name, :surname, :username, :password, :gender, :age, :email, :country)
        
        '); 
        $expression->execute($parameters);
        
    }



    //U - Update
    public static function update($parameters)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
        update users set 
                name=:name,
                surname=:surname,
                username=:username,
                password=:password,
                gender=:gender,
                age=:age,
                email=:email,
                country=:country,
                where id=:id;
                       
        '); 
        $expression->execute($parameters);
        
    }


    //D - Delete
    public static function delete($id)
    {
        $connection = DB::getInstance();
        $expression = $connection->prepare('
        
        delete from users where id=:id;
            
        '); 
        $expression->execute(['id'=>$id]);

    }
}
