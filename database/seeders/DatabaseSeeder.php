<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use Illuminate\Testing\Fluent\Concerns\Has;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            "name" => "jānis",
            "email"=> "tebija@inbex.lv",
            "password" => Hash::make("janisthebest")
        ]);
//       User::create([
//           "name" => "admin",
//           "email" => "admin@rvt.lv",
//           "password" => Hash::make("password123")
//       ]);
//
//        Product::create([
//            "title"=> "Jovanny Bode"
//        ]);
//
//        Product::create([
//            "title"=> "Reese Gutmann"
//        ]);
//
//        Product::create([
//            "title"=> "Prof. Tommie Bosco V"
//        ]);
//
//        Product::create([
//            "title"=> "Arvel Jast"
//        ]);
//
//        Product::create([
//            "title"=> "Mary Wyman"
//        ]);
//
//        Product::create([
//            "title"=> "Kayleigh Beier"
//        ]);
//
//        Product::create([
//            "title"=> "Prof. Virginia Schamberger"
//        ]);
//
//        Product::create([
//            "title"=> "Haleigh Marks"
//        ]);
//
//        Product::create([
//            "title"=> "Miss Alvena Schmeler"
//        ]);
//
//        Product::create([
//            "title"=> "Kristoffer Douglas"
//        ]);
//
//        Product::create([
//            "title"=> "Reese Gutmann"
//        ]);
//
//        Product::create([
//            "title"=> "Prof. Tommie Bosco V"
//        ]);
//
//        Product::create([
//            "title"=> "Arvel Jast"
//        ]);
//
//        Product::create([
//            "title"=> "Mary Wyman"
//        ]);
//
//        Product::create([
//            "title"=> "Jovanny Bode"
//        ]);
//
//        Product::create([
//            "title"=> "Reese Gutmann"
//        ]);
//
//        Product::create([
//            "title"=> "Prof. Tommie Bosco V"
//        ]);


    }
}
