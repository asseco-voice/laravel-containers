<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containables', function (Blueprint $table) {
            $table->id();

            if (config('asseco-containers.migrations.uuid')) {
                $table->foreignUuid('container_id')->constrained()->cascadeOnDelete();
                $table->uuidMorphs('containable');
            } else {
                $table->foreignId('container_id')->constrained()->cascadeOnDelete();
                $table->morphs('containable');
            }

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
        Schema::dropIfExists('containables');
    }
}
