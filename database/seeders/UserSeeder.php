<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user1 = new User();
        $user1->name = "ADMIN";
        $user1->email = "admin@mail.com";
        $user1->password = bcrypt("admin54321");
        $user1->save();

        $user1 = new User();
        $user1->name = "CAJERO";
        $user1->email = "joel@mail.com";
        $user1->password = bcrypt("joel54321");
        $user1->save();
        
    }
}
