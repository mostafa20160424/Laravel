<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) { //create table users
            $table->increments('id');
            //increments mean auto increment primary key
            $table->string('title');
            // string declare varchar with column name title and length 255
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('column name')->references('column name')->on('table name');
            $table->text('description');
            $table->enum('statues',['active','pending','disabled']);
            $table->softDeletes();//will not show rows deleted but add to deleated at column you create time you delete
        });
        /*
        /----------------------to execute table creation-------------------/
        / go to .env and update DB_NAME to database name your are create
        / create Value in .env DB_SOCKET=/applications/mamp/temp/mysql/mysql.sock
        / go to app/Provides/AppServiceProvider.php and use Illuminate\Support\Facades\Schema;
        / call function Schema::defaultStringLength(150); to specify varchar length inboot function
        / use php artisan migrate:rollback to delete all tables expect migration table and truncate it
        / use php artisan migrate:refresh to add or delete tables
        / use php artisan migrate:fresh to drop all tables and create it again
        / use php artisan migrate:statues to show all table stored
        / php artisan migrate:reset like rollback
        /----------------------End--------------------------------------/
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
