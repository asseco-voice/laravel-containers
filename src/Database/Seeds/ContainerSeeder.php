<?php

namespace Voice\Containers\Database\Seeds;

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
        $data = [
            ['name' => 'Default'],
            ['name' => 'Container 1'],
            ['name' => 'Container 2'],
            ['name' => 'Container 3'],
            ['name' => 'Container 4'],
            ['name' => 'Container 5'],
        ];

        Container::insert($data);
    }
}
