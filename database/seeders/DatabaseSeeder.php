<?php

namespace Database\Seeders;

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
           \App\Models\User::factory(400)->create();
           \App\Models\comment::factory(400)->create();
           \App\Models\device::factory(400)->create();
           \App\Models\post_category::factory(400)->create();
           \App\Models\post::factory(400)->create();
           \App\Models\category::factory(400)->create();
    }
}
