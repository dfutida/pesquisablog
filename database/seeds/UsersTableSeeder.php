<?php

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
        DB::table('users')->insert([
            'usuario' => 'admin',
            'senha' => bcrypt('admin'),
            'email' => 'admin@localhost.com',
        ]);
    }
}
