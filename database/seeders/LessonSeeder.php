<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            // Act 1: Nafas Pertama di Bumi
            [
                'act_id' => 1,
                'title' => 'Penciptaan Manusia Pertama',
                'content' => <<<'MD'
# Penciptaan Manusia Pertama

## Tujuan Pembelajaran
Memahami bagaimana Allah SWT menciptakan manusia pertama dan tujuan penciptaan manusia di bumi.

## Kisah Singkat
Nabi Adam adalah manusia pertama yang diciptakan Allah SWT dari tanah liat. Allah membentuk beliau dengan sempurna, kemudian meniupkan roh ke dalamnya. Sebelum diciptakan manusia, Allah telah memerintahkan malaikat untuk bersujud kepada Adam. Allah juga mengajarkan kepada Adam nama-nama segala sesuatu sebagai bukti kemuliaan beliau. Dengan ilmu tersebut, Adam dibedakan dari para malaikat. Nabi Adam kemudian diutus oleh Allah untuk menjadi khalifah di bumi, pemimpin dan pengurus yang bertanggung jawab atas dunia.

## Hikmah
- Manusia memiliki kedudukan istimewa di mata Allah
- Ilmu adalah anugerah besar yang membedakan manusia dari makhluk lain
- Setiap manusia memiliki tanggung jawab sebagai khalifah di bumi

## Refleksi
Bagaimana kita bisa mensyukuri kedudukan istimewa ini? Apakah kita sudah menggunakan ilmu untuk berbuat baik?
MD
            ],
            [
                'act_id' => 1,
                'title' => 'Ujian di Surga',
                'content' => <<<'MD'
# Ujian di Surga

## Tujuan Pembelajaran
Memahami perintah Allah dan konsekuensi ketika tidak mematuhi perintah tersebut.

## Kisah Singkat
Setelah diciptakan, Nabi Adam dan istrinya Hawa ditempatkan di Surga dengan berbagai kenikmatan yang berlimpah. Allah memberikan mereka perintah yang jelas: jangan mendekati pohon tertentu. Namun, iblis datang membisikkan keraguan kepada keduanya, mengatakan bahwa Allah hanya melarang mereka agar tidak menjadi malaikat. Dengan tipu daya iblis, Adam dan Hawa akhirnya memakan buah dari pohon yang dilarang. Mereka pun menyadari kesalahan mereka dan memohon ampun kepada Allah.

## Hikmah
- Iblis selalu mencoba membisikkan keraguan terhadap perintah Allah
- Kesalahan manusia bisa diperbaiki dengan taubat yang tulus
- Kita harus hati-hati terhadap godaan dan persuasi yang menjauhkan dari kebenaran

## Refleksi
Bagaimana cara kita menghindari godaan iblis dalam kehidupan sehari-hari? Apakah kita sudah terbiasa memohon ampun atas kesalahan?
MD
            ],
            [
                'act_id' => 1,
                'title' => 'Turun ke Bumi',
                'content' => <<<'MD'
# Turun ke Bumi

## Tujuan Pembelajaran
Memahami bagaimana manusia memulai kehidupan di dunia dan misi yang harus diemban.

## Kisah Singkat
Setelah taubat mereka, Allah menerima permintaan maaf Nabi Adam dan istrinya. Namun mereka harus turun ke bumi sebagai tempat kehidupan manusia. Dengan turunnya Adam ke bumi, dimulailah babak baru sejarah manusia. Allah menjanjikan bahwa akan ada petunjuk bagi mereka yang mengikuti panduan Allah. Petunjuk ini akan diteruskan melalui para nabi dan rasul yang akan diutus Allah dari keturunan Adam. Dengan penuh kesabaran, Adam mulai membangun peradaban manusia di bumi.

## Hikmah
- Dunia adalah tempat ujian dan pembelajaran bagi manusia
- Allah tidak pernah membiarkan umatnya tanpa petunjuk
- Manusia diberi kesempatan untuk berkembang dan membaiki diri

## Refleksi
Apakah kita sudah menganggap dunia sebagai tempat untuk belajar dan berbuat baik? Bagaimana cara kita memanfaatkan petunjuk yang telah Allah berikan?
MD
            ],

            // Act 2: Cahaya Ilmu yang Terangkat
            [
                'act_id' => 2,
                'title' => 'Ilyas Pertama di Antara Manusia',
                'content' => <<<'MD'
# Ilyas Pertama di Antara Manusia

## Tujuan Pembelajaran
Memahami pentingnya ilmu pengetahuan dan bagaimana ilmu membedakan manusia.

## Kisah Singkat
Nabi Idris adalah manusia ketiga atau keempat dari keturunan Nabi Adam. Beliau terkenal karena dedikasi besar terhadap ilmu pengetahuan. Idris adalah salah satu nabi pertama yang mendapat tantangan untuk belajar dan mengembangkan berbagai keterampilan. Beliau disebut sebagai penemu menulis dan perhitungan. Dengan ilmu ini, Idris mengajarkan umatnya untuk memahami tanda-tanda Allah di alam semesta. Ketaatan dan kecerdasannya membuat Nabi Idris dianggap sebagai teladan dalam menuntut ilmu.

## Hikmah
- Ilmu adalah warisan terbesar yang bisa kita wariskan
- Belajar adalah bentuk ibadah kepada Allah
- Orang yang berilmu memiliki tanggung jawab mengajarkan kepada orang lain

## Refleksi
Sudahkah kita menganggap ilmu sebagai harta yang sangat berharga? Bagaimana cara kita memanfaatkan ilmu untuk kebaikan?
MD
            ],
            [
                'act_id' => 2,
                'title' => 'Mengajarkan Ilmu kepada Manusia',
                'content' => <<<'MD'
# Mengajarkan Ilmu kepada Manusia

## Tujuan Pembelajaran
Memahami peran pendidik dalam masyarakat dan tanggung jawab mengajarkan ilmu.

## Kisah Singkat
Tidak hanya menuntut ilmu, Nabi Idris juga aktif mengajarkan apa yang telah dipelajarinya kepada umatnya. Beliau memprakarsai pengajaran berbagai keterampilan praktis yang dapat membantu kehidupan manusia sehari-hari. Melalui pendekatannya yang lembut dan bijaksana, Nabi Idris berhasil membuka wawasan umatnya terhadap pentingnya pembelajaran berkelanjutan. Kerja keras beliau dalam bidang pendidikan membuat generasi muda tertarik untuk terus belajar dan berinovasi.

## Hikmah
- Pendidik memiliki peran penting dalam membangun peradaban
- Ilmu yang tidak dibagikan adalah ilmu yang terbuang
- Kesuksesan sejati adalah ketika orang lain bisa belajar dari kita

## Refleksi
Apakah kita sudah berusaha berbagi ilmu dengan orang lain? Siapa saja yang bisa kita bantu melalui ilmu yang kita miliki?
MD
            ],

            // Act 3: Peringatan di Tengah Kelalaian
            [
                'act_id' => 3,
                'title' => 'Dakwah Nabi Nuh yang Panjang',
                'content' => <<<'MD'
# Dakwah Nabi Nuh yang Panjang

## Tujuan Pembelajaran
Memahami pentingnya konsistensi dan kesabaran dalam menyampaikan kebenaran.

## Kisah Singkat
Nabi Nuh diutus oleh Allah untuk berdakwah kepada umatnya selama 950 tahun. Dengan penuh dedikasi, beliau menyerukan manusia untuk kembali kepada tauhid dan meninggalkan penyembahan berhala. Namun, respons umatnya sangat negatif. Mereka tidak hanya menolak, tetapi juga mengejek dan menganggap Nabi Nuh sebagai orang gila. Meskipun menghadapi tantangan yang luar biasa berat, Nabi Nuh tidak pernah berhenti berdakwah dengan lemah lembut dan penuh kasih sayang.

## Hikmah
- Kesabaran adalah kunci dalam menyebarkan kebenaran
- Tidak semua usaha kita akan mendapat sambutan positif
- Konsistensi dalam berbuat baik akan membawa hasil di kemudian hari

## Refleksi
Apakah kita cukup sabar dalam menghadapi penolakan? Bagaimana cara kita tetap konsisten melakukan kebaikan meski menghadapi hambatan?
MD
            ],
            [
                'act_id' => 3,
                'title' => 'Selamat Hanya Mereka yang Beriman',
                'content' => <<<'MD'
# Selamat Hanya Mereka yang Beriman

## Tujuan Pembelajaran
Memahami konsekuensi kesombongan dan pentingnya mendengarkan peringatan.

## Kisah Singkat
Ketika Nabi Nuh melihat umatnya tetap menolak ajaran tauhid, beliau memohon kepada Allah untuk mengazab mereka. Allah menerima doa Nabi Nuh dan memerintahkan beliau untuk membangun bahtera besar. Nabi Nuh membuat bahtera dengan tangan sendiri sebagai tanda nyata bahwa bencana akan datang. Namun, umatnya terus mengejek dan tidak percaya. Ketika air bah datang, hanya Nabi Nuh dan mereka yang beriman yang selamat melalui bahtera itu.

## Hikmah
- Kesombongan membawa manusia pada kehancuran
- Orang yang tidak mendengarkan peringatan akan menyesal terlambat
- Iman adalah satu-satunya penyelamat

## Refleksi
Apakah kita termasuk orang yang siap mendengarkan peringatan? Bagaimana kita bisa membantu orang lain agar tidak jatuh dalam kesombongan?
MD
            ],
            [
                'act_id' => 3,
                'title' => 'Generasi Baru untuk Peradaban Baru',
                'content' => <<<'MD'
# Generasi Baru untuk Peradaban Baru

## Tujuan Pembelajaran
Memahami bagaimana iman dapat dimulai dari generasi baru dan pentingnya tindakan nyata.

## Kisah Singkat
Setelah banjir besar, hanya segelintir orang yang beriman bersama Nabi Nuh yang selamat. Mereka kemudian memulai peradaban baru di bumi. Dari keturunan mereka, lahir generasi-generasi yang meneruskan tauhid kepada Allah. Peradaban baru ini dibangun atas dasar yang kuat: keimanan kepada Allah dan kepercayaan pada petunjuk para nabi. Kisah ini menunjukkan bahwa meskipun mayoritas menolak, sisa orang-orang yang beriman cukup untuk membangun masa depan yang lebih baik.

## Hikmah
- Kualitas lebih penting daripada kuantitas dalam hal keimanan
- Generasi muda adalah harapan untuk masa depan yang lebih baik
- Tindakan nyata lebih penting daripada hanya berbicara

## Refleksi
Bagaimana cara kita menjadi bagian dari generasi yang membangun peradaban berdasarkan keimanan? Siapa saja yang bisa kita ajak untuk berbuat baik?
MD
            ],

            // Act 4: Seruan di Tanah Kaum yang Keras
            [
                'act_id' => 4,
                'title' => 'Nabi Hud dan Kaum Ad',
                'content' => <<<'MD'
# Nabi Hud dan Kaum Ad

## Tujuan Pembelajaran
Memahami bahwa kekuatan dan kekayaan bukan jaminan keberlanjutan jika tidak didasarkan pada keimanan.

## Kisah Singkat
Nabi Hud diutus kepada kaum Ad, suatu masyarakat yang terkenal karena kekuatan fisik mereka yang luar biasa. Mereka juga memiliki teknologi dan keterampilan membangun yang canggih. Kaum Ad membangun benteng-benteng tinggi dan monumen megah sebagai simbol kekuatan mereka. Namun, kesuksesan material ini membuat mereka lupa kepada Allah. Nabi Hud mengajak mereka untuk kembali bersyukur dan tidak sombong. Meski demikian, kaum Ad tetap menolak dengan sombong mengatakan bahwa mereka tidak perlu akan bantuan Allah.

## Hikmah
- Kesuksesan material dapat membuta mata terhadap kebenaran spiritual
- Kesombongan adalah akar dari semua keburukan
- Kekuatan sejati datang dari keimanan, bukan dari kekuatan fisik semata

## Refleksi
Apakah kita sudah bersyukur dengan apa yang Allah berikan? Bagaimana cara kita agar tidak sombong dengan kesuksesan?
MD
            ],
            [
                'act_id' => 4,
                'title' => 'Angin yang Menghancurkan',
                'content' => <<<'MD'
# Angin yang Menghancurkan

## Tujuan Pembelajaran
Memahami bahwa Allah memiliki kekuatan yang melampaui semua kekuatan manusia.

## Kisah Singkat
Ketika kaum Ad terus menolak dakwah Nabi Hud, Allah mengirimkan angin yang dahsyat sebagai azab kepada mereka. Angin ini bukan angin biasa, melainkan angin yang dapat menghancurkan segala hal di hadapannya. Benteng-benteng yang kokoh, monumen-monumen megah yang mereka bangun dengan kebanggaan, semua hancur berkeping-keping oleh kekuatan angin Allah. Kaum Ad yang kuat dan terkenal itu lenyap dalam sekejap mata. Hanya Nabi Hud dan mereka yang beriman yang selamat dari azab ini.

## Hikmah
- Tidak ada yang tahan menghadapi kekuatan dan kehendak Allah
- Kesombongan adalah awal dari kemusnahahan
- Tanda-tanda Allah di alam semesta membuktikan kekuasaan-Nya

## Refleksi
Apakah kita sudah cukup sadar akan kekuasaan Allah? Bagaimana perasaan kita melihat keindahan dan kekuatan alam?
MD
            ],

            // Act 5: Api Ujian Seorang Kekasih Tuhan
            [
                'act_id' => 5,
                'title' => 'Ibrahim Menentang Penyembahan Berhala',
                'content' => <<<'MD'
# Ibrahim Menentang Penyembahan Berhala

## Tujuan Pembelajaran
Memahami keberanian dalam menyuarakan kebenaran meskipun sendirian.

## Kisah Singkat
Nabi Ibrahim hidup di tengah masyarakat yang menyembah berhala-berhala. Sejak muda, beliau mulai mempertanyakan logika di balik penyembahan berhala tersebut. Ibrahim menunjukkan bahwa berhala yang mereka sembah adalah ciptaan manusia dan tidak memiliki kekuatan apa pun. Dalam sebuah dialog yang cerdas, beliau membuktikan bahwa hanya Allah yang layak disembah. Keberanian Ibrahim menghadapi seluruh komunitas yang telah terbuta oleh tradisi menunjukkan kekuatan iman yang luar biasa.

## Hikmah
- Keberanian sejati adalah berani menyuarakan kebenaran sendirian
- Logika dan akal adalah alat yang Allah berikan untuk mencari kebenaran
- Tradisi tidak selalu benar, kita perlu memikirkannya dengan kritis

## Refleksi
Apakah kita cukup berani untuk berbeda dengan kebiasaan yang salah? Bagaimana cara kita menemukan kebenaran dengan menggunakan akal yang Allah berikan?
MD
            ],
            [
                'act_id' => 5,
                'title' => 'Api Ujian di Babilonia',
                'content' => <<<'MD'
# Api Ujian di Babilonia

## Tujuan Pembelajaran
Memahami bahwa Allah akan melindungi mereka yang teguh pada keimanan.

## Kisah Singkat
Karena terus menolak untuk menyembah berhala, masyarakat Babilonia memutuskan untuk menghukum Nabi Ibrahim. Mereka mengumpulkan kayu sebanyak mungkin dan menyalakan api yang sangat besar. Kemudian mereka melemparkan Ibrahim ke dalam api tersebut. Masyarakat berkumpul untuk menyaksikan hukuman ini, percaya bahwa api akan menghabiskan Ibrahim. Namun, Allah mendengar doa Ibrahim dan memerintahkan api untuk menjadi dingin dan aman bagi beliau. Ibrahim keluar dari api tanpa cacat sedikitpun, dan ini menjadi mukjizat yang menakjubkan.

## Hikmah
- Kepercayaan kepada Allah akan melindungi kita dari segala ancaman
- Ujian adalah cara Allah menunjukkan bahwa Dia selalu bersama orang-orang beriman
- Mukjizat terjadi kepada mereka yang imannya luar biasa kuat

## Refleksi
Apakah kita percaya sepenuhnya bahwa Allah akan melindungi kita? Bagaimana cara kita menunjukkan kepercayaan itu dalam tindakan?
MD
            ],
            [
                'act_id' => 5,
                'title' => 'Khalil dan Janji Allah',
                'content' => <<<'MD'
# Khalil dan Janji Allah

## Tujuan Pembelajaran
Memahami bahwa pengorbanan besar untuk Allah akan selalu dibalas dengan kebaikan.

## Kisah Singkat
Setelah banyak ujian, Nabi Ibrahim mencapai kedudukan tinggi di mata Allah. Beliau dijuluki Khalil (kekasih Allah) karena kedekatannya dengan Allah. Allah kemudian memberikan janji besar kepada Ibrahim: keturunannya akan tersebar di seluruh bumi dan akan menjadi para pemimpin dan nabi. Allah juga memerintahkan Ibrahim untuk membangun Ka'bah di Mekah bersama dengan putranya Ismail. Dengan penuh ketulusan, Ibrahim dan Ismail membangun rumah ibadah ini.

## Hikmah
- Kedudukan di sisi Allah lebih berharga daripada apa pun di dunia
- Janji Allah pasti akan terpenuhi pada waktunya
- Pengorbanan untuk Allah akan selalu mendapat balasan yang berlipat ganda

## Refleksi
Apa yang bisa kita korbankan untuk dekat dengan Allah? Bagaimana cara kita membangun masa depan yang baik untuk generasi mendatang?
MD
            ],

            // Act 6: Kota yang Tenggelam dalam Dosa
            [
                'act_id' => 6,
                'title' => 'Nabi Luth dan Kaum Sodom',
                'content' => <<<'MD'
# Nabi Luth dan Kaum Sodom

## Tujuan Pembelajaran
Memahami pentingnya menjaga moral dan akhlak dalam masyarakat.

## Kisah Singkat
Nabi Luth diutus untuk membimbing kaum Sodom yang telah jatuh dalam perbuatan-perbuatan yang sangat menyimpang. Kaum Sodom melakukan dosa-dosa yang sangat besar dan tidak malu-malu dengan perbuatan mereka yang terlarang. Mereka bahkan memperkuat kemungkaran dan menolak semua nasihat yang disampaikan Nabi Luth. Dengan penuh kasih sayang namun tegas, Nabi Luth terus mengajak mereka untuk kembali ke jalan yang benar. Namun, pangilan beliau hanya ditanggapi dengan ejekan dan ancaman kekerasan.

## Hikmah
- Menjaga akhlak dan moral adalah tanggung jawab setiap individu
- Kemungkaran yang dibiarkan akan merata ke seluruh masyarakat
- Peringatan dari orang yang bijaksana harus didengarkan dengan baik

## Refleksi
Apakah kita sudah menjaga moral dan akhlak kita? Bagaimana cara kita membantu orang lain untuk menghindari perbuatan yang buruk?
MD
            ],
            [
                'act_id' => 6,
                'title' => 'Azab Bagi Kaum yang Sesat',
                'content' => <<<'MD'
# Azab Bagi Kaum yang Sesat

## Tujuan Pembelajaran
Memahami konsekuensi dari penolakan berkelanjutan terhadap kebenaran.

## Kisah Singkat
Setelah bertahun-tahun berdakwah tanpa hasil, Allah memerintahkan Nabi Luth untuk pergi dan meninggalkan kaum Sodom. Hanya keluarga Luth yang percaya dan akan selamat. Allah mengirimkan azab yang mengerikan kepada kaum Sodom. Mereka ditimpa dengan batu-batu dari tanah liat yang dibuat berundak-undak, sebuah bentuk azab yang belum pernah dialami oleh manusia sebelumnya. Kota Sodom yang besar dan ramai itu musnah seketika, menjadi peringatan bagi semua generasi.

## Hikmah
- Penolakan yang terus-menerus terhadap kebenaran akan berakhir dengan kecelakaan
- Allah memberikan kesempatan yang cukup sebelum mengirim azab
- Keselamatan terletak pada kepatuhan kepada perintah Allah

## Refleksi
Apakah kita sudah memanfaatkan kesempatan yang Allah berikan? Bagaimana cara kita agar tidak termasuk dalam kelompok yang menolak kebenaran?
MD
            ],

            // Act 7: Akar Keturunan yang Diberkahi
            [
                'act_id' => 7,
                'title' => 'Ismail: Putra Kesabaran Ibrahim',
                'content' => <<<'MD'
# Ismail: Putra Kesabaran Ibrahim

## Tujuan Pembelajaran
Memahami pentingnya kesabaran dalam menghadapi ujian dan percaya pada janji Allah.

## Kisah Singkat
Nabi Ibrahim telah ditunggu-tunggu untuk memiliki seorang putra sejak lama. Setelah bertahun-tahun menunggu, Allah memberikan Nabi Ismail kepada beliau sebagai putra dari Hajar. Kedatangan Ismail adalah jawaban dari doa panjang Ibrahim. Nabi Ismail tumbuh menjadi seorang pemuda yang shalih dan berbakti kepada orang tuanya. Beliau diajarkan oleh Ibrahim tentang keimanan yang kuat dan ketaatan kepada Allah. Ketika Ismail sudah cukup besar, Allah memberikan ujian besar kepada kedua ayah-anak ini.

## Hikmah
- Kesabaran dalam menunggu akan diberi hasil yang memuaskan
- Orang tua yang shalih akan mendapat anak yang shalih
- Doa yang khusyuk akan selalu didengar oleh Allah

## Refleksi
Apakah kita cukup sabar dalam menunggu janji Allah? Bagaimana cara kita mempersiapkan diri untuk tanggung jawab besar?
MD
            ],
            [
                'act_id' => 7,
                'title' => 'Ujian yang Menggetarkan Hati',
                'content' => <<<'MD'
# Ujian yang Menggetarkan Hati

## Tujuan Pembelajaran
Memahami tingkat kesetiaan kepada Allah melalui ujian-ujian yang berat sekalipun.

## Kisah Singkat
Allah menguji Ibrahim dan Ismail dengan perintah yang sangat berat: Ibrahim diperintahkan untuk mengorbankan putranya yang sangat dicintai. Ini adalah ujian tertinggi dari kesetiaan Ibrahim kepada Allah. Tanpa ragu, Ibrahim menyampaikan perintah ini kepada Ismail dengan hati yang berat. Namun, yang mengejutkan, Ismail menerima dengan tabah dan tulus. Ismail berkata, "Wahai ayahanda, lakukanlah apa yang diperintahkan. Nanti engkau akan mendapatiku termasuk orang-orang yang sabar."

## Hikmah
- Ujian sejati adalah ketika kita harus memilih antara yang kita cintai dan perintah Allah
- Ketaatan kepada Allah adalah yang paling utama
- Kesabaran dan keikhlasan akan selalu mendapat ganjaran dari Allah

## Refleksi
Apa yang paling berharga bagi kita? Apakah kita siap mengorbankan sesuatu yang kita sayangi untuk patuh kepada Allah?
MD
            ],
            [
                'act_id' => 7,
                'title' => 'Tebusan dan Janji Terpenuhi',
                'content' => <<<'MD'
# Tebusan dan Janji Terpenuhi

## Tujuan Pembelajaran
Memahami bahwa Allah tidak akan membiarkan orang-orang shalih dalam kesengsaraan yang sebenarnya.

## Kisah Singkat
Ketika Ibrahim siap untuk melaksanakan perintah Allah, Allah berhenti beliau dan memberikan seekor domba besar sebagai tebusan untuk Ismail. Ibrahim dan Ismail telah lulus ujian tertinggi dengan sempurna. Kesetiaan mereka kepada Allah terbukti nyata. Allah kemudian memberkati mereka berdua dengan doa dan janji yang agung. Dari keturunan Ismail akan lahir banyak nabi dan pemimpin yang akan memandu umat manusia. Ismail juga menjadi salah satu pendiri Ka'bah di Mekah bersama ayahnya.

## Hikmah
- Allah tidak akan membiarkan orang-orang setia jatuh dalam kesengsaraan sejati
- Ujian adalah cara Allah meningkatkan derajat hamba-Nya
- Keturunan yang shalih adalah warisan terbesar yang bisa kita tinggalkan

## Refleksi
Bagaimana kita bisa menjadi keturunan yang shalih dan berkelanjutan dalam kebaikan? Apa usaha kita untuk menjadi teladan bagi generasi mendatang?
MD
            ],

            // Act 8: Dari Sumur ke Singgasana
            [
                'act_id' => 8,
                'title' => 'Kemudahan Sebelum Kesulitan',
                'content' => <<<'MD'
# Kemudahan Sebelum Kesulitan

## Tujuan Pembelajaran
Memahami bahwa kehidupan selalu berganti antara mudah dan sulit, senang dan sedih.

## Kisah Singkat
Nabi Yusuf adalah putra kesayangan Nabi Yaqub. Sejak kecil, Yusuf mendapatkan perhatian dan kasih sayang yang luar biasa dari ayahnya. Yusuf tumbuh menjadi seorang pemuda yang sangat tampan, berakhlak mulia, dan berbudi pekerti luhur. Saudara-saudara Yusuf mulai merasa iri terhadap perhatian ayah yang diberikan kepada Yusuf. Iri hati ini kemudian tumbuh menjadi permusuhan. Mereka merancang sebuah rencana untuk menjauhkan Yusuf dari ayahnya.

## Hikmah
- Kemudahan yang kita alami bisa berubah menjadi kesulitan kapan saja
- Iri hati adalah awal dari semua perbuatan jahat
- Kita harus bersyukur dengan apa yang kita miliki tanpa membandingkan dengan orang lain

## Refleksi
Apakah kita pernah merasa iri dengan apa yang dimiliki orang lain? Bagaimana cara kita mengatasi perasaan iri itu?
MD
            ],
            [
                'act_id' => 8,
                'title' => 'Dijual Menjadi Budak',
                'content' => <<<'MD'
# Dijual Menjadi Budak

## Tujuan Pembelajaran
Memahami bahwa ujian besar bisa datang dari orang-orang yang paling dekat.

## Kisah Singkat
Saudara-saudara Yusuf membuat rencana untuk membunuh adik mereka. Namun, salah seorang di antara mereka mengusulkan agar Yusuf dijual menjadi budak saja, bukan dibunuh. Mereka setuju dengan rencana ini. Dengan cara yang cerdik, mereka membawa Yusuf ke sumur dan melemparkannya ke dalamnya. Kemudian mereka memberitahu ayah mereka bahwa Yusuf dimakan serigala. Faktanya, beberapa pedagang melewati sumur itu dan menyelamatkan Yusuf, kemudian membawanya ke Mesir untuk dijual.

## Hikmah
- Ujian besar sering datang dari orang-orang terdekat kita
- Keselamatan bisa datang dari tempat yang tidak terduga
- Doa ayah yang tulus akan selalu menjadi perlindungan bagi anak-anaknya

## Refleksi
Bagaimana kita bisa menjaga hubungan baik dengan anggota keluarga? Apakah kita sudah selalu bersikap jujur dan adil dalam keluarga?
MD
            ],
            [
                'act_id' => 8,
                'title' => 'Kesabaran dan Keteguhan di Mesir',
                'content' => <<<'MD'
# Kesabaran dan Keteguhan di Mesir

## Tujuan Pembelajaran
Memahami bahwa kesabaran dalam menghadapi ujian akan membawa kemenangan akhir.

## Kisah Singkat
Di Mesir, Yusuf dijual kepada seorang pejabat tinggi bernama Aziz. Meskipun menjadi budak, Yusuf tetap menjaga akhlaknya dan bekerja dengan sepenuh hati. Allah memberikan keberkahan dalam segala yang dilakukan Yusuf. Perlahan-lahan, Aziz menyadari keunggulan Yusuf dan mempromosikannya hingga menjadi bendahara negara. Namun, istri Aziz jatuh cinta kepada Yusuf dan mencoba memaksanya melakukan hal yang terlarang. Yusuf menolak dengan tegas karena takut kepada Allah. Istri Aziz marah dan menuduh Yusuf, sehingga Yusuf dimasukkan penjara.

## Hikmah
- Keteguhan pada keimanan akan selalu diberi jalan keluar oleh Allah
- Kesabaran adalah harta yang paling berharga
- Berbuat baik akan selalu mendapat apresiasi, meskipun terlambat

## Refleksi
Apakah kita sudah menjaga kehormatan dan akhlak dalam situasi sulit? Bagaimana cara kita tetap berteguh pada prinsip yang benar?
MD
            ],
            [
                'act_id' => 8,
                'title' => 'Dari Penjara ke Singgasana',
                'content' => <<<'MD'
# Dari Penjara ke Singgasana

## Tujuan Pembelajaran
Memahami bahwa Allah memiliki rencana sempurna untuk setiap hamba-Nya.

## Kisah Singkat
Di penjara, Yusuf tetap menjaga akhlak dan ibadahnya. Allah memberikan Yusuf kemampuan untuk menafsirkan mimpi. Dua tawanan yang bersama Yusuf meminta penafsiran mimpi mereka, dan Yusuf memberikan interpretasi yang akurat. Salah satu dari mereka kemudian bekerja kembali untuk raja, dan ketika raja mengalami mimpi aneh, ia mengingat Yusuf. Yusuf diminta untuk menafsirkan mimpi raja tentang tujuh tahun kesuburan dan tujuh tahun kelaparan. Interpretasi Yusuf sangat akurat, dan raja sangat terkesan. Raja kemudian membebaskan Yusuf dan mengangkatnya menjadi bendahara negara atau bahkan pejabat tertinggi.

## Hikmah
- Rencana Allah lebih besar daripada rencana kita
- Kesabaran akan membawa kita ke tempat yang tidak pernah kita bayangkan sebelumnya
- Berbuat baik pada orang lain akan selalu mendapat imbalan

## Refleksi
Apakah kita sudah mempercayakan rencana hidup kita kepada Allah? Bagaimana cara kita tetap optimis meskipun berada dalam situasi yang sulit?
MD
            ],

            // Act 9: Sabar yang Tak Tergoyahkan
            [
                'act_id' => 9,
                'title' => 'Cobaan Kesehatan dan Harta',
                'content' => <<<'MD'
# Cobaan Kesehatan dan Harta

## Tujuan Pembelajaran
Memahami bahwa ujian besar bisa datang dalam bentuk kehilangan kesehatan dan harta.

## Kisah Singkat
Nabi Ayyub adalah seorang laki-laki yang sangat kaya, sehat, dan disayangi oleh masyarakat. Beliau memiliki harta yang melimpah, keluarga yang besar, dan kesehatan yang sempurna. Beliau juga terkenal karena sifat dermawannya dan bantuan kepada orang yang membutuhkan. Namun, Allah menguji Ayyub dengan ujian yang sangat berat. Perlahan-lahan, semua harta dan kesehatannya hilang. Anak-anaknya meninggal satu per satu. Ayyub tertimpa berbagai penyakit yang menyakitkan. Orang-orang yang dulunya menghormati Ayyub kini meninggalkannya.

## Hikmah
- Harta dan kesehatan adalah amanah yang bisa diambil kembali kapan saja
- Ujian adalah cara Allah menguji kesetiaan hamba-Nya
- Sabar dalam ujian adalah bentuk ibadah tertinggi

## Refleksi
Apakah kita siap menghadapi kehilangan harta atau kesehatan? Bagaimana cara kita menunjukkan kepercayaan kepada Allah dalam situasi sulit?
MD
            ],
            [
                'act_id' => 9,
                'title' => 'Doa di Tengah Kesengsaraan',
                'content' => <<<'MD'
# Doa di Tengah Kesengsaraan

## Tujuan Pembelajaran
Memahami bahwa doa tulus kepada Allah adalah cara terbaik menghadapi kesulitan.

## Kisah Singkat
Meskipun tertimpa musibah yang luar biasa berat, Nabi Ayyub tetap beribadah dan berdoa kepada Allah. Beliau tidak mengeluh atau menyalahkan Allah atas musibah yang dialami. Sebaliknya, Ayyub memohon kepada Allah untuk menyembuhkannya dengan doa yang sangat tulus dan penuh kepercayaan. Dalam doa beliau, Ayyub mengakui kelemahan dirinya dan sepenuhnya menyerahkan diri kepada kehendak Allah. "Aku telah ditimpa penyakit, dan Engkau adalah sebaik-baik penyembuh," begitu doa Ayyub yang indah.

## Hikmah
- Doa adalah hubungan langsung kita dengan Allah
- Kejujuran dalam mengakui kelemahan membuka pintu berkah
- Allah mendengar doa yang datang dari hati yang tulus

## Refleksi
Apakah doa kita selalu disertai dengan kepercayaan penuh kepada Allah? Bagaimana cara kita berdoa dengan tulus di tengah kesulitan?
MD
            ],
            [
                'act_id' => 9,
                'title' => 'Kesembuhan dan Keberkahan Berlipat Ganda',
                'content' => <<<'MD'
# Kesembuhan dan Keberkahan Berlipat Ganda

## Tujuan Pembelajaran
Memahami bahwa ujian kesabaran akan dibalas dengan keberkahan yang berlipat ganda.

## Kisah Singkat
Allah mendengarkan doa Nabi Ayyub yang tulus dan segera menyembuhkannya. Penyakit beliau hilang dalam sekejap, kesehatan kembali, dan tubuhnya menjadi lebih sehat dari sebelumnya. Allah juga mengembalikan harta beliau, bahkan lebih banyak dari yang semula. Keluarga baru diberikan kepada Ayyub untuk menggantikan yang telah meninggal. Masyarakat kembali menghormati Ayyub, dan kisah kesabaran beliau menjadi teladan bagi seluruh umat manusia sepanjang masa.

## Hikmah
- Allah akan selalu memberikan jalan keluar untuk ujian-ujian kita
- Kesabaran yang konsisten akan mendapat balasan yang berlipat ganda
- Kisah kesabaran kita bisa menjadi inspirasi bagi orang-orang sekitar

## Refleksi
Bagaimana kita bisa bersabar seperti Ayyub? Apa pengalaman sulit yang bisa kita ubah menjadi pembelajaran berharga bagi orang lain?
MD
            ],

            // Act 10: Timbangan yang Curang
            [
                'act_id' => 10,
                'title' => 'Perdagangan yang Tidak Jujur',
                'content' => <<<'MD'
# Perdagangan yang Tidak Jujur

## Tujuan Pembelajaran
Memahami pentingnya kejujuran dalam berbisnis dan perdagangan.

## Kisah Singkat
Nabi Syu'aib diutus kepada kaum Madyan, sebuah masyarakat yang terkenal dengan perdagangan mereka. Namun, kaum ini memiliki kebiasaan yang sangat tidak jujur dalam berbisnis. Mereka sengaja menggunakan timbangan yang tidak tepat untuk mengurangi jumlah barang yang dijual kepada pembeli. Mereka juga mengurangi takaran ketika membeli barang dari petani. Dengan cara ini, mereka mengumpulkan keuntungan yang tidak halal. Nabi Syu'aib datang membawa pesan bahwa kejujuran adalah fondasi bisnis yang baik.

## Hikmah
- Kejujuran adalah fondasi kepercayaan dalam bisnis
- Keuntungan yang diperoleh dengan curang tidak akan membawa berkah
- Konsumen memiliki hak untuk mendapatkan nilai yang sesuai dengan harga

## Refleksi
Apakah kita sudah jujur dalam setiap transaksi bisnis kita? Bagaimana cara kita memastikan bahwa apa yang kita jual bernilai sama dengan harganya?
MD
            ],
            [
                'act_id' => 10,
                'title' => 'Peringatan yang Diabaikan',
                'content' => <<<'MD'
# Peringatan yang Diabaikan

## Tujuan Pembelajaran
Memahami bahwa peringatan harus didengarkan sebelum terlambat.

## Kisah Singkat
Nabi Syu'aib dengan lemah lembut memperingatkan kaumnya tentang bahaya kecurangan dalam perdagangan. Beliau mengatakan bahwa Allah tidak menyukai mereka yang berkhianat dan menggunakan timbangan yang tidak adil. Beliau mengajak mereka untuk berbisnis dengan jujur dan takut kepada Allah. Namun, kaum Madyan tidak mendengarkan peringatan Nabi Syu'aib. Mereka menganggap beliau sebagai orang gila dan terus melanjutkan praktik perdagangan mereka yang tidak jujur. Mereka bahkan mengancam akan mengusir Syu'aib dari kota mereka.

## Hikmah
- Kesombongan membuat manusia tidak mendengarkan peringatan
- Kebiasaan buruk sulit dilepaskan jika tidak ada kesadaran
- Orang bijaksana harus berani bersuara meskipun ditentang

## Refleksi
Apakah kita selalu bersedia mendengarkan nasihat orang yang bijaksana? Bagaimana cara kita membedakan antara nasihat yang baik dan yang buruk?
MD
            ],
            [
                'act_id' => 10,
                'title' => 'Azab Kehancuran Duniawi',
                'content' => <<<'MD'
# Azab Kehancuran Duniawi

## Tujuan Pembelajaran
Memahami bahwa ketidakadilan akan mendapat balasan dari Allah.

## Kisah Singkat
Karena terus menolak peringatan Nabi Syu'aib, kaum Madyan ditimpa dengan azab yang mengerikan. Mereka mengalami gempa bumi yang sangat dahsyat, menghancurkan semua rumah dan bangunan mereka. Beberapa versi menyebutkan mereka juga ditimpa hujan batu. Kaum Madyan yang dulunya kaya dan berkembang sekarang musnah. Harta mereka yang dikumpulkan dengan cara tidak jujur tidak mampu menyelamatkan mereka. Nabi Syu'aib dan mereka yang beriman selamat dari azab ini, sementara kaum yang tidak jujur dihancurkan.

## Hikmah
- Ketidakadilan akan mendapat balasan dari Allah, entah kapan pun
- Harta yang haram tidak akan membawa manfaat
- Keadilan adalah kunci ke kesejahteraan yang sejati

## Refleksi
Apakah kita sudah berusaha untuk selalu berlaku adil dalam setiap situasi? Bagaimana cara kita membangun kepercayaan dengan orang-orang melalui kejujuran?
MD
            ],

            // Act 11: Tongkat yang Membelah Laut
            [
                'act_id' => 11,
                'title' => 'Perbuatan Keras Fir\'aun',
                'content' => <<<'MD'
# Perbuatan Keras Fir\'aun

## Tujuan Pembelajaran
Memahami bagaimana kesombongan membuat manusia menjadi zalim terhadap orang lain.

## Kisah Singkat
Fir\'aun adalah seorang raja di Mesir yang sangat sombong dan zalim. Beliau menganggap dirinya sebagai tuhan yang paling tinggi dan tidak ada yang melebihi kekuasaannya. Fir\'aun menindas bangsa Israel yang tinggal di Mesir dengan sangat kejam. Mereka dipaksa bekerja berat tanpa bayaran yang layak, mengalami siksaan dan perlakuan yang tidak manusiawi. Nabi Musa datang membawa pesan dari Allah agar Fir\'aun membebaskan bangsa Israel. Namun, Fir\'aun menolak dengan sombong, bahkan menambah beban penderitaan mereka.

## Hikmah
- Kesombongan adalah penyakit paling berbahaya bagi pemimpin
- Penindasan akan selalu mendapat balasan dari Allah
- Kekuasaan bukanlah alasan untuk berlaku sewenang-wenang

## Refleksi
Apakah kita pernah berlaku tidak adil kepada orang yang lebih lemah? Bagaimana cara kita menggunakan kekuatan atau posisi kita dengan adil?
MD
            ],
            [
                'act_id' => 11,
                'title' => 'Mukjizat Nabi Musa',
                'content' => <<<'MD'
# Mukjizat Nabi Musa

## Tujuan Pembelajaran
Memahami bahwa mukjizat adalah tanda kebenaran dari Allah dan bukti kekuasaan-Nya.

## Kisah Singkat
Allah memberikan Nabi Musa banyak mukjizat untuk menunjukkan kekuasaan-Nya kepada Fir\'aun. Tongkat Musa dapat berubah menjadi ular raksasa. Tangan Musa dapat bercahaya sendiri. Nabi Musa melemparkan sebagian pasir ke udara dan terjadi badai pasir yang menghancurkan. Setiap mukjizat adalah peringatan kepada Fir\'aun untuk melepaskan bangsa Israel. Namun, Fir\'aun tetap menolak karena hatinya telah dikunci oleh keangkuhan. Bahkan ketika para ahli sihir Fir\'aun menyaksikan mukjizat Musa, mereka beriman kepada Allah.

## Hikmah
- Tanda-tanda Allah di alam semesta membuktikan kebenaran pesan para nabi
- Mukjizat adalah cara Allah berbicara kepada mereka yang tidak mau mendengarkan
- Hati yang terbuka akan menerima kebenaran, hati yang tertutup akan terus menolak

## Refleksi
Apakah kita sudah melihat tanda-tanda kekuasaan Allah dalam kehidupan sehari-hari? Bagaimana cara kita membuka hati kita untuk menerima kebenaran?
MD
            ],
            [
                'act_id' => 11,
                'title' => 'Pembebasan dan Keselamatan',
                'content' => <<<'MD'
# Pembebasan dan Keselamatan

## Tujuan Pembelajaran
Memahami bahwa Allah akan selalu menyelamatkan orang-orang yang beriman dari penindasan.

## Kisah Singkat
Setelah sepuluh kali musibah menimpa Fir\'aun dan kaumnya, Fir\'aun akhirnya setuju untuk melepaskan Nabi Musa dan bangsa Israel. Musa memimpin kaumnya untuk keluar dari Mesir menuju tanah yang dijanjikan. Namun, ketika melihat mereka pergi, Fir\'aun menyesal dan memerintahkan tentaranya untuk mengejar Musa. Bangsa Israel terjebak di antara tentara Fir\'aun dan Laut Merah. Dalam situasi yang sangat sulit ini, Allah memerintahkan Musa untuk memukul laut dengan tongkatnya. Laut terbagi menjadi dua, membentuk jalan kering untuk bangsa Israel menyeberang. Ketika tentara Fir\'aun mencoba menyusul, laut menutup kembali dan mereka semua tenggelam.

## Hikmah
- Keselamatan akan datang dari tempat yang tidak terduga jika kita percaya kepada Allah
- Penindasan tidak akan pernah bertahan untuk selamanya
- Keberhasilan adalah ketika kita membantu orang yang lemah untuk bebas

## Refleksi
Bagaimana kita bisa membantu orang-orang yang tertekan dan tidak berdaya? Apakah kita sudah menggunakan kekuatan kita untuk kebaikan?
MD
            ],

            // Act 12: Raja yang Adil
            [
                'act_id' => 12,
                'title' => 'Keadilan Nabi Daud',
                'content' => <<<'MD'
# Keadilan Nabi Daud

## Tujuan Pembelajaran
Memahami bahwa keadilan adalah fondasi pemerintahan yang kuat.

## Kisah Singkat
Nabi Daud adalah seorang pemimpin yang dikenal karena keadilannya yang sempurna. Setiap keputusan yang beliau ambil selalu mempertimbangkan kepentingan kedua belah pihak dengan sama rata. Daud tidak membedakan antara kaya dan miskin, dekat dan jauh dalam memberikan perlakuan yang adil. Beliau tidak pernah berpihak kepada orang kaya atau orang yang memiliki kekuasaan. Perilaku Daud sebagai hakim yang adil membuat masyarakat mempercayai keputusan-keputusannya. Keadilan Daud menjadi simbol dari pemerintahan yang baik dan sejahtera.

## Hikmah
- Keadilan adalah hak setiap orang dan kewajiban setiap pemimpin
- Pemimpin yang adil akan dicintai dan dipercaya oleh rakyatnya
- Keadilan membawa stabilitas dan kemakmuran bagi negara

## Refleksi
Apakah kita sudah berlaku adil dalam posisi apa pun yang kita pegang? Bagaimana cara kita memastikan bahwa keputusan kita selalu adil untuk semua pihak?
MD
            ],
            [
                'act_id' => 12,
                'title' => 'Kekuatan Spiritual Daud',
                'content' => <<<'MD'
# Kekuatan Spiritual Daud

## Tujuan Pembelajaran
Memahami bahwa kekuatan sejati datang dari kedekatkan dengan Allah, bukan dari kekuatan fisik.

## Kisah Singkat
Selain dikenal sebagai pemimpin yang adil, Nabi Daud juga terkenal karena kekuatan spiritualnya yang luar biasa. Beliau menerima Kitab Zabur (Psalms) sebagai petunjuk dan rahmat dari Allah. Zabur berisi doa-doa, nasihat, dan hikmah yang indah untuk memandu umat. Daud adalah seorang musisi berbakat yang menciptakan melodi-melodi indah untuk memuji Allah. Suara Daud yang merdu saat berbakti menyentuh hati banyak orang. Beliau tidak hanya pemimpin yang kuat secara fisik dan politik, tetapi juga seorang imam yang memimpin rakyatnya dalam beribadah kepada Allah.

## Hikmah
- Kekuatan spiritual lebih berharga daripada kekuatan fisik
- Seni dan budaya dapat digunakan untuk mendekatkan diri kepada Allah
- Pemimpin yang baik harus menjadi teladan dalam ibadah

## Refleksi
Bagaimana cara kita mengembangkan kekuatan spiritual kita? Apakah kita sudah memanfaatkan bakat kita untuk mendekatkan diri kepada Allah?
MD
            ],

            // Act 13: Kerajaan yang Mendengar Angin
            [
                'act_id' => 13,
                'title' => 'Keajaiban Kerajaan Sulaiman',
                'content' => <<<'MD'
# Keajaiban Kerajaan Sulaiman

## Tujuan Pembelajaran
Memahami bahwa doa yang tulus dapat membawa berkah yang luar biasa dari Allah.

## Kisah Singkat
Nabi Sulaiman adalah seorang raja yang dipilih Allah untuk memimpin dengan kebijaksanaan yang luar biasa. Ketika Sulaiman menjadi raja, beliau memohon kepada Allah dengan doa yang penuh kerendahan hati: "Ya Tuhan, ampunilah aku dan berilah aku kerajaan yang tidak akan diberikan kepada siapa pun setelah aku. Sesungguhnya Engkau Maha Pemberi." Allah mengabulkan doa Sulaiman dan memberikan kerajaan yang belum pernah ada sebelumnya. Sulaiman diberi kemampuan untuk memahami bahasa burung dan hewan. Beliau dapat mengendalikan angin sesuai dengan perintahnya. Logam cair mengalir bagi Sulaiman sesuai kehendaknya.

## Hikmah
- Doa yang tulus dan kerendahan hati akan membawa berkah luar biasa
- Kekuasaan yang besar harus digunakan dengan bijaksana dan bertanggung jawab
- Allah memberikan apa yang kita minta jika niat kita tulus

## Refleksi
Apakah doa kita selalu disertai dengan kerendahan hati? Bagaimana cara kita menggunakan kekuatan atau kekayaan yang kita miliki untuk kebaikan?
MD
            ],
            [
                'act_id' => 13,
                'title' => 'Kepimpinan yang Penuh Kasih Sayang',
                'content' => <<<'MD'
# Kepimpinan yang Penuh Kasih Sayang

## Tujuan Pembelajaran
Memahami bahwa kepemimpinan terbaik adalah yang didasarkan pada kasih sayang kepada seluruh makhluk.

## Kisah Singkat
Meskipun memiliki kekuasaan yang luar biasa besar, Nabi Sulaiman menunjukkan kasih sayang kepada semua makhluk. Suatu ketika, Sulaiman menginspeksi pasukan burung dan menyadari bahwa Ada satu burung yang tidak hadir. Daripada marah, Sulaiman menyatakan dengan lemah lembut bahwa beliau akan menghukum burung itu jika tidak memberikan alasan yang jelas. Ketika burung itu datang dan menjelaskan bahwa beliau telah mendapat informasi tentang kaum Saba, Sulaiman menerima dengan penuh pemahaman. Kepimpinan Sulaiman mencerminkan keseimbangan sempurna antara kekuasaan dan kasih sayang.

## Hikmah
- Kepemimpinan yang baik adalah yang memperlakukan semua pihak dengan kasih sayang
- Hukuman harus diberikan dengan dasar yang adil dan penuh pertimbangan
- Pemimpin yang kuat harus juga lemah lembut terhadap mereka yang dibimbing

## Refleksi
Apakah kita sudah menunjukkan kasih sayang kepada semua orang yang berada di bawah tanggung jawab kita? Bagaimana cara kita menjadi pemimpin yang kuat namun penuh kasih sayang?
MD
            ],
            [
                'act_id' => 13,
                'title' => 'Kerendahan Hati Meskipun Berkuasa',
                'content' => <<<'MD'
# Kerendahan Hati Meskipun Berkuasa

## Tujuan Pembelajaran
Memahami bahwa kesuksesan dan kekuasaan tidak membuat manusia sombong jika imannya kuat.

## Kisah Singkat
Meskipun memiliki kerajaan yang sangat besar dan kekuasaan yang luar biasa, Nabi Sulaiman tetap rendah hati dan tidak sombong. Beliau terus bersyukur kepada Allah dan mengakui bahwa semua yang beliau miliki adalah amanah dari Allah. Ketika beliau melihat takhta Ratu Saba diangkut oleh seorang dari bangsa jin sebelum mata Sulaiman berkedip, beliau berterima kasih kepada Allah. Sulaiman tidak menganggap dirinya lebih tinggi dari orang lain. Beliau meminta doa dari masyarakat dan menjadi imam bagi mereka. Kerendahan hati Sulaiman membuat kekuasaannya menjadi berkah, bukan musibah.

## Hikmah
- Kerendahan hati adalah penjaga kekuasaan dari kehancuran
- Semakin besar kekuasaan, semakin besar tanggung jawab kepada Allah
- Kesuksesan sejati adalah ketika kita tetap rendah hati dan bersyukur

## Refleksi
Bagaimana kita bisa tetap rendah hati di tengah kesuksesan? Apakah kita selalu mengingat bahwa semua yang kita miliki adalah amanah dari Allah?
MD
            ],

            // Act 14: Suara Kebenaran di Tengah Penyimpangan
            [
                'act_id' => 14,
                'title' => 'Ilyas Melawan Penyembahan Berhala',
                'content' => <<<'MD'
# Ilyas Melawan Penyembahan Berhala

## Tujuan Pembelajaran
Memahami bahwa keberanian berbicara kebenaran adalah tanggung jawab nabi dan orang yang beriman.

## Kisah Singkat
Nabi Ilyas diutus kepada masyarakat yang telah jatuh dalam penyembahan berhala bernama Ba'al. Masyarakat telah melupakan tuntunan Allah dan sepenuhnya terpesona oleh kepercayaan lama yang sesat. Ilyas adalah seorang nabi yang sangat berani dan tegas dalam menyuarakan kebenaran. Beliau tidak takut menghadapi ribuan manusia yang telah tersesat. Dengan keberanian yang luar biasa, Ilyas memanggil masyarakat untuk kembali kepada Allah dan meninggalkan penyembahan berhala.

## Hikmah
- Keberanian adalah ciri khas nabi dan orang yang beriman
- Kebenaran harus disuarakan meskipun sendirian
- Banyaknya orang yang sesat tidak membuktikan bahwa sesat itu benar

## Refleksi
Apakah kita cukup berani untuk mengatakan kebenaran meskipun menentang mayoritas? Bagaimana cara kita berbicara kebenaran dengan cara yang bijaksana?
MD
            ],
            [
                'act_id' => 14,
                'title' => 'Ilyasa Meneruskan Dakwah',
                'content' => <<<'MD'
# Ilyasa Meneruskan Dakwah

## Tujuan Pembelajaran
Memahami pentingnya generasi penerus dalam melanjutkan misi dakwah.

## Kisah Singkat
Nabi Ilyasa adalah murid setia dari Nabi Ilyas yang kemudian menjadi penerus dakwah beliau. Setelah Ilyas diangkat ke langit oleh Allah, Ilyasa melanjutkan perjuangan mengajak masyarakat kembali kepada tauhid. Ilyasa menunjukkan beberapa mukjizat untuk membuktikan kebenaran pesannya. Beliau diberikan kemampuan untuk menyembuhkan penyakit dan menunjukkan tanda-tanda kebesaran Allah. Ilyasa tidak sombong atas kemampuan yang diberikan kepadanya, tetapi selalu menggunakan mukjizat untuk memperkuat iman masyarakat.

## Hikmah
- Setiap generasi memiliki tanggung jawab untuk meneruskan dakwah
- Murid yang baik akan menjadi pemimpin yang baik di masa depan
- Konsistensi dalam mengajarkan kebenaran akan membawa hasil walaupun butuh waktu

## Refleksi
Siapa yang bisa kita jadikan generasi penerus untuk mengajarkan kebenaran? Bagaimana cara kita mempersiapkan diri untuk menjadi pemimpin di masa depan?
MD
            ],

            // Act 15: Doa dari Dalam Kegelapan
            [
                'act_id' => 15,
                'title' => 'Yunus Meninggalkan Kaumnya',
                'content' => <<<'MD'
# Yunus Meninggalkan Kaumnya

## Tujuan Pembelajaran
Memahami bahwa ketidaksabaran dapat membawa kita pada kesalahan yang besar.

## Kisah Singkat
Nabi Yunus diutus kepada kaum Niniwe yang sangat banyak jumlahnya, kurang lebih seratus ribu orang. Yunus berdakwah kepada mereka untuk meninggalkan kemungkaran dan kembali kepada tauhid. Namun, masyarakat tidak mendengarkan dan terus melanjutkan perbuatan mereka yang sesat. Yunus mulai merasa putus asa dan tidak sabar. Beliau merasa bahwa dakwahnya tidak akan pernah berhasil. Dalam keputusasaan ini, Yunus memutuskan untuk meninggalkan kaumnya tanpa seizin Allah. Beliau pergi dan naik ke kapal yang berlayar di lautan.

## Hikmah
- Ketidaksabaran dapat membawa kita melakukan hal yang tidak bijaksana
- Keputusasaan adalah godaan setan untuk menjauhkan kita dari jalan Allah
- Setiap usaha kita untuk berbuat baik memiliki nilai di sisi Allah

## Refleksi
Apakah kita pernah merasa putus asa dengan usaha kita? Bagaimana cara kita tetap optimis meskipun belum melihat hasil?
MD
            ],
            [
                'act_id' => 15,
                'title' => 'Dalam Perut Ikan Besar',
                'content' => <<<'MD'
# Dalam Perut Ikan Besar

## Tujuan Pembelajaran
Memahami bahwa Allah memberikan kesempatan untuk taubat bahkan dalam situasi yang paling berat sekalipun.

## Kisah Singkat
Ketika Yunus mencoba melarikan diri, Allah mengirim badai yang sangat besar ke lautan tempat kapal itu berlayar. Untuk menyelamatkan kapal dan penumpang lainnya, melalui undian, Yunus dipilih untuk dibuang ke laut. Yunus jatuh ke air dan kemudian ditelan oleh seekor ikan yang sangat besar. Di dalam perut ikan, Yunus berada dalam kegelapan total yang menakutkan. Namun, alih-alih putus asa, Yunus mulai berdoa kepada Allah dengan sepenuh hati. Dalam kegelapan itu, Yunus mengakui kesalahannya dan memohon ampun kepada Allah dengan tulus.

## Hikmah
- Allah memberi kesempatan untuk taubat di setiap saat
- Kegelapan fisik dapat menerangi mata hati kita
- Doa yang tulus di saat kesulitan adalah doa yang paling didengar

## Refleksi
Apakah kita pernah mengalami "kegelapan" yang membuat kita mendekat kepada Allah? Bagaimana cara kita mengubah cobaan menjadi kesempatan untuk taubat?
MD
            ],
            [
                'act_id' => 15,
                'title' => 'Selamat dan Kaumnya Beriman',
                'content' => <<<'MD'
# Selamat dan Kaumnya Beriman

## Tujuan Pembelajaran
Memahami bahwa taubat yang tulus akan selalu diterima oleh Allah.

## Kisah Singkat
Allah mendengarkan doa Yunus yang penuh penyesalan dan kerendahan hati. Allah memerintahkan ikan untuk mengeluarkan Yunus ke tempat yang aman. Yunus keluar dari perut ikan dan sampai ke darat dengan aman. Meskipun tubuhnya lemah, semangat Yunus telah diperbaharui. Beliau kembali ke kaumnya bukan sebagai orang yang putus asa, melainkan sebagai orang yang telah belajar dari kesalahannya. Kali ini, saat Yunus berdakwah kembali, kaumnya mendengarkan dan beriman. Seluruh penduduk Niniwe yang seratus ribu orang bertaubat dan kembali kepada Allah.

## Hikmah
- Taubat yang tulus akan selalu diterima oleh Allah tanpa terkecuali
- Kesalahan kita dapat menjadi pembelajaran yang berharga
- Kesuksesan dakwah datang dalam waktu Allah, bukan waktu kita

## Refleksi
Apakah kita sudah taubat dengan sepenuh hati atas kesalahan kita? Bagaimana cara kita menerima kesalahan orang lain dengan lapang dada?
MD
            ],

            // Act 16: Cahaya di Akhir Zaman Bani Israil
            [
                'act_id' => 16,
                'title' => 'Zakariya Berdoa untuk Keturunan',
                'content' => <<<'MD'
# Zakariya Berdoa untuk Keturunan

## Tujuan Pembelajaran
Memahami bahwa doa kepada Allah tidak pernah terlambat, seberapa pun usia kita.

## Kisah Singkat
Nabi Zakariya adalah seorang imam yang sangat shalih dan dipercaya oleh masyarakat. Beliau telah berusia sangat tua, begitu juga istri beliau. Seumur hidup Zakariya tidak dikaruniai seorang anak, yang pada masa itu dianggap sebagai keaiban bagi seorang laki-laki. Namun, Zakariya tidak putus asa. Beliau terus berdoa kepada Allah dengan penuh keyakinan bahwa Allah akan mengabulkan doa beliau. Zakariya meminta kepada Allah untuk memberikan keturunan yang akan menjadi pewaris dan meneruskan misi dakwah.

## Hikmah
- Tidak ada usia untuk berdoa kepada Allah
- Kepuasan hati datang dari keturunan yang shalih, bukan dari kekayaan
- Doa yang konsisten dan tulus akan selalu mendapat respons dari Allah

## Refleksi
Apakah kita sudah berdoa untuk memiliki keturunan yang shalih? Bagaimana cara kita mempersiapkan diri untuk mendidik anak-anak dengan baik?
MD
            ],
            [
                'act_id' => 16,
                'title' => 'Yahya Lahir di Usia Senja',
                'content' => <<<'MD'
# Yahya Lahir di Usia Senja

## Tujuan Pembelajaran
Memahami bahwa mukjizat adalah respons Allah terhadap doa yang tulus dan ikhlas.

## Kisah Singkat
Allah mengabulkan doa Zakariya dengan suatu cara yang ajaib. Malaikat datang memberi kabar kepada Zakariya bahwa Allah akan memberikan seorang putra bernama Yahya. Zakariya terkejut karena usia beliau sudah sangat lanjut dan istri beliau sudah mandul. Namun, Allah mengatakan bahwa hal ini mudah bagi-Nya. Allah memberi tanda kepada Zakariya bahwa beliau tidak akan dapat berbicara selama tiga hari (kecuali dengan isyarat) sebagai tanda bahwa mukjizat ini akan terjadi. Kemudian, benar-benar Nabi Yahya dilahirkan.

## Hikmah
- Allah memiliki kekuatan untuk melakukan hal-hal yang mustahil bagi manusia
- Mukjizat adalah cara Allah membuktikan kebenaran nabi-Nya
- Tanda-tanda dari Allah selalu memiliki hikmah

## Refleksi
Apakah kita pernah menyaksikan hal-hal ajaib yang membuktikan kekuasaan Allah? Bagaimana cara kita mensyukuri hal-hal istimewa yang terjadi dalam hidup kita?
MD
            ],
            [
                'act_id' => 16,
                'title' => 'Yahya: Pemuda yang Shalih',
                'content' => <<<'MD'
# Yahya: Pemuda yang Shalih

## Tujuan Pembelajaran
Memahami pentingnya pendidikan dan teladan orang tua dalam membentuk karakter anak.

## Kisah Singkat
Nabi Yahya tumbuh menjadi seorang pemuda yang sangat shalih sejak masih muda. Beliau sangat hormat kepada orang tuanya, khususnya kepada ibunya. Yahya dikenal karena kesalihan, kejernihan pikiran, dan kasih sayangnya kepada sesama manusia. Allah memberikan Yahya berbagai keistimewaan, termasuk kehormatan yang luar biasa. Yahya menjadi pendakwah yang giat mengajak masyarakat untuk bertaubat. Meskipun masih muda, Yahya memiliki kearifan dan kedewasaan yang jauh melampaui usia beliau.

## Hikmah
- Pendidikan dari orang tua yang shalih akan menghasilkan anak yang shalih
- Kesalihan sejati terlihat dari sikap hormat kepada orang tua
- Usia muda bukan alasan untuk tidak berbuat baik

## Refleksi
Bagaimana kita menghormati orang tua kita? Apakah kita sudah menjadi teladan yang baik bagi generasi muda di sekitar kita?
MD
            ],

            // Act 17: Ruh yang Menghidupkan Hati
            [
                'act_id' => 17,
                'title' => 'Isa Membawa Kabar Kasih Sayang',
                'content' => <<<'MD'
# Isa Membawa Kabar Kasih Sayang

## Tujuan Pembelajaran
Memahami bahwa kasih sayang dan kelembutan adalah cara terbaik untuk mengajak orang kepada kebaikan.

## Kisah Singkat
Nabi Isa lahir dalam kondisi yang sangat istimewa, tanpa seorang ayah. Beliau dibesarkan oleh ibu beliau yang shalih, Maryam. Sejak kecil, Isa sudah menunjukkan kebijaksanaan yang luar biasa. Ketika dewasa, Isa diutus oleh Allah untuk membawa pesan kasih sayang dan kebaikan kepada umatnya. Dakwah Isa penuh dengan kelembutan, belas kasihan, dan pengertian terhadap kemanusiaan. Beliau sering menghabiskan waktu untuk membantu orang yang sakit, miskin, dan tertekan.

## Hikmah
- Kasih sayang adalah bahasa universal yang semua orang mengerti
- Kelembutan lebih efektif daripada kekerasan dalam mengajak orang berbuat baik
- Tindakan nyata berbicara lebih keras daripada hanya kata-kata

## Refleksi
Bagaimana cara kita menunjukkan kasih sayang kepada orang-orang di sekitar kita? Apakah kita sudah cukup lembut dalam berbicara dan bertindak?
MD
            ],
            [
                'act_id' => 17,
                'title' => 'Mukjizat-mukjizat Isa',
                'content' => <<<'MD'
# Mukjizat-mukjizat Isa

## Tujuan Pembelajaran
Memahami bahwa mukjizat adalah tanda bahwa Allah berada di pihak nabi-Nya.

## Kisah Singkat
Allah memberikan Nabi Isa berbagai mukjizat yang luar biasa untuk menunjukkan kekuasaan-Nya. Isa dapat menyembuhkan penyakit yang tidak dapat disembuhkan oleh dokter zaman itu. Beliau dapat membuat orang buta sejak lahir menjadi dapat melihat. Beliau dapat menghidupkan orang yang sudah mati dengan izin Allah. Dengan mukjizat-mukjizat ini, Isa menunjukkan bahwa Allah memiliki kekuatan tertinggi dan bahwa pesan beliau adalah benar. Setiap mukjizat adalah bukti cinta Allah kepada manusia.

## Hikmah
- Mukjizat menunjukkan bahwa Allah tidak pernah meninggalkan umat-Nya
- Penyembuhan adalah bentuk kasih sayang Allah
- Keajaiban dapat terjadi ketika kita beriman kepada Allah

## Refleksi
Apakah kita percaya bahwa Allah dapat melakukan hal-hal yang mustahil? Bagaimana cara kita memperkuat iman kita dalam hal-hal yang tidak bisa dijelaskan oleh logika?
MD
            ],
            [
                'act_id' => 17,
                'title' => 'Pengajaran tentang Akhlak Mulia',
                'content' => <<<'MD'
# Pengajaran tentang Akhlak Mulia

## Tujuan Pembelajaran
Memahami bahwa akhlak mulia adalah inti dari pesan semua nabi.

## Kisah Singkat
Nabi Isa sangat menekankan pentingnya akhlak mulia dalam kehidupan beriman. Beliau mengajarkan umatnya untuk berbuat baik kepada sesama, bahkan kepada orang yang memusuhi mereka. Isa mengajarkan untuk memaafkan, menunjukkan belas kasihan, dan berbuat adil dalam semua situasi. Beliau mengatakan bahwa keagamaan yang sejati tidak hanya terletak pada ritual, tetapi pada bagaimana kita memperlakukan orang lain. Pesan Isa tentang cinta dan pengampunan menyentuh hati banyak pengikut beliau.

## Hikmah
- Akhlak mulia adalah bukti keimanan yang sejati
- Cinta dan pengampunan adalah kekuatan yang lebih besar daripada kebencian
- Berbuat baik kepada semua orang adalah perintah Allah

## Refleksi
Apakah akhlak kita sudah mencerminkan nilai-nilai kebaikan? Bagaimana cara kita meningkatkan akhlak kita setiap hari?
MD
            ],

            // Act 18: Cahaya untuk Seluruh Alam
            [
                'act_id' => 18,
                'title' => 'Nabi Muhammad ﷺ: Hamba yang Dipilih',
                'content' => <<<'MD'
# Nabi Muhammad ﷺ: Hamba yang Dipilih

## Tujuan Pembelajaran
Memahami bahwa Nabi Muhammad adalah penutup para nabi dan rahmat bagi seluruh alam.

## Kisah Singkat
Nabi Muhammad ﷺ dilahirkan di Mekkah pada masa yang penuh dengan kebodohan dan kesesatan. Masyarakat Arab saat itu menyembah berhala dan melakukan berbagai kemungkaran. Sejak kecil, Muhammad menunjukkan sifat-sifat mulia yang membedakan beliau dari orang lain. Beliau dikenal sebagai "al-Amin" (yang terpercaya) karena sifat jujur dan dapat diandalkan beliau. Ketika berusia 40 tahun, Allah menurunkan wahyu pertama kepada Muhammad melalui Malaikat Jibril, menandai dimulainya misi kenabian beliau.

## Hikmah
- Allah memilih hamba-Nya berdasarkan kesucian dan sifat mulia
- Kejujuran dan kepercayaan adalah fondasi dari kepemimpinan
- Setiap nabi diberi tugas sesuai dengan kondisi zamannya

## Refleksi
Apakah kita sudah berusaha meniru sifat-sifat mulia Nabi Muhammad? Bagaimana cara kita menjadi pribadi yang terpercaya dan jujur?
MD
            ],
            [
                'act_id' => 18,
                'title' => 'Risalah Universal untuk Semua',
                'content' => <<<'MD'
# Risalah Universal untuk Semua

## Tujuan Pembelajaran
Memahami bahwa Al-Qur'an adalah petunjuk bagi seluruh manusia di semua zaman.

## Kisah Singkat
Nabi Muhammad ﷺ membawa Al-Qur'an, sebuah kitab yang diturunkan Allah untuk membimbing seluruh manusia. Al-Qur'an bukan hanya untuk orang Arab, tetapi untuk semua bangsa dan semua generasi hingga akhir zaman. Isi Al-Qur'an mencakup segala hal yang dibutuhkan manusia: petunjuk spiritual, hukum-hukum kehidupan, kisah-kisah para nabi terdahulu, dan solusi untuk semua permasalahan umat manusia. Dengan risalah ini, Muhammad mengubah masyarakat yang jauh dari kebaikan menjadi masyarakat yang tertib dan beradab.

## Hikmah
- Al-Qur'an adalah mukjizat abadi yang terus relevan untuk semua generasi
- Kebijaksanaan dalam Al-Qur'an melampaui batas waktu dan tempat
- Mempelajari Al-Qur'an adalah investasi terbaik untuk masa depan

## Refleksi
Berapa banyak waktu yang kita habiskan untuk mempelajari Al-Qur'an? Bagaimana cara kita mengamalkan isinya dalam kehidupan sehari-hari?
MD
            ],
            [
                'act_id' => 18,
                'title' => 'Akhlak Mulia Nabi Muhammad ﷺ',
                'content' => <<<'MD'
# Akhlak Mulia Nabi Muhammad ﷺ

## Tujuan Pembelajaran
Memahami bahwa akhlak mulia Muhammad adalah suri teladan bagi seluruh umat.

## Kisah Singkat
Istri Nabi Muhammad, Aisha, mengatakan bahwa akhlak beliau adalah Al-Qur'an. Ini menunjukkan bahwa Nabi Muhammad ﷺ adalah personifikasi sempurna dari nilai-nilai yang diajarkan oleh Al-Qur'an. Beliau sangat penyayang terhadap keluarga, sahabat, dan bahkan musuh-musuhnya. Muhammad mengajarkan keadilan, kejujuran, dan belas kasihan dalam setiap aspek kehidupan. Beliau tidak pernah merasa angkuh meskipun memiliki kedudukan sebagai nabi. Beliau sering membantu istri-istrinya dengan pekerjaan rumah tangga dan memperlakukan budak dengan penuh kasih sayang.

## Hikmah
- Akhlak mulia adalah inti dari menjadi Muslim
- Keteladanan lebih penting daripada nasihat
- Berbudi pekerti luhur adalah cara kita menunjukkan cinta kepada Allah

## Refleksi
Apakah kita sudah berusaha meniru akhlak Nabi Muhammad dalam kehidupan sehari-hari? Bagaimana cara kita menjadi teladan bagi orang lain melalui perilaku kita?
MD
            ],
            [
                'act_id' => 18,
                'title' => 'Penutup Para Nabi dan Rahmat Alam Semesta',
                'content' => <<<'MD'
# Penutup Para Nabi dan Rahmat Alam Semesta

## Tujuan Pembelajaran
Memahami tanggung jawab kita sebagai umat Nabi Muhammad terakhir untuk meneruskan risalahnya.

## Kisah Singkat
Nabi Muhammad ﷺ adalah penutup para nabi dan rasul. Tidak akan ada nabi setelah beliau. Dengan tugas ini datang tanggung jawab yang besar. Umat Muhammad diberi kehormatan untuk menjadi umat yang menuntun manusia lainnya kepada jalan yang benar. Allah memanggil umat Muhammad sebagai "خير أمة" (sebaik-baik umat) karena potensi mereka untuk berbuat baik. Meskipun Nabi Muhammad telah wafat, warisan dan ajarannya tetap hidup melalui umat beliau. Risalah beliau terus menyebar hingga ke seluruh penjuru dunia.

## Hikmah
- Menjadi umat Nabi Muhammad adalah kehormatan dan tanggung jawab
- Kita adalah perpanjangan dari misi dakwah Nabi Muhammad
- Masa depan Islam bergantung pada bagaimana kita menjalankan ajaran-ajarannya

## Refleksi
Apakah kita sudah menyadari tanggung jawab kita sebagai umat Nabi Muhammad? Bagaimana cara kita meneruskan misi beliau di zaman modern ini?
MD
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}