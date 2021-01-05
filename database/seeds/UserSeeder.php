<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
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
        $data =
        [
            [
                'id' => '1',
                'name' => 'Admin',
                'jenis_kelamin' => 'Laki-laki',
                'role_id' => '1',
                'job_id' => '1',
                'alamat' => 'Jakarta',
                'no_hp' => '089664967275',
                'email' => 'admin@gmail.com',
                'avatar' => 'default.png',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'name' => 'Member',
                'jenis_kelamin' => 'Laki-laki',
                'role_id' => '2',
                'job_id' => '2',
                'alamat' => 'Depok',
                'no_hp' => '082123155292',
                'email' => 'member@gmail.com',
                'avatar' => 'default.png',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '3',
                'name' => 'Reporter',
                'jenis_kelamin' => 'Laki-laki',
                'role_id' => '3',
                'job_id' => null,
                'alamat' => 'Bekasi',
                'no_hp' => '087731512627',
                'email' => 'reporter@gmail.com',
                'avatar' => 'default.png',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        User::insert($data);
    }
}
