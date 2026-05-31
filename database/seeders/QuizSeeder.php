<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [
            ['act_id' => 1, 'title' => 'Apa yang terjadi saat pertama kali manusia di bumi?'], // Adam
            ['act_id' => 2, 'title' => 'Apa kontribusi Nabi Idris terhadap peradaban manusia?'], // Idris
            ['act_id' => 3, 'title' => 'Mengapa Nabi Nuh membangun bahtera?'], // Nuh

            ['act_id' => 4, 'title' => 'Apa pesan utama Nabi Hud dan Nabi Shaleh kepada kaumnya?'],
            ['act_id' => 5, 'title' => 'Mengapa Nabi Ibrahim disebut Khalilullah?'],
            ['act_id' => 6, 'title' => 'Apa penyimpangan yang diperingatkan Nabi Luth?'],
            ['act_id' => 7, 'title' => 'Siapa saja keturunan yang melanjutkan garis para nabi?'],
            ['act_id' => 8, 'title' => 'Bagaimana perjalanan Nabi Yusuf dari sumur menuju kekuasaan?'],

            ['act_id' => 9, 'title' => 'Apa pelajaran terbesar dari kesabaran Nabi Ayyub?'],
            ['act_id' => 10, 'title' => 'Mengapa Nabi Syu’aib menentang praktik curang dalam perdagangan?'],
            ['act_id' => 11, 'title' => 'Bagaimana Nabi Musa dan Nabi Harun membebaskan Bani Israil?'],

            ['act_id' => 12, 'title' => 'Apa yang membuat Nabi Daud menjadi pemimpin yang adil?'],
            ['act_id' => 13, 'title' => 'Apa keistimewaan kerajaan Nabi Sulaiman?'],
            ['act_id' => 14, 'title' => 'Bagaimana Nabi Ilyas dan Nabi Ilyasa menjaga tauhid?'],
            ['act_id' => 15, 'title' => 'Apa yang dapat dipelajari dari kisah Nabi Yunus?'],
            ['act_id' => 16, 'title' => 'Apa keteladanan Nabi Zakariya dan Nabi Yahya?'],

            ['act_id' => 17, 'title' => 'Apa pesan utama yang dibawa Nabi Isa kepada umatnya?'],
            ['act_id' => 18, 'title' => 'Mengapa Nabi Muhammad ﷺ disebut penutup para nabi?'],
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}