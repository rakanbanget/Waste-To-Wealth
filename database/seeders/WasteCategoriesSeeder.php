<?php

namespace Database\Seeders;

use App\Models\WasteCategory;
use App\Models\ProductIdea;
use Illuminate\Database\Seeder;

class WasteCategoriesSeeder extends Seeder
{
    public function run()
    {
        // Kategori Botol Plastik
        $bottleCategory = WasteCategory::create([
            'name' => 'botol plastik PET',
            'detection_keywords' => ['botol plastik', 'botol air mineral', 'botol soda', 'plastik bening']
        ]);

        ProductIdea::create([
            'waste_category_id' => $bottleCategory->id,
            'name' => 'Pot Bunga Gantung',
            'difficulty_level' => 'Mudah',
            'required_tools' => ['tali', 'cat', 'cutter'],
            'short_description' => 'Mengubah botol bekas jadi pot tanaman vertikal.',
            'estimated_time' => '1 jam'
        ]);

        ProductIdea::create([
            'waste_category_id' => $bottleCategory->id,
            'name' => 'Celengan Karakter',
            'difficulty_level' => 'Mudah',
            'required_tools' => ['cat', 'lem', 'aksesoris mata'],
            'short_description' => 'Membuat celengan lucu dari botol plastik.',
            'estimated_time' => '1-2 jam'
        ]);

        // Kategori Kardus
        $cardboardCategory = WasteCategory::create([
            'name' => 'kardus bekas',
            'detection_keywords' => ['dus karton', 'kotak bekas', 'kardus coklat', 'kardus']
        ]);

        ProductIdea::create([
            'waste_category_id' => $cardboardCategory->id,
            'name' => 'Rak Buku Mini Dinding',
            'difficulty_level' => 'Sedang',
            'required_tools' => ['lem kuat', 'penggaris', 'cutter'],
            'short_description' => 'Membuat rak buku atau penyimpanan minimalis.',
            'estimated_time' => '2-3 jam'
        ]);

        ProductIdea::create([
            'waste_category_id' => $cardboardCategory->id,
            'name' => 'Kotak Penyimpanan Estetik',
            'difficulty_level' => 'Mudah',
            'required_tools' => ['kain/kertas kado', 'lem'],
            'short_description' => 'Melapisi kardus bekas jadi kotak penyimpanan menarik.',
            'estimated_time' => '1-2 jam'
        ]);
    }
}
