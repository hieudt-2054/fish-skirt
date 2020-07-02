<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;

class PostSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = Category::all()->pluck('id');
        $faker = Faker::create('App\Post');
        for($i = 1 ; $i <= 100 ; $i++){
            $postType = array_rand([0,1]);
            $categoryId = array_rand($ids->all());
            while($categoryId == 0) {
                $categoryId = array_rand($ids->all());
            }
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'post_type' => $postType,
                'post_image_path' => 'https://www.insertcart.com/wp-content/uploads/2016/09/set-post-thumbnail-image.png',
                'body' => $faker->paragraph(),
                'category_id' => $categoryId,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
