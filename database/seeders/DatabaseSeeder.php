<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teacher = User::factory()->create([
            'name' => 'Test Teacher',
            'email' => 'teacher@example.com',
        ]);

        User::factory()->create([
             'name' => 'Test Student',
             'email' => 'student@example.com',
        ]);

        User::factory()->create([
             'name' => 'Test Admin',
             'email' => 'admin@example.com',
        ]);

        DB::table('courses')->insert([
             [
                  'user_id' => $teacher->id,
                  'title'     => 'Spanish',
                  'slug' => 'spanish',
                  'description' => 'Learn Spanish',
                  'price'     => 1000,
                  'thumbnail' => 'courses/thumbnails/es.png',
                  'created_at' => now(),
                  'updated_at' => now(),
             ],
             [
                  'user_id' => $teacher->id,
                  'title'     => 'French',
                  'slug' => 'french',
                  'description' => 'Learn French',
                  'price'     => 1000,
                  'thumbnail' => 'courses/thumbnails/fr.png',
                  'created_at' => now(),
                  'updated_at' => now(),
             ],
             [
                  'user_id' => $teacher->id,
                  'title'     => 'Korean',
                  'slug' => 'korean',
                  'description' => 'Learn Korean',
                  'price'     => 1000,
                  'thumbnail' => 'courses/thumbnails/kr.png',
                  'created_at' => now(),
                  'updated_at' => now(),
             ],
             [
                  'user_id' => $teacher->id,
                  'title'     => 'English',
                  'slug' => 'english',
                  'description' => 'Learn English',
                  'price'     => 1000,
                  'thumbnail' => 'courses/thumbnails/us.png',
                  'created_at' => now(),
                  'updated_at' => now(),
             ],
        ]);
        $this->call([
              QuizSeeder::class,
        ]);
    }
}
