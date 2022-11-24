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
        Schema::create('paths', function (Blueprint $table) {
            $table -> id();
            $table -> text('name');
            $table -> unsignedInteger('duration'); // in minutes
            $table -> float('distance', 4, 1); // in km
            $table -> unsignedInteger('level'); // from 0 to x
            $table -> foreignId('path_type_id') -> constrained('path_types') -> cascadeOnDelete();
            $table -> foreignId('examination_center_id') -> constrained('examination_centers') -> cascadeOnDelete();
            $table -> unique(['name', 'path_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paths');
    }
};
