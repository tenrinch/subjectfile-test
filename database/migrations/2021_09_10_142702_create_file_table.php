<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('register_no')->nullable();
            $table->date('date_opened')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_no');
            $table->string('file_name')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('dealing_staff')->nullable();
            $table->date('transfered_date')->nullable();
            $table->string('transfered_to')->nullable();
            $table->string('transfered_from')->nullable();
            $table->string('remarks')->nullable();
            $table->date('closed_date')->nullable();
            $table->string('categorized_by')->nullable();
            $table->unsignedBigInteger('categorized_id')->nullable();
            $table->unsignedBigInteger('entered_by');
            $table->unsignedBigInteger('department_id');
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
        Schema::dropIfExists('files');
    }
}
