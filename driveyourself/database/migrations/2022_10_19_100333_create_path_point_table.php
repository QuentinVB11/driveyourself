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
        Schema::create('path_point', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('path_id') -> constrained('paths') -> cascaseOnDelete();
            $table -> foreignId('point_id') -> constrained('points') -> cascadeOnDelete();
            $table -> unsignedInteger('order_number');
            $table -> unique(['path_id', 'order_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('path_point');
    }
};
