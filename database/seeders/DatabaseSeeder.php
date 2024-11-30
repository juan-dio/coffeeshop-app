<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Juan Axl',
            'email' => 'juanaxl@gmail.com',
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ]);
        
        User::create([
            'name' => 'Juan Dio',
            'email' => 'juandio@gmail.com',
            'is_admin' => false,
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ]);

        Category::create([
            'name' => 'Coffee',
            'slug' => 'coffee'
        ]);

        Category::create([
            'name' => 'Non Coffee',
            'slug' => 'non-coffee'
        ]);

        Category::create([
            'name' => 'Snack',
            'slug' => 'snack'
        ]);
        
        Category::create([
            'name' => 'Dessert',
            'slug' => 'dessert'
        ]);

        Product::factory(24)->create();
    }
}
