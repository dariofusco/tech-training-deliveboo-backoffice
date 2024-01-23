<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Typology;

class TypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typologies = [
            [
                'name' => 'Americano',
            ],
            [
                'name' => 'Cinese',
            ],
            [
                'name' => 'Giapponese',
            ],
            [
                'name' => 'Greco',
            ],
            [
                'name' => 'Hawaiano',
            ],
            [
                'name' => 'Indiano',
            ],
            [
                'name' => 'Italiano',
            ],
            [
                'name' => 'Messicano',
            ],
            [
                'name' => 'Spagnolo',
            ],
            [
                'name' => 'Tedesco',
            ],
            [
                'name' => 'Thailandese',
            ],
            [
                'name' => 'Turco',
            ],
        ];

        foreach ($typologies as $typology) {
            $newTypology = new Typology();
            $newTypology->name = $typology['name'];
            $newTypology->save();
        }
    }
}
