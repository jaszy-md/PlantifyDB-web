<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Succulents',
            'Cacti',
            'Ferns',
            'Tropical Plants',
            'Orchids',
            'Herbs',
            'Flowering Plants',
            'Trees',
            'Shrubs',
            'Climbers',
        ];
        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category]
            );
        }
    }
}
