<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            'title' => 'Food',
            'description' => 'Material, usually of plant or animal origin, that contains or consists of essential body nutrients, such as carbohydrates, fats, proteins, vitamins, or minerals, and is ingested and assimilated by an organism to produce energy, stimulate growth, and maintain life.'
        ]);

        DB::table('product_categories')->insert([
            'title' => 'Books',
            'description' => 'A book is a medium for recording information in the form of writing or images, typically composed of many pages bound together and protected by a cover. The technical term for this physical arrangement is codex. '
        ]);

        DB::table('product_categories')->insert([
            'title' => 'Furniture',
            'description' => 'Furniture refers to movable objects intended to support various human activities such as seating, eating, and sleeping. Furniture is also used to hold objects at a convenient height for work, or to store things.'
        ]);
    }
}
