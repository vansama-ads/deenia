<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizPair;

class QuizPairSeeder extends Seeder
{
    public function run(): void
    {
        $pairs = [

            // Quiz 1 - Nabi Adam
            ['quiz_id' => 1, 'left_text' => 'Nabi Adam', 'right_text' => 'Manusia pertama'],
            ['quiz_id' => 1, 'left_text' => 'Hawa', 'right_text' => 'Pasangan Nabi Adam'],
            ['quiz_id' => 1, 'left_text' => 'Surga', 'right_text' => 'Tempat tinggal awal Adam'],

            // Quiz 2 - Nabi Idris
            ['quiz_id' => 2, 'left_text' => 'Nabi Idris', 'right_text' => 'Nabi yang dikenal berilmu'],
            ['quiz_id' => 2, 'left_text' => 'Menulis', 'right_text' => 'Keahlian yang diajarkan'],
            ['quiz_id' => 2, 'left_text' => 'Ketekunan', 'right_text' => 'Sifat utama Nabi Idris'],

            // Quiz 3 - Nabi Nuh
            ['quiz_id' => 3, 'left_text' => 'Bahtera', 'right_text' => 'Kapal penyelamat'],
            ['quiz_id' => 3, 'left_text' => 'Banjir Besar', 'right_text' => 'Azab bagi kaum Nuh'],
            ['quiz_id' => 3, 'left_text' => '950 Tahun', 'right_text' => 'Lama dakwah Nabi Nuh'],

            // Quiz 4 - Hud & Shaleh
            ['quiz_id' => 4, 'left_text' => 'Kaum Ad', 'right_text' => 'Kaum Nabi Hud'],
            ['quiz_id' => 4, 'left_text' => 'Kaum Tsamud', 'right_text' => 'Kaum Nabi Shaleh'],
            ['quiz_id' => 4, 'left_text' => 'Unta Betina', 'right_text' => 'Mukjizat Nabi Shaleh'],

            // Quiz 5 - Ibrahim
            ['quiz_id' => 5, 'left_text' => 'Khalilullah', 'right_text' => 'Kekasih Allah'],
            ['quiz_id' => 5, 'left_text' => 'Berhala', 'right_text' => 'Dihancurkan Nabi Ibrahim'],
            ['quiz_id' => 5, 'left_text' => 'Api', 'right_text' => 'Menjadi dingin atas izin Allah'],

            // Quiz 6 - Luth
            ['quiz_id' => 6, 'left_text' => 'Nabi Luth', 'right_text' => 'Menyeru kepada akhlak yang benar'],
            ['quiz_id' => 6, 'left_text' => 'Kaum Sodom', 'right_text' => 'Kaum Nabi Luth'],
            ['quiz_id' => 6, 'left_text' => 'Moral', 'right_text' => 'Pesan utama dakwahnya'],

            // Quiz 7 - Ismail, Ishaq, Yaqub
            ['quiz_id' => 7, 'left_text' => 'Ismail', 'right_text' => 'Putra Nabi Ibrahim'],
            ['quiz_id' => 7, 'left_text' => 'Ishaq', 'right_text' => 'Anak Nabi Ibrahim dari Sarah'],
            ['quiz_id' => 7, 'left_text' => 'Yaqub', 'right_text' => 'Ayah Nabi Yusuf'],

            // Quiz 8 - Yusuf
            ['quiz_id' => 8, 'left_text' => 'Sumur', 'right_text' => 'Tempat Nabi Yusuf dibuang'],
            ['quiz_id' => 8, 'left_text' => 'Mesir', 'right_text' => 'Tempat Yusuf menjadi pemimpin'],
            ['quiz_id' => 8, 'left_text' => 'Kesabaran', 'right_text' => 'Pelajaran utama kisah Yusuf'],

            // Quiz 9 - Ayyub
            ['quiz_id' => 9, 'left_text' => 'Penyakit', 'right_text' => 'Ujian Nabi Ayyub'],
            ['quiz_id' => 9, 'left_text' => 'Sabar', 'right_text' => 'Sifat utama Nabi Ayyub'],
            ['quiz_id' => 9, 'left_text' => 'Syukur', 'right_text' => 'Sikap setelah mendapat nikmat'],

            // Quiz 10 - Syu'aib
            ['quiz_id' => 10, 'left_text' => 'Timbangan', 'right_text' => 'Hal yang sering dicurangi'],
            ['quiz_id' => 10, 'left_text' => 'Kejujuran', 'right_text' => 'Nilai yang diajarkan'],
            ['quiz_id' => 10, 'left_text' => 'Perdagangan', 'right_text' => 'Fokus dakwah Nabi Syu’aib'],

            // Quiz 11 - Musa & Harun
            ['quiz_id' => 11, 'left_text' => 'Tongkat', 'right_text' => 'Mukjizat Nabi Musa'],
            ['quiz_id' => 11, 'left_text' => 'Fir’aun', 'right_text' => 'Penguasa yang dilawan'],
            ['quiz_id' => 11, 'left_text' => 'Laut Merah', 'right_text' => 'Terbelah atas izin Allah'],
            
            // Quiz 12 - Daud
            ['quiz_id' => 12, 'left_text' => 'Nabi Daud', 'right_text' => 'Raja yang adil'],
            ['quiz_id' => 12, 'left_text' => 'Zabur', 'right_text' => 'Kitab yang diterima Nabi Daud'],
            ['quiz_id' => 12, 'left_text' => 'Keadilan', 'right_text' => 'Ciri utama kepemimpinannya'],

            // Quiz 13 - Sulaiman
            ['quiz_id' => 13, 'left_text' => 'Nabi Sulaiman', 'right_text' => 'Raja yang bijaksana'],
            ['quiz_id' => 13, 'left_text' => 'Angin', 'right_text' => 'Tunduk atas izin Allah'],
            ['quiz_id' => 13, 'left_text' => 'Semut', 'right_text' => 'Makhluk yang dipahami bahasanya'],

            // Quiz 14 - Ilyas & Ilyasa
            ['quiz_id' => 14, 'left_text' => 'Tauhid', 'right_text' => 'Inti dakwah Nabi Ilyas'],
            ['quiz_id' => 14, 'left_text' => 'Penyembahan Berhala', 'right_text' => 'Ditentang Nabi Ilyas'],
            ['quiz_id' => 14, 'left_text' => 'Ilyasa', 'right_text' => 'Penerus dakwah Nabi Ilyas'],

            // Quiz 15 - Yunus
            ['quiz_id' => 15, 'left_text' => 'Ikan Besar', 'right_text' => 'Tempat Nabi Yunus berada'],
            ['quiz_id' => 15, 'left_text' => 'Taubat', 'right_text' => 'Pelajaran utama kisah Yunus'],
            ['quiz_id' => 15, 'left_text' => 'Doa', 'right_text' => 'Jalan keselamatan Nabi Yunus'],

            // Quiz 16 - Zakariya & Yahya
            ['quiz_id' => 16, 'left_text' => 'Zakariya', 'right_text' => 'Ayah Nabi Yahya'],
            ['quiz_id' => 16, 'left_text' => 'Yahya', 'right_text' => 'Nabi yang saleh sejak kecil'],
            ['quiz_id' => 16, 'left_text' => 'Keteladanan', 'right_text' => 'Ciri utama keduanya'],

            // Quiz 17 - Isa
            ['quiz_id' => 17, 'left_text' => 'Nabi Isa', 'right_text' => 'Membawa Injil'],
            ['quiz_id' => 17, 'left_text' => 'Mukjizat', 'right_text' => 'Menghidupkan orang mati atas izin Allah'],
            ['quiz_id' => 17, 'left_text' => 'Kasih Sayang', 'right_text' => 'Pesan utama dakwahnya'],

            // Quiz 18 - Muhammad ﷺ
            ['quiz_id' => 18, 'left_text' => 'Al-Qur\'an', 'right_text' => 'Kitab Nabi Muhammad ﷺ'],
            ['quiz_id' => 18, 'left_text' => 'Makkah', 'right_text' => 'Kota kelahiran Nabi Muhammad ﷺ'],
            ['quiz_id' => 18, 'left_text' => 'Khatamun Nabiyyin', 'right_text' => 'Penutup para nabi'],
                    ];

        foreach ($pairs as $pair) {
            QuizPair::create($pair);
        }
    }
}