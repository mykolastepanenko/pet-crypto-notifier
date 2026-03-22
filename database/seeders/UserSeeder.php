<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('ALTER TABLE users DISABLE KEYS');
        for ($i = 1; $i <= 1000000; $i++) {
            $batch[] = [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => fake()->password(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % 5000 === 0) {
                DB::table('users')->insert($batch);
                unset($batch);
                dump($i);
            }
        }

        DB::statement('ALTER TABLE users ENABLE KEYS');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    protected function getSQL(): ?string
    {
        return <<<SQL
INSERT INTO users (
   name,
   email,
   email_verified_at,
   password,
   remember_token,
   created_at,
   updated_at
) values (
  :name,
  :email,
  :email_verified_at,
  :password,
  :remember_token,
  :created_at,
  :updated_at
)
SQL;
    }
}
