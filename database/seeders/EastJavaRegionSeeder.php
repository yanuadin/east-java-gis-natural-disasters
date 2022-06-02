<?php

namespace Database\Seeders;

use App\Models\EastJavaRegionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EastJavaRegionSeeder extends Seeder
{
    protected array $east_java_regions = [
        [
            'name' => 'PACITAN'
        ],
        [
            'name' => 'PONOROGO'
        ],
        [
            'name' => 'TRENGGALEK'
        ],
        [
            'name' => 'TULUNGAGUNG'
        ],
        [
            'name' => 'BLITAR'
        ],
        [
            'name' => 'KEDIRI'
        ],
        [
            'name' => 'MALANG'
        ],
        [
            'name' => 'LUMAJANG'
        ],
        [
            'name' => 'JEMBER'
        ],
        [
            'name' => 'BANYUWANGI'
        ],
        [
            'name' => 'BONDOWOSO'
        ],
        [
            'name' => 'SITUBONDO'
        ],
        [
            'name' => 'PROBOLINGGO'
        ],
        [
            'name' => 'PASURUAN'
        ],
        [
            'name' => 'SIDOARJO'
        ],
        [
            'name' => 'MOJOKERTO'
        ],
        [
            'name' => 'JOMBANG'
        ],
        [
            'name' => 'NGANJUK'
        ],
        [
            'name' => 'MADIUN'
        ],
        [
            'name' => 'MAGETAN'
        ],
        [
            'name' => 'NGAWI'
        ],
        [
            'name' => 'BOJONEGORO'
        ],
        [
            'name' => 'TUBAN'
        ],
        [
            'name' => 'LAMONGAN'
        ],
        [
            'name' => 'GRESIK'
        ],
        [
            'name' => 'BANGKALAN'
        ],
        [
            'name' => 'SAMPANG'
        ],
        [
            'name' => 'PAMEKASAN'
        ],
        [
            'name' => 'SUMENEP'
        ],
        [
            'name' => 'KOTA KEDIRI'
        ],
        [
            'name' => 'KOTA BLITAR'
        ],
        [
            'name' => 'KOTA MALANG'
        ],
        [
            'name' => 'KOTA PROBOLINGGO'
        ],
        [
            'name' => 'KOTA PASURUAN'
        ],
        [
            'name' => 'KOTA MOJOKERTO'
        ],
        [
            'name' => 'KOTA MADIUN'
        ],
        [
            'name' => 'KOTA SURABAYA'
        ],
        [
            'name' => 'KOTA BATU'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->east_java_regions as $data) {
            $east_java_region = new EastJavaRegionModel();
            $east_java_region->fill($data);
            $east_java_region->save();
            $this->command->info('East Java Region `'.$east_java_region->name.'` has been successfully seeded!');
        }
    }
}
