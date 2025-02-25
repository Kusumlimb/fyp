<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $student = User::factory()->create([
             'name' => 'Test Student',
             'email' => 'student@example.com',
        ]);

        $courses = DB::table('courses')->insert([
             [
                  'user_id' => $teacher->id,
                  'title'     => 'Spanish',
                  'description' => 'Learn Spanish',
                  'price'     => 1000,
                  'created_at' => now(),
                  'updated_at' => now(),
             ],
             [
                  'user_id' => $teacher->id,
                  'title'     => 'French',
                  'description' => 'Learn French',
                  'price'     => 1000,
                  'created_at' => now(),
                  'updated_at' => now(),
             ]
        ]);
        $this->call([
              QuizSeeder::class,
        ]);
    }
}
