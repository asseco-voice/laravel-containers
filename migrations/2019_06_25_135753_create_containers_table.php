<?php

use Asseco\BlueprintAudit\App\MigrationMethodPicker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            if (config('asseco-containers.migrations.uuid')) {
                $table->uuid('id')->primary();
            } else {
                $table->id();
            }

            $table->string('name')->unique();
            $table->string('owner_id')->nullable();

            MigrationMethodPicker::pick($table, config('asseco-containers.migrations.timestamps'));

            $this->seedData();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('containers');
    }

    protected function seedData(): void
    {
        $data = [
            'name'       => 'Default',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('containers')->insert($data);
    }
}
