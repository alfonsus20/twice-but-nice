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
        $category_1 = new Category;
        $category_1->category_name = 'baju';
        $category_1->save();

        $category_2 = new Category;
        $category_2->category_name = 'celana';
        $category_2->save();

        $category_3 = new Category;
        $category_3->category_name = 'hoodie';
        $category_3->save();
    }
}
