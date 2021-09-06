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
            $table->integer('dispatched_no')->nullable();
            $table->string('file_no');
            $table->date('dispatched_date');
            $table->integer('year')->nullable();
            $table->integer('destination_id')->nullable();
            $table->mediumText('subject');
            $table->integer('category_id')->nullable();
            $table->enum('status', ['pending', 'closed'])->default('pending');
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
        Schema::dropIfExists('outgoings');
    }
}
