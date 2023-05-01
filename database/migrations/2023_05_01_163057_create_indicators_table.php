<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('name_indicator');
            $table->string('code_indicator');
            $table->string('unit_measure_indicator');
            $table->decimal('value', 10, 2);
            $table->date('date_indicator');
            $table->time('time_indicator')->nullable();
            $table->string('origin_indicator');
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
        Schema::dropIfExists('indicators');
    }
};
