<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            'Laravel',
            'PHP',
            'HTML',
            'CSS',
            'JavaScript',
            'Vue.js',
            'Tailwind CSS',
            'Bootstrap',
            'JQuery',
            'SASS',
        ];
        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology;
            $newTechnology->slug = Technology::generateSlug($technology);
            $newTechnology->save();
    };
    }
}
