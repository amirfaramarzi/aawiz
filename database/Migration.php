<?php

namespace Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Migration
{
    protected $capsule;
    
    public function boot() 
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection(config('database.connections.' . config('database.default')));

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
    public function up()
    {
        $this->capsule::schema()->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 64);
            $table->string('last_name', 64)->nullable();
            $table->char('email', 64)->unique();
            $table->string('password', 64);
            $table->enum('level', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        $this->capsule::schema()->create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->foreignId('user_id')->constrained(
                table: 'users'
            );
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->capsule::schema()->dropIfExists('evaluations');
        $this->capsule::schema()->dropIfExists('users');
    }
}