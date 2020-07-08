<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->firstOrCreate(
            [
                'name' => 'admin'
            ],
            [
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123456')
            ]
        );
        factory(App\User::class, 50)->create();
    }
}
