<?php

namespace Database\Seeders;

use App\Models\type_input;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_seed = [
            [
                'id_type_input' => 1,
                'name' => 'Urea'
            ],
            [
                'id_type_input' => 2,
                'name' => 'Phonska'
            ],
        ];

        foreach ($arr_seed as $key => $value) {
            $check_data = type_input::where('id_type_input', $value['id_type_input'])->first();
            if (empty($check_data)) {
                type_input::insert($value);
            }
        }
    }
}
