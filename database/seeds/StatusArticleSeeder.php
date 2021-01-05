<?php

use App\StatusArticle;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class StatusArticleSeeder extends Seeder
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
                'name' => 'Public',
                'color' => '#1cc88a',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'name' => 'Private',
                'color' => '#dc3545',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        StatusArticle::insert($data);
    }
}
