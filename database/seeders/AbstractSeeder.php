<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

abstract class AbstractSeeder extends Seeder
{
    protected function getSQL(): ?string
    {
        return null;
    }
}
