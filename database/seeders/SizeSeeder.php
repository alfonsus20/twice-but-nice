<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size_1 = new Size;
        $size_1->size_name = 'S';
        $size_1->save();
        
        $size_2 = new Size;
        $size_2->size_name = 'M';
        $size_2->save();
        
        $size_3 = new Size;
        $size_3->size_name = 'L';
        $size_3->save();
        
        $size_4 = new Size;
        $size_4->size_name = 'XL';
        $size_4->save();

    }
}
