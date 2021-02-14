<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('h_name'); // Hospital name        
            $table->string('f_no'); // Floor number       
            $table->string('r_no')->nullable(); // Room number
            $table->string('r_type')->nullable(); // Room Type       
            $table->string('b_no')->nullable(); // Bad number
            $table->string('b_type')->nullable(); // Bad type       
            $table->tinyInteger('status')->default(0)->comment="0 => called, 1 => Received";        
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
        Schema::dropIfExists('calls');
    }
}
