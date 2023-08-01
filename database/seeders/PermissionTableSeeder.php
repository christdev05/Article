<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("permissions")->insert([
            ["nom"=> "ajouter un client"],
            ["nom"=> "consulter un client"],
            ["nom"=> "editer un client"],

            ["nom"=> "ajouter une location"],
            ["nom"=> "consulter une location"],
            ["nom"=> "editer une location"],

            ["nom"=> "ajouter un article"],
            ["nom"=> "consulter un article"],
            ["nom"=> "editer un article"]
        ]);
    }
}
