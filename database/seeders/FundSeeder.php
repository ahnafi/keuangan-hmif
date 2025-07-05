<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Fund::create(['name' => 'Gopay HMIF Kas']);
        \App\Models\Fund::create(['name' => 'BNI HMIF']);
        \App\Models\Fund::create(['name' => 'Cash Nana Kas']);
        \App\Models\Fund::create(['name' => 'Cash Nanay Kas']);
        \App\Models\Fund::create(['name' => 'Gopay HMIF Deposit']);
        \App\Models\Fund::create(['name' => 'Cash Nana Deposit']);
        \App\Models\Fund::create(['name' => 'Cash Nana Deposit']);
    }
}
