<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Role;
use App\Models\Tag;
use App\Models\News;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::factory()->create(['name' => 'Author']);           

        $users = User::factory()
            ->count(rand(2, 5))    
            ->hasAttached($role)
            ->create()
        ;

        $tags = Tag::factory()
            ->count(10)
            ->create()
        ;        

        foreach ($users as $user) {

            $randomArticlesCount = rand(3, 7);
            
            for ( $i = 0 ; $i < $randomArticlesCount ; $i++ ) {
           
                $randomTagsCount = rand(1, 5);

                Article::factory()                                       
                    ->for($user, 'owner')
                    ->hasAttached($tags->random($randomTagsCount))
                    ->create(['published' => rand(0, 1)])
                ;
            }                       
        }

        $randomNewsCount = rand(10, 20);
            
        for ( $i = 0 ; $i < $randomNewsCount ; $i++ ) {
       
            $randomTagsCount = rand(1, 5);

            News::factory()
                ->hasAttached($tags->random($randomTagsCount))
                ->create()
            ;
        }        
    }
}
