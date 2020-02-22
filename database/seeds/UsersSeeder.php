<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'email' => "admin@escuelaestech.es",
            'password' => bcrypt('admin'),
            'phone' => '622622622',
            'address' => 'Calle 123',
            'role' => 'admin',
            'created_at' => now(),
            'active' => true
        ]);

        factory(\App\User::class)->times(50)->create();
    }
}
