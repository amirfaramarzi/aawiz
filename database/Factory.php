<?php

namespace Database;

use Fomo\Fake\Faker;
use Fomo\Inserter\Inserter;

class Factory
{
    public function run()
    {
        $faker = Faker::create();

        (new Inserter('users' , [
            'first_name' => 'admin' ,
            'email' => 'admin@gmail.com' ,
            'password' => hash('sha256', 'admin') ,
            'level' => 'admin' ,
        ]))->create(1);

        (new Inserter('users' , [
            'first_name' => 'user' ,
            'email' => 'user@gmail.com' ,
            'password' => hash('sha256', 'user') ,
        ]))->create(1);
    }
}