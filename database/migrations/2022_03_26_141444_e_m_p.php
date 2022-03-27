<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EMP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
            if(!Schema::hasTable("Employees")){
                Schema::create('Employees', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string("username",50)->unique();
                    $table->string("email",100)->unique();
                    $table->string("password");
                    $table->string("activationCode");
                    $table->boolean("verified")->default(false);
                    $table->timestamp("joinedOn");
                    $table->timestamps();
                });
            }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Employee');
    }
}
