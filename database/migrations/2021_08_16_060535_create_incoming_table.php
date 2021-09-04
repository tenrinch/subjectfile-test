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
            $table->string('file_no');
            $table->string('letter_no')->nullable();
            $table->date('received_date');
            $table->integer('year')->nullable();
            $table->foreignId('sender_id')->constrained('sender_destinations');
            $table->mediumText('subject');
            $table->integer('category_id')->nullable();
            $table->enum('status', ['pending', 'closed'])->default('pending');
            $table->date('letter_date')->nullable();
            $table->string('mode')->nullable();
            $table->string('urgency')->nullable();
            $table->mediumText('remarks')->nullable();
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
        Schema::dropIfExists('incomings');
    }
}
