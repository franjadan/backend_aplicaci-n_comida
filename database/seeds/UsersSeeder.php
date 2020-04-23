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
            'first_name' => null,
            'last_name' => null,
            'email' => "admin@escuelaestech.es",
            'password' => bcrypt('admin'),
            'phone' => null,
            'address' => null,
            'role' => 'admin',
            'created_at' => now(),
            'active' => true
        ]);

        factory(\App\User::class)->times(50)->create();
    }
}
