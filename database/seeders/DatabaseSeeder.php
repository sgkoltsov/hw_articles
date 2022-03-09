<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Role;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $numberOfUsers = rand(2, 5);

        $role = Role::factory()->create(['name' => 'Author']);

        // for ($i=0; $i < $numberOfUsers; $i++) { 
        //     User::factory()
        //         ->hasAttached($role)               
        //         ->hasArticles(rand(3,7), function(array $attributes, User $user) {
        //             return ['user_id' => $user->id];
        //         })
        //         ->create();
        // }   

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
            
            for ($i=0; $i < $randomArticlesCount; $i++) { 
           
                $randomTagsCount = rand(1, 5);

                Article::factory()                                       
                    ->for($user, 'owner')
                    ->hasAttached($tags->random($randomTagsCount))
                    ->create()
                ;
            }                       
        }
    }
}
