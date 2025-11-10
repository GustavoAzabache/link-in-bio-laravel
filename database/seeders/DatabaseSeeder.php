<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)
            ->has(Profile::factory()
                ->has(Link::factory(3))
            )
            ->create();
    }
}
