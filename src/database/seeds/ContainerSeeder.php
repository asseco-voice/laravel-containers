<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Voice\Containers\App\Container;

class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Container::updateOrCreate(
            ['name' => 'Default'],
            [
                'name'       => 'Default',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }
}
