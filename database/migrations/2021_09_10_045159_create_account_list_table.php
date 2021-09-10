<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_list', function (Blueprint $table) {
            $table->id();
            $table->string('account_list_no');
            $table->string('account_id');
            $table->integer('account_list_type_id');            
            $table->integer('account_sum');
            $table->integer('account_list_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_list');
    }
}
