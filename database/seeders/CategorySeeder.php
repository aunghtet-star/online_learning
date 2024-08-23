<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Cateogry;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // category seeder
        $data = [
            ['name'=>'Programming'],
            ['name'=>'Networking'],
            ['name'=>'Cyber Security'],
            ['name'=>'Artificial Intelligence'],
            ['name'=>'Data Science'],
        ];


        foreach($data as $d) {
            Category::create($d);
        }
    }
}
