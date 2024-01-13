<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mutter;

class mutterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        mutter::create([
            'body' => 'おい、地獄さ行くんだで!',
            'user_id' => '1',
        ]);
        mutter::create([
            'body' => '紫だちたる雲の細くたなびきたる',
            'user_id' => '2',
        ]);
        mutter::create([
            'body' => 'ある日の暮型の事である',
            'user_id' => '3',
        ]);
    }
}
