<?php

use Illuminate\Database\Seeder;
use App\Models\Category; 

class category_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
		$cat = new Category;

		$cat->id = 1;
		$cat->parent_id = 0;
		$cat->name = 'News';
		$cat->slug = 'news';
		$cat->user_id_created = 1;
		$cat->postable = 0;
		$cat->order = 1;
		$cat->save(); 


				$cat = new Category;
				$cat->id = 4;
				$cat->parent_id = 1;
				$cat->name = 'Politics';
				$cat->slug = 'politics';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 1;
				$cat->save(); 

				$cat = new Category;
				$cat->id = 5;
				$cat->parent_id = 1;
				$cat->name = 'Technology';
				$cat->slug = 'technology';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 2;
				$cat->save(); 


				$cat = new Category;
				$cat->id = 6;
				$cat->parent_id = 1;
				$cat->name = 'Business';
				$cat->slug = 'business';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 3;
				$cat->save(); 

				$cat = new Category;
				$cat->id = 7;
				$cat->parent_id = 1;
				$cat->name = 'Education';
				$cat->slug = 'education';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 4;
				$cat->save(); 

				$cat = new Category;
				$cat->id = 8;
				$cat->parent_id = 1;
				$cat->name = 'Health';
				$cat->slug = 'health';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 5;
				$cat->save(); 

				$cat = new Category;
				$cat->id = 9;
				$cat->parent_id = 1;
				$cat->name = 'Energy';
				$cat->slug = 'energy';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 6;
				$cat->save(); 

				$cat = new Category;
				$cat->id = 10;
				$cat->parent_id = 1;
				$cat->name = 'International';
				$cat->slug = 'international';
				$cat->postable = 1;
				$cat->user_id_created = 1;
				$cat->order = 7;
				$cat->save(); 



// ---------------------------------------------
		$cat = new Category;
		$cat->id = 2;
		$cat->parent_id = 0;
		$cat->name = 'News Analysis';
		$cat->slug = 'news_analysis';
		$cat->user_id_created = 1;
		$cat->postable = 1;
		$cat->order = 2;
		$cat->save(); 
// ---------------------------------------------


		$cat = new Category;
		$cat->id = 3;
		$cat->parent_id = 0;
		$cat->name = 'Opinion';
		$cat->slug = 'opinion';
		$cat->user_id_created = 1;
		$cat->postable = 0;
		$cat->order = 3;
		$cat->save(); 

				$cat = new Category;
				$cat->id = 11;
				$cat->parent_id = 3;
				$cat->name = 'Domestic Policy';
				$cat->slug = 'domestic_policy';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 1;
				$cat->save(); 

				$cat = new Category;
				$cat->id = 12;
				$cat->parent_id = 3;
				$cat->name = 'Forgeign Policy';
				$cat->slug = 'forgeign_policy';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 2;
				$cat->save(); 

						$cat = new Category;
				$cat->id = 13;
				$cat->parent_id = 3;
				$cat->name = 'Point-Counterpoint';
				$cat->slug = 'point_counterpoint';
				$cat->user_id_created = 1;
				$cat->postable = 1;
				$cat->order = 3;
				$cat->save(); 







    }
}
