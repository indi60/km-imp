<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(StatusArticleSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(DescriptionSeeder::class);
    }
}
