<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_list', function (Blueprint $table) {
            $table->id();
            $table->string('account_list_no');
            $table->integer('account_id');
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
        Schema::dropIfExists('accounts_list');
    }
}
