<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Terrain::factory(20)->create();
        \App\Models\TerrainImage::factory(60)->create();
        \App\Models\Booking::factory(30)->create();
        \App\Models\Payment::factory(30)->create();
        \App\Models\Review::factory(50)->create();
        \App\Models\Favorite::factory(40)->create();
        $this->call([
            TerrainSeeder::class,
            TerrainImageSeeder::class,
            // other seeders...
        ]);
    }
}
