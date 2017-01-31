<?php
use App\User;
use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $cats = Category::count();

        $counter = 1;
        
        foreach ($users as $user) {
            $c = rand(1, 7);
            for ($i = 1; $i <= $c; $i++) {

                $post = new Post();
                $post->title = 'Post '.$counter;
                $post->description = 'Description of post '.$counter;
                $post->user_id = $user->id;
                $post->save();

                $cat = rand(1, $cats);

                $post->categories()->attach($cat);
                
                $counter++;

            }
        }
    }
}
