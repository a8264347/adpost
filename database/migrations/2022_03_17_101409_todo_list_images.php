<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TodoListImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo-list-images', function (Blueprint $table) {
            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('todo_list_id', false, true)->unsigned()->default(0);
            $table->string('todo_list_images_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
