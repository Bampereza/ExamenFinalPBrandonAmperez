<?php

namespace Database\Seeders;
use App\Models\Personas;
use Illuminate\Database\Seeder;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personas::factory(10)->create();
    }
}
