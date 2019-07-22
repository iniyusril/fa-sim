<?php

use Illuminate\Database\Seeder;
use App\Dashboard;

class configSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = new Dashboard();
        $data->tha = '2018/2019';
        $data->semester = 1;
        $data->npm = '16.11.0503';
        $data->password = md5('23544');
        $data->save();
    }
}
