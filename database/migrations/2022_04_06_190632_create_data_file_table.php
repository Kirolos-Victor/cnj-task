<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_file', function (Blueprint $table) {
            $table->id();
            $table->string('average_price');
            $table->string('total_houses_sold');
            $table->string('number_of_crimes_in_2011');
            $table->text('average_price_per_year_in_london');
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
        Schema::dropIfExists('data_file');
    }
}
