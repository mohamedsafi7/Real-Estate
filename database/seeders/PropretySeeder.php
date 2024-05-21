<?php

namespace Database\Seeders;

use App\Models\Proprety;
use App\Models\PropretyImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropretySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfProperties = 100;

        Proprety::factory()->count($numberOfProperties)->create()->each(function ($property) {
        PropretyImage::factory()->count(rand(1, 5))->create(['property_id' => $property->id]);
        });
    }
}
