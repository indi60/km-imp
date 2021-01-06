<?php

use App\Description;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DescriptionSeeder extends Seeder
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
                'desc' => 'KOMA Helpdesk is a management app that was build for the purpose of "easily manage everything" with an easy to navigate interface, feather-weight load time and responsive interactions.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        Description::insert($data);
    }
}
