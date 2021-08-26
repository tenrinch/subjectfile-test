<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoings', function (Blueprint $table) {
            $table->id();
            $table->integer('dispatched_no')->default(0);
            $table->integer('file_no');
            $table->date('dispatched_date');
            $table->integer('year');
            $table->foreignId('sender')->constrained('sender_destinations');
            $table->mediumText('subject');
            $table->enum('status', ['pending', 'closed'])->default('pending');
            $table->foreignId('entered_by')->constrained('users');
            $table->foreignId('department_id')->constrained();
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
        Schema::dropIfExists('outgoings');
    }
}
