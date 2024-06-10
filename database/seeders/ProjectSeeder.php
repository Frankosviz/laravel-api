<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $new_project = new Project();
            $new_project->title = $faker->words(3, true);
            $new_project->start_date = $faker->date('Y-m-d');
            $new_project->end_date = $faker->date('Y-m-d');
            $new_project->description = $faker->paragraphs(3, true);
            $new_project->slug = Project::generateSlug($new_project->title);
            $new_project->status = $faker->randomElement(['Not Started','Started','Finished']);
            $new_project->technologies_used = $faker->words(3, true);
            $new_project->url = $faker->url();
            $new_project->repository_url = $faker->url();
            $new_project->image_path = $faker->imageUrl(640, 480, true);
            $new_project->save();
    }
}
}
