<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class AddSortorderToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('sortorder')->default(0);
        });
    }
 
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('sortorder');
        });
    }
}