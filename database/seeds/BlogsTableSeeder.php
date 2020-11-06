<?php

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factoryのBlogクラスを使用して15こデータを作る*/
        factory(Blog::class, 15)->create();
    }
}
