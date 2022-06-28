<?php
use App\Tag;
//use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['coding', 'laravel', 'css', 'js', 'vue', 'php'];

              foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->title = $tag;
            $new_tag->save();
        } 
    }
}
