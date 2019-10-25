<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name"=>"Здраве",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Хоби",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Новини",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Работа",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
        ];
        Category::insert($data);
    }
}
