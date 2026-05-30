<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acts = [
            // ERA 1 — Fajar Kemanusiaan (chapter_id: 1)
            [
                'chapter_id' => 1,
                'name' => 'Nafas Pertama di Bumi',
                'description' => 'Kisah Nabi Adam, manusia pertama, yang memulai perjalanan panjang umat manusia.',
                'order_number' => 1,
            ],
            [
                'chapter_id' => 1,
                'name' => 'Cahaya Ilmu yang Terangkat',
                'description' => 'Perjalanan Nabi Idris, simbol ilmu, ketekunan, dan peradaban awal.',
                'order_number' => 2,
            ],
            [
                'chapter_id' => 1,
                'name' => 'Peringatan di Tengah Kelalaian',
                'description' => 'Dakwah Nabi Nuh, tentang kesabaran menghadapi penolakan dan awal ujian besar umat manusia.',
                'order_number' => 3,
            ],

            // ERA 2 — Nyala Tauhid di Tengah Dunia yang Bergolak (chapter_id: 2)
            [
                'chapter_id' => 2,
                'name' => 'Seruan di Tanah Kaum yang Keras',
                'description' => 'Perjuangan Nabi Hud dan Nabi Shaleh menghadapi kaum yang sombong.',
                'order_number' => 1,
            ],
            [
                'chapter_id' => 2,
                'name' => 'Api Ujian Seorang Kekasih Tuhan',
                'description' => 'Kisah Nabi Ibrahim, tentang keberanian melawan kesyirikan dan ketaatan tanpa syarat.',
                'order_number' => 2,
            ],
            [
                'chapter_id' => 2,
                'name' => 'Kota yang Tenggelam dalam Dosa',
                'description' => 'Peringatan keras dari Nabi Luth terhadap penyimpangan moral.',
                'order_number' => 3,
            ],
            [
                'chapter_id' => 2,
                'name' => 'Akar Keturunan yang Diberkahi',
                'description' => 'Jejak Nabi Ismail, Nabi Ishaq, dan Nabi Yaqub sebagai awal garis besar para nabi.',
                'order_number' => 4,
            ],
            [
                'chapter_id' => 2,
                'name' => 'Dari Sumur ke Singgasana',
                'description' => 'Perjalanan Nabi Yusuf tentang kesabaran, pengkhianatan, dan kemuliaan.',
                'order_number' => 5,
            ],

            // ERA 3 — Ujian yang Membakar, Harapan yang Membebaskan (chapter_id: 3)
            [
                'chapter_id' => 3,
                'name' => 'Sabar yang Tak Tergoyahkan',
                'description' => 'Keteguhan Nabi Ayyub dalam menghadapi penderitaan.',
                'order_number' => 1,
            ],
            [
                'chapter_id' => 3,
                'name' => 'Timbangan yang Curang',
                'description' => 'Dakwah Nabi Syu\'aib melawan ketidakadilan dalam ekonomi dan moral.',
                'order_number' => 2,
            ],
            [
                'chapter_id' => 3,
                'name' => 'Tongkat yang Membelah Laut',
                'description' => 'Perjuangan Nabi Musa dan Nabi Harun melawan tirani dan membebaskan umat.',
                'order_number' => 3,
            ],

            // ERA 4 — Cahaya Hikmah di Singgasana Kekuasaan (chapter_id: 4)
            [
                'chapter_id' => 4,
                'name' => 'Raja yang Adil',
                'description' => 'Kepemimpinan Nabi Daud yang tegas dan bijaksana.',
                'order_number' => 1,
            ],
            [
                'chapter_id' => 4,
                'name' => 'Kerajaan yang Mendengar Angin',
                'description' => 'Kisah Nabi Sulaiman, tentang kekuasaan besar yang tunduk pada Tuhan.',
                'order_number' => 2,
            ],
            [
                'chapter_id' => 4,
                'name' => 'Suara Kebenaran di Tengah Penyimpangan',
                'description' => 'Perjuangan Nabi Ilyas dan Nabi Ilyasa menjaga tauhid.',
                'order_number' => 3,
            ],
            [
                'chapter_id' => 4,
                'name' => 'Doa dari Dalam Kegelapan',
                'description' => 'Taubat dan harapan dari Nabi Yunus.',
                'order_number' => 4,
            ],
            [
                'chapter_id' => 4,
                'name' => 'Cahaya di Akhir Zaman Bani Israil',
                'description' => 'Kisah Nabi Zakariya dan Nabi Yahya yang penuh keteladanan.',
                'order_number' => 5,
            ],

            // ERA 5 — Penutup Cahaya Kenabian (chapter_id: 5)
            [
                'chapter_id' => 5,
                'name' => 'Ruh yang Menghidupkan Hati',
                'description' => 'Mukjizat dan kelembutan Nabi Isa dalam membimbing umat.',
                'order_number' => 1,
            ],
            [
                'chapter_id' => 5,
                'name' => 'Cahaya untuk Seluruh Alam',
                'description' => 'Perjalanan Nabi Muhammad ﷺ sebagai penutup para nabi dan pembawa rahmat bagi semesta.',
                'order_number' => 2,
            ],
        ];

        foreach ($acts as $act) {
            \App\Models\Act::create($act);
        }
    }
}
