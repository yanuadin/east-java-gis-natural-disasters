<?php

namespace Database\Seeders;

use App\Models\TypeOfDisasterModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfDisasterSeeder extends Seeder
{
    protected array $type_of_disasters = [
        [
            'name' => 'BANJIR'
        ],
        [
            'name' => 'TANAH LONGSOR'
        ],
        [
            'name' => 'BANJIR DAN TANAH LONGSOR'
        ],
        [
            'name' => 'ABRASI'
        ],
        [
            'name' => 'PUTTING BELIUNG'
        ],
        [
            'name' => 'KEKERINGAN'
        ],
        [
            'name' => 'KEBAKARAN HUTAN DAN LAHAN'
        ],
        [
            'name' => 'GEMPA BUMI'
        ],
        [
            'name' => 'TSUNAMI'
        ],
        [
            'name' => 'GEMPA BUMI DAN TSUNAMI'
        ],
        [
            'name' => 'LETUSAN GUNUNG API'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->type_of_disasters as $data) {
            $type_of_disaster = new TypeOfDisasterModel();
            $type_of_disaster->fill($data);
            $type_of_disaster->save();
            $this->command->info('Type `'.$type_of_disaster->name.'` has been successfully seeded!');
        }
    }
}
