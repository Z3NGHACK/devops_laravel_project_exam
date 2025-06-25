<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerrainImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Make sure terrains exist first
        $terrains = \App\Models\Terrain::all();

        if ($terrains->isEmpty()) {
            \App\Models\Terrain::factory(10)->create();
            $terrains = \App\Models\Terrain::all();
        }

        foreach ($terrains as $terrain) {
            \App\Models\TerrainImage::factory(3)->create([
                'terrain_id' => $terrain->id
            ]);
        }
    }
}
