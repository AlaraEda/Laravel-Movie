<?php

use Illuminate\Database\Seeder;

class testseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Alara',
            'email' => 'alara@gmail.com',
            'password' => bcrypt('secret'),
            'admin' => 1,
        ]);
    }
}
