<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $misPosts = \App\Models\Post::factory(5)->create();
        $tagsId=Tag::pluck('id')->toArray();//[1, 2, 3, 4, 5, 6, 7, 8]
        foreach($misPosts as $post){
            $a=array_slice($tagsId, 0, random_int(1, count($tagsId)));
            $post->tags()->attach($a);
            //$post->tags()->attach([1,2,3])
            //5, 1 == 5, 2 == 5, 3 
        }
        
    }
}
