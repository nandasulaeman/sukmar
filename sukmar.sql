-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 11:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sukmar`
--

-- --------------------------------------------------------

--
-- Table structure for table `floor_plan`
--

CREATE TABLE `floor_plan` (
  `id` int(11) NOT NULL,
  `name_floor` varchar(200) DEFAULT NULL,
  `id_market` int(11) DEFAULT NULL,
  `picture_floor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `floor_plan`
--

INSERT INTO `floor_plan` (`id`, `name_floor`, `id_market`, `picture_floor`) VALUES
(1, 'Lantai Dasar', 1, 'lantai_dasar.jpg'),
(2, 'Lantai1', 1, 'lantai1.jpg'),
(3, 'Lantai2', 1, 'lantai2.jpg'),
(4, 'Lantai3', 1, 'lantai3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `floor_product`
--

CREATE TABLE `floor_product` (
  `id` int(11) NOT NULL,
  `id_floor_plan` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `floor_product`
--

INSERT INTO `floor_product` (`id`, `id_floor_plan`, `id_product`) VALUES
(15, 1, 1),
(17, 1, 7),
(18, 1, 8),
(19, 1, 9),
(20, 1, 10),
(21, 1, 11),
(22, 1, 12),
(23, 1, 13),
(24, 1, 14),
(25, 1, 15),
(26, 1, 16),
(27, 1, 17),
(28, 1, 18),
(29, 1, 19),
(30, 1, 20),
(31, 1, 21),
(32, 1, 22),
(33, 1, 23),
(34, 1, 24),
(35, 1, 25),
(36, 1, 26),
(37, 1, 27),
(38, 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `name_market` varchar(255) NOT NULL,
  `description_market` text DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `picture_market` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `name_market`, `description_market`, `address`, `longitude`, `latitude`, `picture_market`) VALUES
(1, 'Pasar Seni Sukawati', 'Pasar Seni Sukawati adalah pasar yang menjual berbagai kerajinan seni khas Bali, seperti sandal manik-manik, pakaian, tas, lukisan, dan patung kayu. Pasar ini terletak di Jalan Raya Sukawati, Kecamatan Sukawati, Kabupaten Gianyar, Bali. Berikut adalah deskripsi lengkap dan detail dari pasar seni Sukawati terbaru:\r\n\r\n- Pasar Seni Sukawati terdiri dari tiga bagian bangunan, yaitu blok A, B, dan C. Blok A memiliki 779 los pedagang, Blok B memiliki 31 kios, dan Blok C memiliki 525 los dan 64 kios.\r\n- Pasar Seni Sukawati telah direvitalisasi sejak tahun 2020 hingga tahun 2022 dengan anggaran sebesar Rp 161 miliar. Pembangunan pasar ini telah diresmikan oleh Presiden Joko Widodo pada Rabu, 1 Februari 2023.\r\n- Pasar Seni Sukawati memiliki desain arsitektur yang kental dengan nuansa Bali. Untuk memasuki pasar, pengunjung harus menaiki tangga yang lebar dan disambut dengan gapura dengan ukiran Bali.\r\n- Pasar Seni Sukawati buka setiap hari dari pukul 08.00 hingga 17.00 WITA. Pasar ini tidak dikenakan tiket masuk, hanya perlu membayar uang parkir sebesar Rp 10.000 untuk mobil dan Rp 5.000 untuk motor.\r\n- Pasar Seni Sukawati menawarkan berbagai macam produk seni dan kerajinan khas Bali dengan kualitas yang bagus dan harga yang terjangkau. Pengunjung bisa menemukan T-shirt, dompet, pakaian batik, lukisan, patung kayu, dan lain-lain. Pasar ini juga menyediakan makanan halal untuk wisatawan muslim.\r\n\r\nPasar Seni Sukawati adalah tempat yang cocok untuk berbelanja oleh-oleh dan menikmati kebudayaan Bali. Pasar ini juga menjadi salah satu tempat favorit wisatawan, baik lokal maupun mancanegara.', 'Jalan Raya Sukawati, Sukawati, Kec. Sukawati, Kabupaten Gianyar, Bali 80582', '115.28260315579593', '-8.59651258654951', '1704967128_8fad1e3977743a7c65af.jpeg,1704967128_dbe9c99f2c40a3e2b800.jpg,1704967128_d6057bf52ee820460787.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `description_product` text DEFAULT NULL,
  `picture_product` varchar(255) DEFAULT NULL,
  `category` varchar(200) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name_product`, `description_product`, `picture_product`, `category`, `status`) VALUES
(1, 'Gendang Jimbe Mainan Anak', 'Gendang Djembe atau Kendang Jimbe adalah alat musik pukul yang berasal dari Afrika, khususnya kerajaan Mali pada abad 12. Bentuknya menyerupai cawan atau piala yang terbuat dari kayu yang dipahat, dan bagian atasnya ditutup dengan kulit hewan atau bahan sintetis yang diikat dengan tali. Cara memainkannya adalah dengan memukul bagian selaput dengan jari atau telapak tangan. Suara yang dihasilkan tergantung pada teknik dan kecepatan memukul, serta bagian selaput yang dipukul. Gendang Djembe digunakan sebagai alat komunikasi antar desa, perlengkapan upacara tradisional, dan hiburan musik. \r\nGendang djembe versi bali adalah alat musik pukul yang terinspirasi dari gendang djembe Afrika, tetapi dengan sentuhan budaya dan seni Bali. Gendang djembe versi bali biasanya terbuat dari kayu mahoni, jati, atau suar, dan ditutup dengan kulit kambing atau sapi. Gendang djembe versi bali juga memiliki ukiran dan lukisan yang khas, seperti motif bunga, daun, atau wayang. Gendang djembe versi bali digunakan sebagai alat musik belajar anak-anak untuk acara tradisional, hiburan, atau terapi.', '1704968691_733bc93853ae98d35ad2.jpg,1704968691_dfdc3360484a1f2823ee.png', 'Kayu,Kulit Sapi,Alat Musik', 1),
(7, 'Alat Musik Tradisional Karimba', 'Karimba dari batok kelapa atau sering juga disebut Mbira adalah instrumen musik tradisional yang berasal dari berbagai suku di Afrika, terutama di wilayah Selatan dan Tengah. Namun, perlu dicatat bahwa karimba dari batok kelapa lebih umum terkait dengan suku-suku di Zimbabwe. Berikut adalah deskripsi lengkap Karimba dari batok kelapa:\r\n\r\nBahan dan Konstruksi:\r\n\r\nBatok Kelapa:\r\n\r\nBatok kelapa digunakan sebagai dasar atau resonator karimba. Ini memberikan karakter suara yang khas dan membedakan instrumen ini dari jenis karimba lain yang mungkin menggunakan bahan resonator yang berbeda.\r\nBatok kelapa diukir dan dibentuk dengan teliti untuk menciptakan rongga resonansi yang tepat.\r\nTines atau Lamellae:\r\n\r\nTines atau lamellae adalah lembaran logam yang terpasang di atas batok kelapa. Mereka biasanya terbuat dari logam seperti baja atau alumunium.\r\nTines ini diatur sedemikian rupa sehingga setiap tine menghasilkan nada yang berbeda ketika dipukul atau dipetik.\r\nHiasan dan Dekorasi:\r\n\r\nBeberapa karimba dapat dihias dengan ukiran atau catan artistik pada batok kelapa, menambah elemen seni dan estetika pada instrumen.\r\nHiasan ini sering kali mencerminkan simbol-simbol atau desain tradisional dari budaya setempat.\r\nCara Memainkan:\r\n\r\nTeknik Pemainan:\r\n\r\nKarimba dimainkan dengan memetik atau memukul tines menggunakan jari atau batang pemukul khusus.\r\nSetiap tine memiliki tinggi nada yang berbeda, memungkinkan pemain untuk menciptakan melodi dan harmoni.\r\nPostur dan Posisi:\r\n\r\nPemain karimba biasanya memegang instrumen dengan kedua tangan dan menempatkannya di atas pangkuan atau meja.\r\nPemain dapat menggunakan jari atau pemukul untuk menciptakan variasi suara.\r\nFungsi dalam Budaya:\r\n\r\nUpacara Adat dan Ritual:\r\n\r\nKarimba sering kali digunakan dalam berbagai upacara adat, ritual, dan perayaan budaya di berbagai suku di Afrika Selatan.\r\nMusik Rakyat:\r\n\r\nInstrumen ini sering dimainkan dalam konteks musik rakyat, menciptakan suara yang khas dari budaya tertentu.\r\nWarisan dan Identitas:\r\n\r\nKarimba mencerminkan warisan musik dan identitas budaya suku-suku yang menggunakannya, dan dapat dianggap sebagai lambang tradisi dan ketahanan budaya.\r\nKarimba dari batok kelapa adalah instrumen yang memukau, tidak hanya dari segi suara yang dihasilkan tetapi juga dari segi keindahan dan kekayaan budaya yang terkandung di dalamnya.', '1704969472_e70b2684a7498a07dd41.jpg,1704969472_dff21682665c724e2ece.jpg', 'Alat Musik,Batok-kelapa', 1),
(8, 'Gelas Anggur / Gelas Wine Kayu Jati / Wooden Wine Glass', 'Gelas wine kayu adalah produk unik yang menggabungkan kehangatan dan keindahan alam kayu dengan fungsi praktis sebagai wadah untuk menikmati minuman anggur. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nGelas wine ini terbuat dari kayu berkualitas tinggi, seperti kayu jati atau kayu keras lainnya.\r\nMungkin dilapisi atau diberi perlindungan khusus untuk menjaga daya tahan dan meningkatkan keindahan kayu.\r\nDesain dan Tampilan:\r\n\r\nMenampilkan desain yang elegan dan estetis yang memanfaatkan keindahan serat dan warna alami kayu.\r\nMungkin memiliki bentuk yang mengikuti desain gelas anggur tradisional atau memiliki elemen desain yang lebih kreatif.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran yang sesuai dengan jenis dan porsi anggur yang ingin dinikmati.\r\nBentuknya dapat bervariasi, mulai dari yang klasik hingga yang modern, tergantung pada desain dan tren terkini.\r\nFungsionalitas:\r\n\r\nDidesain untuk menampung dan menyajikan anggur dengan cara yang elegan dan unik.\r\nMungkin memiliki kaki yang kokoh untuk meningkatkan stabilitas dan memudahkan pemegangan.\r\nKeindahan dan Estetika:\r\n\r\nGelas wine kayu menambahkan sentuhan alam ke pengalaman menikmati anggur, menciptakan atmosfer yang hangat dan santai.\r\nWarna dan serat kayu memberikan tampilan yang alami dan memikat.\r\nTata Letak dan Penataan:\r\n\r\nCocok untuk digunakan pada acara khusus, pesta, atau sebagai hiasan meja untuk menunjukkan keanggunan dan keunikan.\r\nDapat ditempatkan di atas meja makan, bar, atau ruang santai untuk menambahkan sentuhan eksklusif.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana, biasanya membersihkan dengan lembut menggunakan kain lembut atau sikat halus.\r\nPerlindungan tambahan mungkin diperlukan untuk mempertahankan keindahan kayu seiring waktu.\r\nKualitas Material:\r\n\r\nGelas wine ini dirancang untuk memberikan daya tahan dan keindahan jangka panjang.\r\nKualitas konstruksi dan pemilihan kayu yang tepat menjamin produk yang tahan lama.', '1704982424_296add4b44ce0aa60f12.jpg,1704982424_d1d37977bdb9100dec3d.jpg', 'Kayu,Peralatan Makan Minum', 1),
(9, 'Hiasan Meja atau Buffet Toples/Keler Motif Warna-Warni', 'Hiasan meja atau buffet toples motif warna-warni dari bahan kayu adalah pilihan yang memadukan kehangatan alami kayu dengan keceriaan motif dan warna. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari kayu berkualitas tinggi, seperti kayu jati, mahoni, atau kayu keras lokal lainnya.\r\nMungkin memiliki penyelesaian atau pelapis khusus untuk melindungi kayu dari kerusakan dan memberikan kilau yang indah.\r\nMotif dan Warna:\r\n\r\nMenampilkan motif warna-warni yang menyatu dengan keindahan alami serat kayu.\r\nMotif dapat berupa ukiran tangan, pewarnaan, atau kombinasi berbagai warna yang cerah dan menarik.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran dan bentuk yang kreatif, sesuai dengan fungsi dan keindahan dekoratifnya.\r\nBentuknya bisa beragam, mulai dari yang sederhana dan elegan hingga bentuk yang lebih artistik dan unik.\r\nFungsionalitas:\r\n\r\nDapat digunakan untuk menyimpan berbagai barang, seperti camilan, kue, atau aksesori dekoratif.\r\nCocok ditempatkan di atas meja makan, bufet, atau sebagai pusat perhatian di ruangan.\r\nTata Letak dan Penataan:\r\n\r\nDitempatkan sebagai poin fokus di tengah meja makan atau di sudut ruangan untuk menciptakan tampilan yang menarik.\r\nDapat dikelompokkan dengan elemen dekoratif lainnya, seperti lilin, vas bunga, atau piring hiasan.\r\nKeindahan dan Estetika:\r\n\r\nMenambahkan kehangatan alami kayu pada ruangan, sementara motif warna-warni memberikan elemen ceria dan kegembiraan.\r\nKombinasi antara keindahan alam kayu dan warna yang hidup menciptakan estetika yang menarik.\r\nPerawatan:\r\n\r\nPerawatannya relatif mudah, dengan membersihkannya menggunakan kain lembut atau sikat halus.\r\nMungkin memerlukan lapisan pelindung tambahan dari waktu ke waktu untuk mempertahankan keindahan dan kekuatan kayu.\r\nKualitas Material:\r\n\r\nProduk ini dirancang untuk memberikan daya tahan dan keindahan jangka panjang.\r\nKonstruksi yang kokoh dan pemilihan kayu berkualitas tinggi menjamin produk yang tahan lama.', '1705289269_8362e160c522188eede0.png,1705289269_3d8055480c339cc4d6db.png,1705289269_0524ac999db972965e5f.png', 'Kayu', 1),
(10, 'Soap Dispenser', '\r\nSoap dispenser dari kayu adalah produk fungsional dengan desain estetis yang menarik, menggabungkan kegunaan dan keindahan alami kayu. Berikut adalah deskripsi lengkap untuk soap dispenser dari kayu:\r\n\r\nBahan:\r\nSoap dispenser ini dibuat dari kayu berkualitas tinggi, seringkali menggunakan kayu keras seperti jati atau akasia. Pilihan kayu yang baik memberikan daya tahan dan ketahanan terhadap kelembaban.\r\n\r\nDesain dan Tampilan:\r\n\r\nDesain soap dispenser menonjolkan keindahan alami kayu, mungkin dengan pola serat yang menarik atau tekstur unik.\r\nTersedia dalam berbagai bentuk dan gaya, dari yang minimalis hingga yang lebih dihiasi, memungkinkan cocok dengan berbagai dekorasi ruangan.\r\nKapasitas dan Fungsionalitas:\r\n\r\nSoap dispenser dapat memiliki kapasitas yang bervariasi, disesuaikan dengan kebutuhan pengguna.\r\nSistem pompa atau dispenser dapat dirancang untuk memberikan jumlah sabun yang tepat dan mudah diakses.\r\nPenggunaan:\r\n\r\nCocok untuk digunakan di kamar mandi atau dapur, soap dispenser dari kayu menambah sentuhan alami dan hangat dalam lingkungan ruangan.\r\nDapat diisi dengan berbagai jenis sabun cair, termasuk sabun tangan, sabun pembersih, atau lotion.\r\nKualitas dan Daya Tahan:\r\n\r\nDibuat dengan kualitas tinggi, soap dispenser ini dirancang untuk tahan lama dan dapat digunakan dalam jangka waktu yang lama.\r\nPenanganan kayu dengan lapisan perlindungan atau pelapis khusus dapat memberikan ketahanan terhadap kelembaban dan memperpanjang masa pakai produk.\r\nPerawatan:\r\n\r\nUntuk menjaga penampilan terbaik, disarankan membersihkan dengan lembut menggunakan kain lembut dan menghindari penggunaan bahan pembersih yang agresif.\r\nSoap dispenser dari kayu juga bisa dihindari dari paparan air yang berlebihan untuk memastikan keawetan dan keindahannya.', '1705289599_c6c2cb0249e6541eb5b0.jpg,1705289599_3a1e815f0ac7c4cf7ec5.jpg,1705289599_6a329b8f5acfe7478cf1.jpg', 'Kayu', 1),
(11, 'Tas Bulat Rotan Bali Lombok Anyaman Tali Slempang', 'Tas bulat rotan Bali dengan motif di tengahnya menambahkan sentuhan kreatif dan artistik pada desain yang sudah indah. Berikut adalah deskripsi lengkap untuk tas bulat rotan dengan motif di tengahnya:\r\n\r\nBahan:\r\n\r\nTas ini terbuat dari rotan berkualitas tinggi yang memberikan daya tahan dan keindahan alami.\r\nMotif di tengah mungkin menggunakan bahan tambahan, seperti anyaman tali rami atau kain etnik.\r\nDesain dan Motif:\r\n\r\nDesain anyaman pada tas ini menciptakan tampilan bulat yang menarik, sementara motif di tengah memberikan sentuhan kreatif dan unik.\r\nMotif tersebut dapat mencakup gambar etnis, geometris, flora, atau fauna, sesuai dengan tema desainnya.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, tas ini dapat disesuaikan dengan kebutuhan pengguna.\r\nBentuknya umumnya bulat atau semi-bulat, dengan penekanan pada motif di bagian tengah.\r\nFungsi:\r\n\r\nSelain sebagai tas sehari-hari, tas ini juga bisa menjadi elemen dekoratif yang memperkaya tampilan pribadi pengguna.\r\nTali slempangnya memberikan kenyamanan dan kepraktisan dalam penggunaan sehari-hari.\r\nKeindahan dan Estetika:\r\n\r\nKeindahan alam rotan dan desain anyaman yang teliti memberikan tampilan yang unik dan alami.\r\nMotif di tengah memberikan dimensi tambahan dan menonjolkan kekreatifan pengrajin.\r\nTata Letak dan Penataan:\r\n\r\nTas ini dapat digunakan untuk berbagai kesempatan, baik acara santai maupun formal.\r\nMotif di tengah dapat menjadi fokus perhatian, sehingga cocok digunakan dengan pakaian yang lebih sederhana.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana dengan membersihkan permukaan menggunakan kain lembut atau sikat halus.\r\nHindari paparan kelembaban berlebihan agar rotan tetap tahan lama.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keterampilan dan dedikasi pengrajin lokal dalam menciptakan produk yang berkualitas.\r\nBagian motif dan anyaman yang teliti menunjukkan tingkat keahlian yang tinggi.', '1705290530_3065d89cdec638c25248.jpeg,1705290530_8451b4ce75b50e6ed466.jpg,1705290530_59c6620bb6acdc809252.jpg', 'Anyaman', 1),
(12, 'Tas Anyaman Snail Model', 'Tas bulat rotan Bali dengan bentuk seperti snail (siput) merupakan produk yang memadukan keindahan anyaman rotan dengan desain unik dan kreatif. Berikut adalah deskripsi lengkap untuk tas bulat rotan dengan bentuk seperti snail:\r\n\r\nBahan:\r\n\r\nTerbuat dari rotan berkualitas tinggi yang memberikan daya tahan dan keindahan alami.\r\nMungkin ada elemen tambahan seperti anyaman tali rami atau kain etnik untuk menambahkan sentuhan artistik.\r\nDesain dan Bentuk:\r\n\r\nDesain tas ini meniru bentuk siput, menciptakan tampilan yang unik dan menarik.\r\nKemungkinan adanya elemen tambahan seperti mata atau detail lain yang menonjolkan karakteristik siput.\r\nUkuran dan Fungsi:\r\n\r\nUkuran tas dapat bervariasi, dan sementara desainnya unik, tetap mempertahankan fungsionalitas sebagai tas yang dapat digunakan sehari-hari.\r\nDapat memiliki tali slempang atau pegangan untuk kenyamanan dan kepraktisan penggunaan.\r\nWarna dan Estetika:\r\n\r\nKeindahan alam rotan tetap terjaga, sementara desain bentuk siput menambah dimensi artistik dan ceria pada tas.\r\nWarna-warna cerah atau kombinasi warna yang menarik dapat digunakan untuk menonjolkan desain.\r\nTata Letak dan Penataan:\r\n\r\nTas ini menciptakan tampilan yang unik dan eksentrik, cocok digunakan untuk acara santai atau sebagai pernyataan fashion pada acara khusus.\r\nBentuknya yang menonjol membuatnya menjadi pusat perhatian.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana dengan membersihkan permukaan menggunakan kain lembut atau sikat halus.\r\nHindari paparan kelembaban berlebihan untuk menjaga keindahan rotan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan tetap tinggi, mencerminkan keterampilan dan dedikasi pengrajin lokal dalam menciptakan produk yang berkualitas.\r\nDetail bentuk siput yang teliti dan anyaman yang rapi menunjukkan tingkat keahlian yang tinggi.', '1705290695_3daaa60bd1966be05a5c.jpg,1705290695_93f380dc68388535fe1e.jpg,1705290695_199acb2d6d5a8230bb18.jpg', 'Anyaman,Tas', 1),
(13, 'Stubby Holder Bintang Bali', 'Stubby holder adalah suatu jenis penutup botol atau kaleng yang dirancang untuk menjaga minuman tetap dingin atau panas dengan cara mengisolasi suhu dari lingkungan sekitarnya. Stubby holder biasanya terbuat dari bahan isolasi termal, seperti neoprene atau busa, yang dapat membantu menjaga temperatur minuman Anda.\r\nBerikut adalah deskripsi lengkap yang bisa diadaptasi untuk Stubby Holder Bintang Bali:\r\n\r\nDeskripsi:\r\n\r\nBahan:\r\n\r\nStubby Holder Bintang Bali terbuat dari bahan isolasi termal berkualitas tinggi, mungkin menggunakan bahan seperti neoprene atau busa kualitas tinggi. Bahan ini membantu menjaga suhu minuman dan mencegah kondensasi di permukaan holder.\r\nDesain dan Tampilan:\r\n\r\nMungkin menampilkan logo atau desain khas Bintang Bali, merek bir populer asal Indonesia. Desain tersebut dapat mencakup logo Bintang Bali, motif tropis, atau elemen terkait pulau Bali.\r\nUkuran dan Fungsi:\r\n\r\nDirancang sesuai dengan ukuran umum botol dan kaleng, menawarkan pas yang nyaman dan aman untuk berbagai jenis minuman.\r\nFungsi utamanya adalah menjaga suhu minuman agar tetap dingin dan memberikan kenyamanan saat digenggam.\r\nWarna dan Estetika:\r\n\r\nWarna dan desain Stubby Holder mungkin mencerminkan nuansa pulau Bali, seperti warna cerah, nuansa biru laut, atau elemen alam tropis.\r\nBranding:\r\n\r\nMungkin memiliki elemen branding Bintang Bali yang jelas, termasuk logo, nama merek, atau elemen branding lainnya yang terkait dengan produk.\r\nPemeliharaan dan Perawatan:\r\n\r\nPerawatannya sederhana; biasanya dapat dicuci atau dibersihkan dengan mudah setelah digunakan.\r\nDapat dilipat atau digulung untuk kemudahan penyimpanan dan portabilitas.\r\nKualitas Material:\r\n\r\nDibuat dari bahan yang tahan lama dan kokoh untuk memberikan isolasi termal yang optimal.', '1705290803_e511a275a9bb48f8386d.jpg,1705290803_1379ee157a46a629e50c.jpg,1705290803_6c123adfef110e8d5433.jpg', 'Kain,Stubby Holder', 1),
(14, 'Gantungan Kunci Oleh-Oleh Khas Bali', 'Gantungan kunci oleh-oleh khas Bali adalah produk souvenir yang memadukan keindahan seni Bali dengan fungsi praktis. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nGantungan kunci ini terbuat dari bahan berkualitas tinggi, seperti kayu, logam, atau bahan sintetis yang tahan lama.\r\nMotif atau ukiran pada gantungan kunci dapat menggunakan teknik tradisional Bali atau seni ukir modern.\r\nMotif dan Desain:\r\n\r\nTersedia dalam berbagai motif khas Bali, seperti ukiran relief dengan gambar tarian, Barong, rangda, atau hiasan tradisional lainnya.\r\nDesain bisa mencakup elemen-elemen seni dan budaya Bali, seperti wayang, pemandangan sawah, atau pola tradisional Bali yang khas.\r\nUkuran dan Bentuk:\r\n\r\nUkurannya bervariasi tergantung pada desain dan bentuk yang diinginkan.\r\nGantungan kunci dapat memiliki bentuk tradisional, seperti ukiran topeng Bali atau bentuk lebih abstrak yang mencerminkan seni kontemporer.\r\nFungsi:\r\n\r\nFungsi utamanya adalah sebagai gantungan kunci, namun dapat juga dijadikan aksesori dekoratif pada tas, dompet, atau kunci lainnya.\r\nBeberapa model juga dapat berfungsi sebagai pembuka botol kecil atau alat praktis lainnya.\r\nWarna dan Estetika:\r\n\r\nWarna dan estetika gantungan kunci mencerminkan palet warna alami Bali, dengan warna-warna yang cerah dan penuh kehidupan.\r\nDetail yang teliti dan kontras warna memberikan produk tampilan yang menarik.\r\nTata Letak dan Penataan:\r\n\r\nCocok untuk digunakan sebagai suvenir atau oleh-oleh khas Bali yang indah dan bermakna.\r\nDapat ditempatkan pada toko oleh-oleh, pasar tradisional, atau pusat kerajinan Bali.\r\nPerawatan:\r\n\r\nPerawatannya sederhana; gantungan kunci dapat dibersihkan dengan kain lembut atau sikat halus jika diperlukan.\r\nUntuk model kayu, sebaiknya dihindari dari paparan air berlebihan agar tetap tahan lama.\r\nKualitas Pembuatan:\r\n\r\nGantungan kunci ini dihasilkan melalui proses pembuatan yang teliti dan cermat, mencerminkan keterampilan tinggi pengrajin lokal.\r\nDetail ukiran atau desain yang halus menunjukkan tingkat keahlian yang tinggi.', '1705291157_0eff5bf7e0ee90f6c36b.jpg,1705291157_11ad8a3da26595ea6589.jpg', 'Gantungan Kunci,Kayu', 1),
(15, 'Sendok Kayu atau Wooden Spoon', 'Sendok kayu adalah produk dapur yang terbuat dari kayu, dan umumnya digunakan untuk mengaduk, menyendok, atau mengangkat makanan. Berikut adalah deskripsi lengkap sendok kayu:\r\n\r\nBahan:\r\n\r\nSendok ini terbuat dari kayu berkualitas tinggi, seringkali dari kayu keras seperti jati, akasia, atau kayu lokal yang tahan lama.\r\nPilihan kayu yang baik memberikan daya tahan dan kekuatan pada sendok.\r\nDesain dan Tampilan:\r\n\r\nDesain sendok kayu umumnya sederhana dan fungsional.\r\nTampilan kayu alami memberikan kesan hangat dan ramah, sementara bentuknya dapat bervariasi dari yang tradisional hingga yang lebih modern.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari sendok teh hingga sendok besar untuk masakan.\r\nBentuknya ergonomis untuk memudahkan penggunaan dan kenyamanan saat digunakan.\r\nFungsi:\r\n\r\nDigunakan untuk mengaduk, menyendok, atau mengangkat makanan.\r\nCocok untuk digunakan dengan berbagai jenis masakan, dari sup hingga salad.\r\nWarna dan Estetika:\r\n\r\nWarna kayu alami dan serat kayu memberikan sentuhan estetika alami.\r\nPilihan kayu tertentu mungkin memberikan warna yang lebih gelap atau lebih terang.\r\nTata Letak dan Penataan:\r\n\r\nSendok kayu dapat ditempatkan di dapur sebagai alat masak sehari-hari.\r\nJika memiliki desain atau ukiran khusus, bisa juga digunakan sebagai elemen dekoratif di dapur.\r\nPerawatan:\r\n\r\nPerawatannya mudah, biasanya hanya dengan mencucinya dengan air sabun lembut.\r\nDirekomendasikan untuk mengeringkan sendok secara menyeluruh setelah dicuci untuk mencegah kelembaban yang berlebihan.\r\nKualitas Material:\r\n\r\nKualitas kayu yang baik memberikan daya tahan terhadap keausan dan kerusakan.\r\nPermukaan kayu mungkin diolah dengan lapisan pelindung atau minyak untuk menjaga keindahan dan ketahanan terhadap kelembaban.', '1705291279_f5cd0d53e15a87b98042.jpg,1705291279_67cdcb75f92b870a00c6.jpg', 'Kayu,Peralatan Makan Minum', 1),
(16, 'Piring Kayu - Model Bulat dan Kotak', 'Piring kayu model kotak dan bulat adalah pilihan unik yang menambahkan sentuhan alam dan keindahan alami ke dalam pengalaman bersantap. Berikut adalah deskripsi lengkap untuk piring kayu model kotak dan bulat:\r\n\r\nBahan:\r\n\r\nTerbuat dari kayu berkualitas tinggi, seperti kayu jati, akasia, atau kayu keras lainnya.\r\nMungkin memiliki lapisan pelindung atau perlakuan khusus untuk menjaga keindahan dan ketahanan terhadap kelembaban.\r\nDesain dan Tampilan:\r\n\r\nPiring model kotak memiliki bentuk persegi atau persegi panjang dengan sudut-sudut yang tegas, sementara piring bulat memiliki bentuk lingkaran yang lebih tradisional.\r\nPermukaannya dapat memiliki tekstur alami kayu atau dilapisi dengan finishing halus untuk memberikan tampilan yang lebih bersih.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran untuk mengakomodasi kebutuhan makanan yang berbeda.\r\nPiring model kotak dapat memiliki ukuran sisi yang berbeda-beda tergantung pada desain dan fungsi, sementara piring bulat memiliki berbagai diameter yang umum.\r\nFungsi:\r\n\r\nDidesain untuk menyajikan berbagai jenis hidangan, mulai dari hidangan utama hingga makanan pembuka atau hidangan penutup.\r\nCocok untuk penggunaan sehari-hari atau untuk acara khusus.\r\nWarna dan Estetika:\r\n\r\nWarna kayu alami memberikan sentuhan alami yang hangat.\r\nDesain sederhana dan estetika alam kayu menciptakan tampilan yang elegan dan alami.\r\nTata Letak dan Penataan:\r\n\r\nPiring kayu model kotak dan bulat dapat ditempatkan sebagai poin fokus pada setting makan yang bergaya.\r\nCocok untuk digunakan dalam acara formal atau santai.\r\nPerawatan:\r\n\r\nPerawatannya mudah, biasanya hanya dengan mencucinya dengan air sabun lembut.\r\nDisarankan untuk menghindari kelembaban berlebihan dan menjauhkannya dari sumber panas ekstrem.\r\nKualitas Material:\r\n\r\nKualitas konstruksi dan pemilihan kayu yang baik memberikan daya tahan dan kekuatan yang diperlukan.\r\nPemilihan kayu yang tahan air atau perlakuan khusus dapat meningkatkan ketahanan terhadap cairan dan kelembaban.', '1705291498_65d434d445bf849b24dd.jpg,1705291498_be4b58487d9b09b4f1d4.jpg', 'Kayu,Peralatan Makan Minum', 1),
(17, 'Papan Pemotong atau Talenan Kayu', 'Papan pemotong atau talenan kayu adalah peralatan dapur yang digunakan untuk memotong, mengiris, atau menyiapkan berbagai bahan makanan. Berikut adalah deskripsi lengkap untuk papan pemotong atau talenan kayu:\r\n\r\nBahan:\r\n\r\nPapan pemotong umumnya terbuat dari kayu keras, seperti kayu maple, oak, walnut, atau bambu.\r\nKayu yang digunakan harus tahan lama, tidak mudah pecah, dan memiliki ketahanan terhadap goresan.\r\nDesain dan Tampilan:\r\n\r\nPapan pemotong memiliki desain datar dan permukaan yang lebar, memberikan ruang yang cukup untuk bekerja dengan berbagai bahan makanan.\r\nPermukaannya bisa saja datar atau memiliki lekukan tertentu untuk menampung cairan yang dihasilkan selama proses pemotongan.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari yang kecil untuk pemotongan sayuran hingga yang besar untuk memotong daging.\r\nBentuknya umumnya persegi panjang atau persegi, namun ada pula yang memiliki bentuk bulat atau oval.\r\nFungsi:\r\n\r\nBerfungsi sebagai alas saat memotong dan menyajikan makanan.\r\nMelindungi permukaan meja atau dapur dari goresan pisau.\r\nDapat digunakan untuk berbagai jenis bahan makanan, termasuk daging, sayuran, dan buah-buahan.\r\nWarna dan Estetika:\r\n\r\nWarna kayu alami memberikan tampilan yang hangat dan alamiah.\r\nDesain atau motif tertentu dapat ditambahkan untuk memberikan elemen estetika yang lebih, tetapi umumnya papan pemotong cenderung memiliki tampilan yang sederhana.\r\nTata Letak dan Penataan:\r\n\r\nPapan pemotong dapat ditempatkan di atas meja dapur atau di lemari penyimpanan.\r\nPapan pemotong dengan desain yang menarik juga bisa menjadi dekorasi dapur yang fungsional.\r\nPerawatan:\r\n\r\nPerawatannya sederhana; biasanya cukup dengan mencucinya dengan air dan sabun lembut.\r\nAgar tahan lama, sebaiknya dihindari dari paparan air berlebihan atau panas ekstrem.\r\nKualitas Material:\r\n\r\nKualitas kayu yang baik memberikan daya tahan dan kekuatan pada papan pemotong.\r\nBeberapa papan pemotong dilapisi dengan minyak atau bahan perlindungan lainnya untuk meningkatkan ketahanan terhadap kelembaban dan noda.', '1705291711_5b42e2d1bac8409f9e1e.jpg,1705291711_2670575fc9da487d3195.jpg', 'Kayu,Peralatan Masak', 1),
(18, 'Teko Air dari Batok Kelapa', 'Teko air dari batok kelapa adalah produk unik yang menggabungkan keindahan alam dan keahlian kerajinan tangan. Berikut adalah deskripsi lengkap untuk teko air dari batok kelapa:\r\n\r\nBahan:\r\n\r\nTerbuat dari batok kelapa yang diambil dari bagian keras dan padat di dalam kelapa.\r\nMungkin dihiasi dengan anyaman tali rami atau anyaman alam lainnya untuk memberikan sentuhan dekoratif.\r\nDesain dan Tampilan:\r\n\r\nDesain teko air dapat bervariasi dari yang sederhana hingga yang lebih rumit dengan ukiran atau pola khas.\r\nPermukaan batok kelapa memberikan tampilan alami dan bertekstur, mungkin dengan kilauan alami.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, tergantung pada kapasitas yang diinginkan.\r\nBentuknya bisa bervariasi dari yang tradisional hingga yang lebih modern atau artistik.\r\nFungsi:\r\n\r\nBerfungsi sebagai teko untuk menyajikan air atau minuman dingin.\r\nDapat digunakan sebagai elemen dekoratif pada saat yang sama.\r\nWarna dan Estetika:\r\n\r\nWarna batok kelapa secara alami bervariasi dari coklat tua hingga coklat muda.\r\nTeko air dari batok kelapa bisa memiliki dekorasi tambahan, seperti pewarnaan, ukiran, atau anyaman tali rami untuk meningkatkan estetika.\r\nTata Letak dan Penataan:\r\n\r\nCocok digunakan untuk berbagai kesempatan, mulai dari acara santai hingga acara formal.\r\nTeko air dapat ditempatkan di atas meja makan, meja kopi, atau area penyajian lainnya sebagai elemen dekoratif yang menarik.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; cukup bersihkan dengan kain lembut atau spons dan air sabun lembut.\r\nTeko air sebaiknya dihindari dari paparan air berlebihan untuk mempertahankan keindahan dan integritas batok kelapa.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin lokal dalam menciptakan produk yang berkualitas.\r\nDetail ukiran atau anyaman yang teliti menunjukkan tingkat keahlian yang tinggi.', '1705291874_5c750fbb9db677881182.jpg,1705291874_f462fd3655e96f2e9cfe.jpg', 'Batok-kelapa,Peralatan Makan Minum', 1),
(19, 'Tempat Alat Tulis Rotan - Pencil Cup Rattan ', 'Tempat alat tulis rotan atau Pencil Cup Rattan adalah produk kerajinan tangan yang terbuat dari anyaman rotan, memberikan sentuhan alami dan estetika unik untuk menyimpan alat tulis atau peralatan kantor. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari rotan berkualitas tinggi, yang merupakan bahan serat alami dan kuat.\r\nMungkin memiliki rangka dasar dari bahan lain seperti kayu untuk memberikan stabilitas.\r\nDesain dan Tampilan:\r\n\r\nDesain anyaman rotan memberikan tampilan yang natural dan bersahaja.\r\nPencil Cup Rattan bisa memiliki desain yang sederhana atau dihiasi dengan motif anyaman yang menarik.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, dapat disesuaikan dengan kebutuhan menyimpan alat tulis.\r\nBentuknya biasanya silindris, dengan tinggi yang sesuai untuk menampung pensil, pena, atau alat tulis lainnya.\r\nFungsi:\r\n\r\nBerfungsi sebagai tempat penyimpanan alat tulis atau peralatan kantor kecil.\r\nCocok ditempatkan di atas meja kerja, meja belajar, atau meja kerja untuk menjaga alat tulis tetap terorganisir.\r\nWarna dan Estetika:\r\n\r\nWarna rotan alami memberikan tampilan yang hangat dan ramah lingkungan.\r\nPencil Cup Rattan bisa juga diwarnai atau diberi lapisan pelindung untuk memberikan variasi warna dan meningkatkan keindahan.\r\nTata Letak dan Penataan:\r\n\r\nCocok digunakan di berbagai lingkungan, baik di kantor, ruang belajar, atau area kerja di rumah.\r\nPencil Cup Rattan dapat ditempatkan secara mandiri atau sebagai bagian dari satu set organisasi meja.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; cukup bersihkan dengan kain lembut atau sikat halus untuk menghilangkan debu atau kotoran.\r\nHindari paparan air berlebihan atau tempat terlalu dekat dengan sumber panas untuk menjaga keindahan dan integritas anyaman rotan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian pengrajin dalam membuat produk yang kokoh dan tahan lama.\r\nDetail anyaman yang rapi dan kuat menunjukkan tingkat keahlian yang tinggi.', '1705292069_0633be982903352dd758.png,1705292069_db1d6d76341ed6597afc.jpg,1705292069_07d834faf09f5f1261b1.jpg', 'Anyaman', 1),
(20, 'Asbak Kayu Lukis Bali', 'Asbak kayu lukis Bali adalah produk seni dan kerajinan yang memadukan keindahan seni tradisional Bali dengan fungsi sehari-hari sebagai tempat pembuangan abu rokok. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari kayu berkualitas tinggi, seperti kayu jati atau kayu keras lokal Bali.\r\nMungkin memiliki lapisan pelindung untuk menjaga keindahan dan ketahanan terhadap kelembaban.\r\nDesain dan Lukisan:\r\n\r\nDesain asbak mencerminkan seni dan budaya Bali, dengan motif tradisional atau lukisan tangan yang unik.\r\nLukisan pada asbak mungkin menggambarkan pemandangan alam Bali, tarian tradisional, atau tokoh-tokoh mitologis Bali.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari yang kecil hingga besar, tergantung pada desain dan kebutuhan pengguna.\r\nBentuknya bervariasi, bisa kotak, bulat, atau bentuk unik lainnya.\r\nFungsi:\r\n\r\nBerfungsi sebagai tempat pembuangan abu dan puntung rokok.\r\nCocok untuk digunakan di luar ruangan, teras, atau area merokok di kafe dan restoran.\r\nWarna dan Estetika:\r\n\r\nWarna kayu alami memberikan tampilan yang hangat dan alamiah.\r\nLukisan warna-warni dan dekoratif menambahkan elemen estetika yang khas Bali.\r\nTata Letak dan Penataan:\r\n\r\nCocok ditempatkan di meja kopi, meja samping, atau area merokok untuk memberikan sentuhan seni Bali.\r\nPerawatan:\r\n\r\nPerawatannya sederhana; cukup bersihkan dengan kain lembut atau sikat halus untuk menghilangkan abu dan debu.\r\nHindari paparan air berlebihan untuk menjaga keindahan dan integritas kayu.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin Bali dalam menciptakan produk yang berkualitas.\r\nLukisan dan detail dekoratif yang teliti menunjukkan tingkat keahlian tinggi.', '1705292181_2f19a6df317e5dd17c31.png,1705292181_a5874dba20e778a27be6.webp', 'Kayu', 1),
(21, 'Keranjang Buah Anyaman Rotan', 'Keranjang buah anyaman rotan adalah produk kerajinan tangan yang memadukan keindahan alam dan fungsi praktis. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari rotan, yang merupakan serat alam yang kuat dan tahan lama.\r\nMungkin memiliki rangka atau struktur dasar dari bahan lain, seperti kayu atau logam, untuk memberikan stabilitas.\r\nDesain dan Anyaman:\r\n\r\nDesain keranjang buah bisa bervariasi, mulai dari yang sederhana hingga yang lebih rumit dengan motif anyaman khas.\r\nAnyaman rotan bisa berupa anyaman terbuka atau tertutup, tergantung pada preferensi desain.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari yang kecil hingga besar, untuk menampung berbagai jenis buah.\r\nBentuknya bisa bervariasi dari yang bulat, oval, persegi, atau berbentuk lainnya.\r\nFungsi:\r\n\r\nBerfungsi sebagai wadah penyimpanan buah-buahan untuk menjaga agar tetap segar dan mudah diakses.\r\nCocok digunakan di dapur, meja makan, atau ruang makan untuk menyajikan buah-buahan secara estetis.\r\nWarna dan Estetika:\r\n\r\nWarna alami rotan memberikan tampilan yang hangat dan alami.\r\nBeberapa keranjang mungkin diwarnai atau diberi lapisan pelindung untuk memberikan variasi warna dan meningkatkan keindahan.\r\nTata Letak dan Penataan:\r\n\r\nCocok ditempatkan di meja dapur, meja makan, atau dapur ruang makan untuk menyimpan dan menata buah-buahan.\r\nKeranjang buah anyaman rotan juga bisa digunakan sebagai dekorasi meja yang indah.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; cukup bersihkan dengan kain lembut atau sikat halus untuk menghilangkan debu atau kotoran.\r\nHindari paparan air berlebihan untuk menjaga keindahan dan integritas rotan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin dalam menciptakan produk yang kokoh dan tahan lama.\r\nAnyaman rotan yang rapi dan kuat menunjukkan tingkat keahlian yang tinggi.', '1705292304_8ce9751865ea9d43c0d2.jpg,1705292304_ed8d77de3d785c83135f.jpg,1705292304_75350f20de0c19ad24fa.jpg', 'Anyaman', 1),
(22, 'Bakul Nasi Tradisional Anyaman Rotan', 'Bakul nasi tradisional anyaman rotan adalah produk kerajinan tangan yang memadukan keindahan alam dan fungsionalitas tradisional. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari rotan, serat alam yang kuat dan lentur.\r\nMungkin memiliki rangka dasar dari kayu atau anyaman rotan yang lebih halus untuk memberikan struktur dan stabilitas.\r\nDesain dan Anyaman:\r\n\r\nDesain bakul nasi mencerminkan estetika tradisional dengan motif anyaman khas.\r\nAnyaman rotan bisa bersifat terbuka atau tertutup, tergantung pada desain dan fungsi yang diinginkan.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari yang kecil untuk kebutuhan harian hingga yang besar untuk acara khusus atau perayaan.\r\nBentuknya biasanya persegi panjang atau kotak dengan tutup atau penutup yang terkait.\r\nFungsi:\r\n\r\nBerfungsi sebagai wadah penyimpanan dan penyajian nasi dalam konteks tradisional.\r\nCocok digunakan untuk acara-acara khusus, upacara adat, atau perayaan.\r\nWarna dan Estetika:\r\n\r\nWarna alami rotan memberikan tampilan yang hangat dan alami.\r\nBeberapa bakul nasi mungkin diwarnai atau dihias dengan anyaman warna-warni atau pola tradisional.\r\nTata Letak dan Penataan:\r\n\r\nCocok ditempatkan di meja makan atau meja hidangan untuk menyajikan nasi secara tradisional.\r\nBakul nasi juga bisa dijadikan elemen dekoratif dalam konteks rumah tradisional atau tema dekorasi khusus.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; cukup bersihkan dengan kain lembut atau sikat halus untuk menghilangkan debu atau kotoran.\r\nHindari paparan air berlebihan untuk menjaga keindahan dan integritas rotan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin dalam menciptakan produk yang kokoh dan tahan lama.\r\nDetail anyaman rotan yang rapi dan kuat menunjukkan tingkat keahlian yang tinggi.', '1705292746_a1d6a8c246e3877a7a61.jpg', 'Anyaman,Peralatan Makan Minum', 1),
(23, 'Ukiran Patung Budha', 'Patung Buddha yang diukir adalah karya seni yang menggambarkan rupa Siddhartha Gautama, pendiri agama Buddha, dalam berbagai sikap dan simbol-simbol khas. Berikut adalah deskripsi lengkap untuk ukiran patung Buddha:\r\n\r\nBahan:\r\n\r\nBisa terbuat dari berbagai jenis bahan, termasuk batu, kayu, perunggu, atau bahan padat lainnya.\r\nPemilihan bahan dapat mempengaruhi detail dan tekstur patung Buddha.\r\nDesain dan Posisi:\r\n\r\nDesain patung Buddha bervariasi, mencakup berbagai sikap atau posisi tubuh yang disebut mudra. Contohnya adalah mudra Dhyana (meditasi), Abhaya (ketenangan), atau Bhumisparsha (panggilan Bumi sebagai saksi).\r\nSetiap sikap dan posisi mewakili ajaran, momen penting, atau karakteristik khusus dalam kehidupan Buddha.\r\nUkuran:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari patung mini untuk keperluan pribadi hingga patung besar untuk digunakan sebagai objek pemujaan di kuil atau taman.\r\nDetail dan Tekstur:\r\n\r\nPatung Buddha yang diukir memiliki detail halus pada wajah, pakaian, dan aksesoris.\r\nTekstur dapat mencakup goresan dan ukiran halus untuk memberikan dimensi dan kehidupan pada patung.\r\nFungsi dan Simbolisme:\r\n\r\nBerfungsi sebagai objek pemujaan dan refleksi spiritual bagi penganut agama Buddha.\r\nSimbolisme patung melibatkan elemen-elemen seperti Buddha yang duduk di atas bunga teratai (simbol kesucian), mata yang terbuka atau tertutup (menggambarkan penemuan cahaya batin), dan atribut lain yang mewakili ajaran Buddha.\r\nWarna dan Finishing:\r\n\r\nBeberapa patung Buddha diukir dengan detail yang lebih dalam dan kemudian diwarnai dengan tinta atau cat yang serasi.\r\nFinishing dapat mencakup lapisan pelindung untuk melindungi patung dari cuaca atau keausan.\r\nTata Letak dan Penataan:\r\n\r\nPatung Buddha dapat ditempatkan di dalam rumah, kuil, atau taman, tergantung pada ukuran dan fungsi patung.\r\nTata letaknya harus mempertimbangkan elemen spiritual dan estetika.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; patung Buddha dapat dibersihkan dengan lembut menggunakan kain lembut atau sikat halus.\r\nPatung yang terletak di luar mungkin memerlukan perlindungan tambahan dari cuaca dan elemen lingkungan.', '1705292916_cb0818d4b70d8d2410ae.jpg,1705292916_96e98fe2274379c0fe2f.jpg', 'Batu,Kayu', 1),
(24, 'Dulang Anyaman Rotan Wadah Tempat Buah Serbaguna Fruit Basket', 'Dulang anyaman rotan sebagai wadah tempat buah adalah produk kerajinan tangan yang memadukan keindahan alam dan keberfungsian praktis. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari rotan, serat alam yang kuat dan lentur.\r\nMungkin memiliki rangka atau struktur dasar dari kayu atau logam untuk memberikan stabilitas.\r\nDesain dan Anyaman:\r\n\r\nDesain dulang anyaman rotan dapat bervariasi, mulai dari yang sederhana hingga yang rumit dengan motif anyaman yang khas.\r\nAnyaman rotan dapat bersifat terbuka atau tertutup, tergantung pada desain dan keinginan pemilik.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari yang kecil hingga besar, sesuai dengan kebutuhan penyimpanan buah.\r\nBentuknya dapat beragam, termasuk bulat, oval, persegi panjang, atau bahkan bentuk unik lainnya.\r\nFungsi:\r\n\r\nBerfungsi sebagai wadah untuk menyimpan dan menata buah-buahan.\r\nCocok ditempatkan di atas meja makan, meja kopi, atau dapur untuk memudahkan akses dan memberikan sentuhan dekoratif.\r\nWarna dan Estetika:\r\n\r\nWarna alami rotan memberikan tampilan yang hangat dan alami.\r\nBeberapa dulang anyaman mungkin diwarnai atau dihias dengan anyaman warna-warni atau pola tradisional untuk meningkatkan estetika.\r\nTata Letak dan Penataan:\r\n\r\nCocok ditempatkan di ruang makan, ruang tamu, atau dapur.\r\nDulang anyaman rotan juga dapat dijadikan elemen dekoratif yang menarik dan berfungsi di dalam rumah.\r\nPerawatan:\r\n\r\nPerawatannya sederhana; cukup bersihkan dengan kain lembut atau sikat halus untuk menghilangkan debu atau kotoran.\r\nHindari paparan air berlebihan untuk menjaga keindahan dan integritas rotan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin dalam menciptakan produk yang kokoh dan tahan lama.\r\nAnyaman rotan yang rapi dan kuat menunjukkan tingkat keahlian yang tinggi.', '1705293055_a029cb6ed69dd23f4599.jpg,1705293055_4da67b65be7608c3eaca.jpg,1705293055_7f0a8e976a068beeb578.jpg', 'Anyaman', 1),
(25, 'Tas Anyaman Bulat Rotan Polos Varian Warna', 'Tas bulat rotan Bali yang dianyam dengan tali slempang adalah produk yang memadukan keindahan tradisional Bali dengan desain modern yang fungsional. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTas ini terbuat dari rotan, yang memberikan tekstur alami dan tahan lama.\r\nTali slempangnya biasanya terbuat dari bahan kuat dan nyaman untuk dipakai, seperti anyaman rami atau tali nilon berkualitas tinggi.\r\nDesain dan Tampilan:\r\n\r\nTas bulat ini memiliki desain anyaman yang indah dengan motif Bali tradisional atau desain modern yang memikat.\r\nPermukaannya dapat dihiasi dengan sentuhan etnis, seperti ukiran atau pewarnaan yang mencerminkan kekayaan budaya Bali.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, mulai dari yang kecil hingga yang besar, sesuai dengan kebutuhan pengguna.\r\nBentuknya bulat atau setidaknya memiliki elemen bulat pada desainnya.\r\nFungsi:\r\n\r\nTas ini dapat digunakan sehari-hari atau untuk acara khusus, memberikan nuansa santai dan gaya yang unik.\r\nTali slempangnya memungkinkan tas dipakai dengan nyaman di bahu atau melintang.\r\nKeindahan dan Estetika:\r\n\r\nKeindahan alami rotan memberikan sentuhan kehangatan dan kealamian.\r\nDesain anyaman yang rumit dan tali slempang yang dikombinasikan menambahkan elemen estetika dan gaya yang khas.\r\nTata Letak dan Penataan:\r\n\r\nCocok untuk digunakan dalam berbagai kesempatan, dari acara santai hingga acara formal.\r\nDapat digunakan sebagai aksesori fesyen yang memperkaya tampilan pakaian sehari-hari.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana, cukup dengan membersihkan permukaan dengan kain lembut atau sikat halus.\r\nHarus dihindarkan dari kelembaban yang berlebihan untuk mempertahankan keindahan rotan.\r\nKualitas Pembuatan:\r\n\r\nTas ini dihasilkan melalui proses anyaman yang teliti dan cermat, mencerminkan keterampilan tinggi pengrajin lokal.\r\nKualitas bahan dan pembuatan yang baik memastikan produk yang tahan lama.', '1705293233_0fafa98c2996b971dbbb.jpg,1705293233_8e4ed283efa904a9600f.jpg,1705293233_8422bbc114ab804464d7.jpg', 'Anyaman,Tas', 1),
(26, 'Tas Slempang Wanita Anyaman Rotan', 'Tas slempang wanita anyaman rotan adalah aksesori yang unik dan stylish yang memadukan keindahan alam dan kepraktisan fungsionalitas. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari rotan atau anyaman alam lainnya.\r\nMungkin memiliki tali bahu atau tali slempang yang terbuat dari bahan yang nyaman digunakan, seperti kulit atau bahan sintetis.\r\nDesain dan Anyaman:\r\n\r\nDesain tas slempang dapat bervariasi, mulai dari yang sederhana hingga yang rumit dengan motif anyaman yang khas.\r\nAnyaman rotan dapat membentuk pola-pola yang indah, menciptakan tampilan yang unik dan alami.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, dari tas kecil untuk keperluan sehari-hari hingga tas besar untuk keperluan lebih formal.\r\nBentuknya bisa bervariasi, termasuk kotak, bulat, atau bentuk unik lainnya.\r\nFungsi:\r\n\r\nBerfungsi sebagai tas slempang yang nyaman digunakan sehari-hari.\r\nCocok untuk membawa barang-barang kecil seperti ponsel, dompet, kunci, dan barang penting lainnya.\r\nWarna dan Estetika:\r\n\r\nWarna alami rotan memberikan tampilan yang hangat dan alami.\r\nBeberapa tas slempang mungkin diwarnai atau dihiasi dengan aksen warna untuk menambah sentuhan gaya.\r\nTata Letak dan Penataan:\r\n\r\nTas slempang wanita anyaman rotan dapat dengan mudah dipadukan dengan berbagai gaya busana, baik santai maupun formal.\r\nCocok untuk digunakan dalam berbagai kesempatan, seperti jalan-jalan, bekerja, atau acara khusus.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; cukup bersihkan dengan kain lembut atau sikat halus untuk menghilangkan debu atau kotoran.\r\nHindari paparan air berlebihan untuk menjaga keindahan dan integritas anyaman rotan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin dalam menciptakan produk yang kokoh dan tahan lama.\r\nAnyaman rotan yang rapi dan kuat menunjukkan tingkat keahlian yang tinggi.', '1705294681_bfb1ccb07e464289315c.jpg,1705294681_db69ccbaf26b0e731b99.jpg,1705294681_a25a327f55da1311dad4.jpg', 'Anyaman,Tas', 1),
(27, 'Tas Ethnic Slempang Tenun Cowok Cewek', 'Tas ethnic slempang tenun adalah aksesori yang memadukan keunikan tenunan tradisional dengan desain modern, menciptakan tampilan yang etnis dan gaya. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nTerbuat dari kain tenun tradisional yang mencerminkan warisan budaya tertentu.\r\nMungkin memiliki bagian-bagian tambahan, seperti kulit, untuk memberikan struktur dan kekuatan.\r\nDesain dan Tenunan:\r\n\r\nDesain tas ethnic slempang menonjolkan corak dan motif tradisional yang khas, sering kali merefleksikan kebudayaan atau etnis tertentu.\r\nTenunan tradisional bisa memiliki detail halus dan warna-warna yang khas.\r\nUkuran dan Bentuk:\r\n\r\nTersedia dalam berbagai ukuran, dari yang kecil hingga yang besar, tergantung pada kebutuhan dan preferensi pengguna.\r\nBentuknya bisa bervariasi, termasuk model slempang, selempang kecil, atau tas gendong.\r\nFungsi:\r\n\r\nBerfungsi sebagai tas slempang yang nyaman digunakan sehari-hari.\r\nCocok untuk membawa barang-barang esensial seperti ponsel, dompet, kunci, dan barang lainnya.\r\nWarna dan Estetika:\r\n\r\nWarna-warna tenunan menciptakan tampilan yang cerah dan bersemangat.\r\nEstetika tas ini sering kali menonjolkan keindahan tenunan tradisional dan keaslian warna.\r\nTata Letak dan Penataan:\r\n\r\nTas slempang tenun ethnic dapat dipadukan dengan busana santai atau formal.\r\nCocok digunakan untuk berbagai kesempatan, baik itu jalan-jalan, pertemuan, atau acara khusus.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; bersihkan dengan kain lembut atau sikat halus untuk menghilangkan debu atau kotoran.\r\nHindari paparan air berlebihan untuk menjaga warna dan kualitas tenunan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian pengrajin dalam menciptakan produk yang kokoh dan tahan lama.\r\nDetail tenunan yang rapi dan kuat menunjukkan tingkat keahlian yang tinggi.', '1705294972_ebdc116f1a6226d4dc7a.webp,1705294972_048fbb345a5d5184bdc8.jpg', 'Kain,Tas', 1),
(28, 'Patung Garuda', 'Patung ukiran Garuda adalah karya seni yang menggambarkan sosok Garuda, makhluk mitologis dalam budaya Hindu dan Buddha yang sering dianggap sebagai burung elang raksasa atau manusia-burung dengan keindahan dan kekuatan yang luar biasa. Berikut adalah deskripsi lengkapnya:\r\n\r\nBahan:\r\n\r\nPatung bisa terbuat dari berbagai bahan, termasuk kayu, batu, perunggu, atau bahan padat lainnya.\r\nPemilihan bahan dapat mempengaruhi detail, tekstur, dan nuansa patung.\r\nDesain dan Posisi:\r\n\r\nDesain patung Garuda dapat bervariasi, mencakup berbagai sikap dan posisi tubuh yang mencerminkan karakteristik mitologisnya.\r\nGaruda sering diukir dalam pose anggun, sering kali dengan sayap terbuka lebar dan kaki mengepal atau mencengkeram.\r\nUkuran:\r\n\r\nTersedia dalam berbagai ukuran, dari patung miniatur hingga patung besar yang dapat ditempatkan di kuil atau ruang publik.\r\nUkurannya sering kali mencerminkan kepentingan keagungan dan kebesaran makhluk mitologis ini.\r\nDetail dan Tekstur:\r\n\r\nPatung Garuda memiliki detail halus pada sayap, bulu, dan wajahnya.\r\nTekstur mungkin mencakup ukiran halus atau goresan untuk memberikan dimensi dan kehidupan pada patung.\r\nFungsi dan Simbolisme:\r\n\r\nBerfungsi sebagai objek pemujaan dalam tradisi Hindu dan Buddha.\r\nSimbolisme patung Garuda melibatkan keberanian, keadilan, dan pengabdian, karena Garuda dianggap sebagai musuh alami ular naga yang melambangkan kejahatan.\r\nWarna dan Finishing:\r\n\r\nBeberapa patung Garuda diwarnai dengan warna-warna yang cerah dan berkilauan untuk menyoroti detail dan keindahannya.\r\nFinishing dapat mencakup lapisan pelindung untuk melindungi patung dari cuaca atau keausan.\r\nTata Letak dan Penataan:\r\n\r\nPatung Garuda biasanya ditempatkan di kuil, tempat ibadah, atau ruang meditasi untuk memberikan rasa sakral dan kehadiran spiritual.\r\nDalam konteks dekoratif, patung Garuda dapat dijadikan pusat perhatian di dalam atau di luar ruangan.\r\nPerawatan:\r\n\r\nPerawatan yang sederhana; patung Garuda dapat dibersihkan dengan lembut menggunakan kain lembut atau sikat halus.\r\nPatung yang terletak di luar mungkin memerlukan perlindungan tambahan dari cuaca dan elemen lingkungan.\r\nKualitas Pembuatan:\r\n\r\nKualitas pembuatan yang tinggi mencerminkan keahlian dan dedikasi pengrajin dalam menciptakan patung yang berkualitas dan bernilai seni tinggi.\r\nDetail ukiran atau pahatan yang teliti menunjukkan tingkat keahlian yang tinggi.', '1705295098_e00238d5d0f9f56875d7.jpg,1705295098_a03383110c5f1e6e803c.jpg', 'Batu,Kayu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_access_logs`
--

CREATE TABLE `product_access_logs` (
  `id` int(11) NOT NULL,
  `access_count` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_market`
--

CREATE TABLE `product_market` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_market` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_market`
--

INSERT INTO `product_market` (`id`, `id_product`, `id_market`) VALUES
(8, 1, 1),
(9, 7, 1),
(10, 8, 1),
(11, 9, 1),
(12, 10, 1),
(13, 11, 1),
(14, 12, 1),
(15, 13, 1),
(16, 14, 1),
(17, 15, 1),
(18, 16, 1),
(19, 17, 1),
(20, 18, 1),
(21, 19, 1),
(22, 20, 1),
(23, 21, 1),
(24, 22, 1),
(25, 23, 1),
(26, 24, 1),
(27, 25, 1),
(28, 26, 1),
(29, 27, 1),
(30, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `varian`
--

CREATE TABLE `varian` (
  `id` int(11) NOT NULL,
  `name_varian` varchar(100) NOT NULL,
  `asset_url` varchar(200) NOT NULL,
  `picture_varian` varchar(150) DEFAULT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `varian`
--

INSERT INTO `varian` (`id`, `name_varian`, `asset_url`, `picture_varian`, `id_product`) VALUES
(1, 'Batik', '1Thi_MS4IBsdQVbURE6D748qYBmHEMHkA', 'picture1.jpg', 1),
(2, 'Batok-kelapa', '1VhDbOKK5jCjCXLCwPGVSR6ggfDP2ik97', 'picture1.jpg', 7),
(3, 'Model1', '1DokvNx9G-CKIfQRQxPBjO2xEm_IcigDm', 'picture1.jpg', 8),
(4, 'Model2', '1EkM2nVRzLyjS6V2m6ahDIC5hpJRtSAXk', 'picture1.jpg', 8),
(5, 'Pink', '1ckMDfsFO_BUIdqUELldB-3J8fNuXe4i8', 'picture1.jpg', 9),
(6, 'Kotak', '12Joun5eKy5KwK3yXMrY_rVvpm2E_BXC0', 'picture1.jpg', 10),
(7, 'Biru-with-model', '1YkgEtB8qEfX9ArM-FKHaKBrxnk550hnw', 'picture1.jpg', 11),
(8, 'Biru', '13W75WqsxccH6dhMulHqFbVmP7du2XvSO', 'picture1.jpg', 11),
(9, 'Putih-abu-with-model', '1oPyuEYILhsB2cCzbATM8aWuzdih1nrBr', 'picture1.jpg', 11),
(10, 'Putih-abu', '1snWU62OaRBq93kGrGnsvinf4F8ne8nW8', 'picture1.jpg', 11),
(11, 'Snail', '1huQH2yy0yH_-DGr8B5qWNI0TvWttydQ0', 'picture1.jpg', 12),
(12, 'Bir-bintang', '17SoJOEpawjVWBRSEjTTAg_W_ZGdP_AHi', 'picture1.jpg', 13),
(13, 'Ikan', '13vdmYXWtIZYihdOMKLCcDzQXifGlOpEr', 'picture1.jpg', 14),
(14, 'Pura', '1o2k3uVFAmuqFemY0hSBXxrYIxpqlhHPU', 'picture1.jpg', 14),
(15, 'Sendok-kayu', '15SfjpjxdCC93xfSaVo9vwg69lWhz3TDM', 'picture1.jpg', 15),
(16, 'Bulat', '19Pof9r7MCNLyIRt5VVN9WHFtSn5mQ_6b', 'picture1.jpg', 16),
(17, 'Kotak', '15LOkfw6vGimGIGJ1SLbLtl4Rm9NqkzDX', 'picture1.jpg', 16),
(18, 'Kotak', '1qof3-6FnLrsLuDyD4zY4Fe0lDyLxBb4-', 'picture1.jpg', 17),
(19, 'Batok-kelapa', '1Ro5XgU8RaBAluCGuu0q-SP7PN_mUmZec', 'picture1.jpg', 18),
(20, 'Cup', '1yQSt-qkT2aSHkmB9nD6AroQndJqg_LQk', 'picture1.jpg', 19),
(21, 'Bulat', '1Ft-ai_vcQNfbzffVuyguHDW0N27hbBpp', 'picture1.jpg', 20),
(22, 'Keranjang', '1W0GcIGdeedOPXIZa5VxVlEwjtQfE1RgA', 'picture1.jpg', 21),
(23, 'Keranjang', '1fHR9iNww-1cCMKEcMWxQ__5OWMXqmJYf', 'picture1.jpg', 22),
(24, 'Patung1', '1_laFjyhqFpCMGcVaRyZXaNvLjwUKSNIT', 'picture1.jpg', 23),
(25, 'Patung2', '1cxPX7_5OcUpgOcCJyQD8AiwwdfBgYUvW', 'picture1.jpg', 23),
(26, 'Patung3', '15PlTJUugomGZnmAti8P5yKLuiDWO7VEV', 'picture1.jpg', 23),
(27, 'Patung4', '14MyB4hBh8D8EVKlWCQEV7itsscufhWZ_', 'picture1.jpg', 23),
(28, 'Biru-with-model', '14_iaQgzg2vhauPo03DtkyFvQD2nUgmy3', 'picture1.jpg', 25),
(29, 'Biru', '1Y_lZurPnR_lQF0p89_UEQtjjZBWzhC6C', 'picture1.jpg', 25),
(30, 'Putih-abu-with-model', '1j6dV8SCS0HiDxXcUCH-pkbaYGdarTSPP', 'picture1.jpg', 25),
(31, 'Putih-abu', '1LBmvEy9jio21scAQ0J1dmR7SLsZHux-m', 'picture1.jpg', 25),
(32, 'Whiskey', '1ib34X45hkBHa4Z6PllqWMc5KWCahElV1', 'picture1.jpg', 26),
(33, 'Tas-selempang', '18lm_zJzbE9nb8aIo5q_cGwn_Sl_TlmyT', 'picture1.jpg', 27),
(34, 'Tas-selempang-with-model', '1pBOGpPT7uxoEm89iYGKPPm6gwifM2dWS', 'picture1.jpg', 27),
(35, 'Garuda-dan-wisnu', '1R5fN-VxIuSmJ48jLmn6M_6AmDg0wGfQu', 'picture1.jpg', 28),
(36, 'Garuda', '124yOO_-xaKFDvzJ3WLCvvsbweOaUChHr', 'picture1.jpg', 28),
(37, 'dulang', '1bFLLuKBLeJZXELvaqRboU9v-wNy_NOFd', '1705295524_063d88db315b9685bb8a.jpg', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `floor_plan`
--
ALTER TABLE `floor_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_market` (`id_market`);

--
-- Indexes for table `floor_product`
--
ALTER TABLE `floor_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_floor_plan` (`id_floor_plan`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_access_logs`
--
ALTER TABLE `product_access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product_market`
--
ALTER TABLE `product_market`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_market` (`id_market`);

--
-- Indexes for table `varian`
--
ALTER TABLE `varian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `floor_plan`
--
ALTER TABLE `floor_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `floor_product`
--
ALTER TABLE `floor_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_access_logs`
--
ALTER TABLE `product_access_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_market`
--
ALTER TABLE `product_market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `varian`
--
ALTER TABLE `varian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `floor_plan`
--
ALTER TABLE `floor_plan`
  ADD CONSTRAINT `floor_plan_ibfk_1` FOREIGN KEY (`id_market`) REFERENCES `market` (`id`);

--
-- Constraints for table `floor_product`
--
ALTER TABLE `floor_product`
  ADD CONSTRAINT `floor_product_ibfk_1` FOREIGN KEY (`id_floor_plan`) REFERENCES `floor_plan` (`id`),
  ADD CONSTRAINT `floor_product_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_access_logs`
--
ALTER TABLE `product_access_logs`
  ADD CONSTRAINT `product_access_logs_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_market`
--
ALTER TABLE `product_market`
  ADD CONSTRAINT `product_market_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_market_ibfk_2` FOREIGN KEY (`id_market`) REFERENCES `market` (`id`);

--
-- Constraints for table `varian`
--
ALTER TABLE `varian`
  ADD CONSTRAINT `varian_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
