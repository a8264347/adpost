<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TodoList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo-list', function (Blueprint $table) {
            $table->bigIncrements('id',20)->unsigned();
            $table->string('title', 255);
            $table->text('content');
            $table->bigInteger('created_by', false, true)->unsigned()->default(0);
            $table->bigInteger('updated_by', false, true)->nullable()->unsigned()->default(0);
            $table->bigInteger('deleted_by', false, true)->nullable()->unsigned()->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
