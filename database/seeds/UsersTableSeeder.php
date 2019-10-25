<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add admin user
        $data = [
            'name' => 'admin',
            'email' => 'admin@pdblog.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        $user = User::create($data);
        $user->assignRole('Admin');

        factory(User::class, 5)->create()->each(function($u){
            $u->assignRole('User');
        });

    }
}
