<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder{
	
	public function run(){

		$faker = Faker\Factory::create();

		foreach(range(1,30) as $index){
			Article::create([
			'category' => $faker -> randomElement(array ('Blog','Things','Guest','Game','Recommendation')),
			'title' => $faker->sentence(),
			'body' => $faker->text(),
			'excerpt' => $faker->text($maxNbChars = 500)
			]);

		}

	}


}

?>