<?php

use App\Models\Helpers\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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
                "name"=>"Движение",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Тичане",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Тренировки",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Риболов",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"PHP",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Java",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Javascript",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Go",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
            [
                "name"=>"Scala",
                "created_at"=>now(),
                "updated_at"=>now(),
            ],
        ];
        Tag::insert($data);
    }
}
