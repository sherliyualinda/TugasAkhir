<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table){
            $table->increments('id');
            $table->string('text');
            $table->integer('duration');
            $table->float('progress');
            $table->dateTime('start_date');
            $table->integer('parent');
            $table->integer('sortorder')->default(0);
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}