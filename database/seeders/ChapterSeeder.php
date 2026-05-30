<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chapter;

class ChapterSeeder extends Seeder
{
    public function run()
    {
        $chapters = [
            [
                'id' => 1,
                'name' => 'Fajar Kemanusiaan',
                'description' => 'Awal mula manusia mengenal dirinya, Tuhannya, dan makna hidup.',
                'order_number' => 1,
                'created_at' => '2026-04-26 14:20:57',
                'updated_at' => '2026-04-26 14:20:57',
            ],
            [
                'id' => 2,
                'name' => 'Nyala Tauhid di Tengah Dunia yang Bergolak',
                'description' => 'Saat kebenaran mulai diuji oleh kekuasaan, tradisi, dan kesombongan manusia.',
                'order_number' => 2,
                'created_at' => '2026-04-26 14:33:59',
                'updated_at' => '2026-04-26 14:33:59',
            ],
            [
                'id' => 3,
                'name' => 'Ujian yang Membakar, Harapan yang Membebaskan',
                'description' => 'Ketika penderitaan menguatkan iman, dan pertolongan datang setelah kesabaran.',
                'order_number' => 3,
                'created_at' => '2026-04-26 14:34:18',
                'updated_at' => '2026-04-26 14:34:18',
            ],
            [
                'id' => 4,
                'name' => 'Cahaya Hikmah di Singgasana Kekuasaan',
                'description' => 'Ketika kekuatan diuji oleh keadilan, dan kepemimpinan dipandu oleh wahyu.',
                'order_number' => 4,
                'created_at' => '2026-04-26 14:34:36',
                'updated_at' => '2026-04-26 14:34:36',
            ],
            [
                'id' => 5,
                'name' => 'Penutup Cahaya Kenabian',
                'description' => 'Puncak risalah yang menyempurnakan nilai-nilai kemanusiaan dan ketuhanan.',
                'order_number' => 5,
                'created_at' => '2026-04-26 14:34:54',
                'updated_at' => '2026-04-26 14:34:54',
            ],
        ];

        foreach ($chapters as $chapter) {
            Chapter::updateOrCreate(['id' => $chapter['id']], $chapter);
        }
    }
}
