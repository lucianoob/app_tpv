<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_example = DB::table('categories')->where('id', '123456')->exists();
        if(!$category_example) {
            Category::create([
                'id'    => 123456,
                'name'    => 'Ferramentas',
                'description'    => 'Ferramentas diversas.',
            ]);
        }
    }
}
