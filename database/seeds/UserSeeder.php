<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new App\User;
        $administrator->name = 'Site Administrator';
        $administrator->email = 'rifki@admin.com';
        $administrator->password = \Hash::make('admin');

        $administrator->save();

        $this->command->info('User Admin sudah diinsert');
    }
}
