<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskDistanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desk_distance', function (Blueprint $table) {
            $table->timestamp('created_at', $precision = 6)->useCurrent();
            $table->integer('Afstand');
            $table->String('Ideale_afstand')->default("Tussen de 60 en 80 centimeter");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desk_distance');
    }
}
