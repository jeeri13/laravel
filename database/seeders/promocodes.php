<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class promocodes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promocodes')->insert([
            'code' => 'FIXED',
            'type' => 'fixed',
            'value' => '10',
            'user_specific' => '0',
            'user_id'=> '10',
        ]);
        DB::table('promocodes')->insert([
            'code' => 'FIXED',
            'type' => 'fixed',
            'value' => '10',
            'user_specific' => '0',
            'user_id'=> '10',
        ]);
    }
}
