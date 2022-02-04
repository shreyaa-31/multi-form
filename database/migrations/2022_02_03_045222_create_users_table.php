<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobile');
            $table->boolean('gender')->comment('1=male , 2=female');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');        
            $table->unsignedMediumInteger('user_zipcode')->length(5);
            $table->date('date_of_birth');
            $table->string('company_name');
            $table->text('address');
            $table->unsignedMediumInteger('company_zipcode')->length(5);
            $table->string('website');
            $table->string('category_id');
            $table->string('skill_id');
            $table->text('user_info');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
