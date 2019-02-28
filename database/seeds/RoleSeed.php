<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator (can create other users)',],
            ['id' => 2, 'title' => 'Simple user',],
            ['id' => 3, 'title' => 'SubAdmin',],
            ['id' => 4, 'title' => 'Laboratory',],
            ['id' => 5, 'title' => 'DonorRegistrar',],
            ['id' => 6, 'title' => 'PatientRegistrar',],
        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
