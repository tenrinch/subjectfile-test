<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->integer('incoming_no')->default(0);
            $table->integer('file_no');
            $table->bigInteger('dispatched_no')->nullable();
            $table->date('received_date');
            $table->integer('year');
            $table->foreignId('sender')->references('id')->on('sender_destinations');
            $table->mediumText('subject');
            $table->enum('status', ['pending', 'closed'])->default('pending');
            $table->foreignId('entered_by')->references('id')->on('users');
            $table->foreignId('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('incomings');
    }
}
