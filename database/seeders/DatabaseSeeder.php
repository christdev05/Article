<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\TypeArticleTableSeeder;
use Database\Seeders\DureeLocationTableSeeder;
use Database\Seeders\StatutLocationTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->Call(TypeArticleTableSeeder::class);

        Article::factory(100)->create();
        Client::factory(100)->create();
        User::factory(50)->create();

        $this->call(RoleTableSeeder::class);
        $this->call(StatutLocationTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(DureeLocationTableSeeder::class);

        User::find(1)->roles()->attach(1);
        User::find(2)->roles()->attach(2);
        User::find(3)->roles()->attach(3);
    }
}
