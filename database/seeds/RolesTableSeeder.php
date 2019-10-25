<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=> 'User',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name'=> 'Admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        Role::insert($data);
    }
}
