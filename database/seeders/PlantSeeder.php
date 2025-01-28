<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;
use App\Models\Category;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        $plants = [
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2017/08/14/20/17/aloe-vera-2648089_960_720.jpg',
                'name' => 'Aloe Vera',
                'information' => 'A succulent plant species of the genus Aloe.',
                'categories' => ['Succulents', 'Cacti'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2020/06/16/15/05/snake-plant-5306710_960_720.jpg',
                'name' => 'Snake Plant',
                'information' => 'An evergreen perennial plant forming dense stands.',
                'categories' => ['Cacti', 'Ferns'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2020/08/30/10/14/fiddle-leaf-fig-5530112_960_720.jpg',
                'name' => 'Fiddle Leaf Fig',
                'information' => 'A popular ornamental tree with large, glossy leaves.',
                'categories' => ['Ferns', 'Tropical Plants'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2016/03/28/09/34/spider-plant-1282332_960_720.jpg',
                'name' => 'Spider Plant',
                'information' => 'A popular indoor plant known for its easy care.',
                'categories' => ['Tropical Plants', 'Herbs'],
            ],
            [
                'image_url' => 'https://cdn.pixabay.com/photo/2017/08/07/00/37/basil-2597125_960_720.jpg',
                'name' => 'Basil',
                'information' => 'A culinary herb from the mint family.',
                'categories' => ['Herbs', 'Succulents'],
            ],
        ];

        foreach ($plants as $plantData) {
            $plant = Plant::create([
                'image_url' => $plantData['image_url'],
                'name' => $plantData['name'],
                'information' => $plantData['information'],
            ]);

            $categoryIds = Category::whereIn('name', $plantData['categories'])->pluck('id');
            $plant->categories()->sync($categoryIds);
        }
    }
}
