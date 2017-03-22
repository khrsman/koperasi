<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Kaaba extends CI_Controller {


	function Kaaba(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	

	function index()
	{
		$data['page'] 			= 'main_home';
		$this->load->view('main_generik_new',$data);	
	}	
	
	function menu_haji()
	{
		$data['page'] 			= 'main_menu_haji';
		$data['title']			= "HAJI MAIN MENU";
		$this->load->view('main_generik_new',$data);	
	}

	function menu_umroh()
	{
		$data['page'] 			= 'main_menu_haji';
		$data['title']			= "UMROH MAIN MENU";
		$this->load->view('main_generik_new',$data);	
	}

	function vr_view(){
		$data['page'] 			= 'main_vr';
		$data['link']			= base_url('haji');
		$this->load->view('main_generik_new',$data);

	}

	function rukun_view(){
		$data['page'] 			= 'main_rukun';
		$data['link']			= base_url('haji');
		$this->load->view('main_generik_new',$data);

	}

	function rukun_vr_view(){
		$data['page'] 			= 'main_rukun_vr';
		$rukun = $this->uri->segment(2);
		$konten = array();

		switch ($rukun) {
		    case "1":
		    	$konten[0]['img'] = "images/vr.jpg";
		    	$konten[0]['part'] = "PART : IHRAM";
		    	$konten[0]['content'] = "Slide ke kanan /  ke kiri untuk melihat informasi lain";

		    	$konten[1]['img'] = "images/content/ihram1.jpg";
		    	$konten[1]['part'] = "DEFINISI IHRAM";
		    	$konten[1]['content'] = "<p>Ihram adalah berniat untuk menunaikan ibadah haji dan atau umrah. Apabila hanya berniat untuk menunaikan ibadah umrah terlebih dahulu, berarti kita melaksanakan haji tamattu, apabila berniat untuk melaksanakan ibadah haji dan umrah secara bersamaan, berarti kita melaksanakan haji qiran, apabila berniat untuk menunaikan haji saja, berarti kita melaksanakan haji ifrad. Ihram merupakan rukun haji yang pertama.";


		    	$konten[2]['img'] = "images/content/ihram1.jpg";
		    	$konten[2]['part'] = "DASAR HUKUM & KEUTAMAAN IHRAM ";
		    	$konten[2]['content'] = "<p>Ihram disyaratkan dimulai dari miqat, baik miqat zamani maupun miqat makani serta beberapa larangan. Ihram merupakan rukun haji yang pertama, dan kesempurnaan dalam menetapi larangan ihram merupakan kesempurnaan dalam melakukan haji, karena pelanggaran yang dilakukan saat ihram membawa sangsi berupa dam (denda) yang harus ditunaikan. Setelah kita melaksanakan perbuatan-perbuatan dalam ihram (tatacara ihram), maka selanjutnya kita mengucapkan talbiah.";

		    	$konten[3]['img'] = "images/content/ihram2.jpg";
		    	$konten[3]['part'] = "TATA CARA IHRAM ";
		    	$konten[3]['content'] = "<p>Tata cara pelaksanaan ihram pada garis besarnya berniat haji/umrah dari miqat menjauhi hal-hal yang dilarang pada saat ihram. Ihram dilakukan sesuai dengan niat miqatnya, baik itu niat miqat zamani maupun miqat makani. Ihram yang sesuai dengan miqat ini termasuk dalam wajib haji. Ihram yang dilakukan sebelum bulan haji hukumnya tidak sah, jadi ihram dilakukan pada bulan haji dan dimulai dari tempat yang sudah ditentukan sesuai dengan negara asal jamaah haji. Untuk jamaah haji yang berasal dari Indonesia, ihram dapat dimulai dari Jeddah.</p><p>Mandi dan membersihkan diri dengan jalan memotong kuku, memendekkan kumis, mencabut bulu ketiak, mencukur bulu kemaluan dan disunahkan untuk mandi junub, termasuk perempuan yang sedang haid dan nifas (HR. Bukhori-Muslim dan Abu Daud).</p><p>Memakai pakaian ihram berwarna putih yang tidak berjahit bagi laki-laki sebanyak 2 lembar, satu dipakai sebagai sarung dan diberi ikat pinggang yang kuat dan lainnya dililitkan di badan. Bagi perempuan memakai pakaian muslim biasa yang menutupi seluruh aurat, kecuali muka dan telapak tangan.</p> <p>Sholat ihram 2 rakaat, yang diawali dengan berwudlu terlebih dahulu. Pada rakaat pertama setelah Al-Fatihah membaca QS. Al-Kafirun dan ada rakaat ke dua QS. Al-Ikhlas (HR. Muslim). Sholat ini termasuk sunah haji.</p>";		    	

			    $konten[4]['img'] = "images/content/ihram2.jpg";
		    	$konten[4]['part'] = "TATA CARA IHRAM ";
		    	$konten[4]['content'] = "<p>Tata cara pelaksanaan ihram pada garis besarnya berniat haji/umrah dari miqat menjauhi hal-hal yang dilarang pada saat ihram. Ihram dilakukan sesuai dengan niat miqatnya, baik itu niat miqat zamani maupun miqat makani. Ihram yang sesuai dengan miqat ini termasuk dalam wajib haji. Ihram yang dilakukan sebelum bulan haji hukumnya tidak sah, jadi ihram dilakukan pada bulan haji dan dimulai dari tempat yang sudah ditentukan sesuai dengan negara asal jamaah haji. Untuk jamaah haji yang berasal dari Indonesia, ihram dapat dimulai dari Jeddah.</p><p>Mandi dan membersihkan diri dengan jalan memotong kuku, memendekkan kumis, mencabut bulu ketiak, mencukur bulu kemaluan dan disunahkan untuk mandi junub, termasuk perempuan yang sedang haid dan nifas (HR. Bukhori-Muslim dan Abu Daud).</p><p>Memakai pakaian ihram berwarna putih yang tidak berjahit bagi laki-laki sebanyak 2 lembar, satu dipakai sebagai sarung dan diberi ikat pinggang yang kuat dan lainnya dililitkan di badan. Bagi perempuan memakai pakaian muslim biasa yang menutupi seluruh aurat, kecuali muka dan telapak tangan.</p><p>Sholat ihram 2 rakaat, yang diawali dengan berwudlu terlebih dahulu. Pada rakaat pertama setelah Al-Fatihah membaca QS. Al-Kafirun dan ada rakaat ke dua QS. Al-Ikhlas (HR. Muslim). Sholat ini termasuk sunah haji.</p>";
		    	$data['read'] = $konten;
		        break;


		    case "2":
				$konten[0]['img'] = "images/menu_wukuf.jpg";
		    	$konten[0]['part'] = "PART : WUKUF";
		    	$konten[0]['content'] = "Slide ke kanan /  ke kiri untuk melihat informasi lain";

		    	$konten[1]['img'] = "images/menu_wukuf.jpg";
		    	$konten[1]['part'] = "DEFINISI WUKUF";
		    	$konten[1]['content'] = "<p>Wukuf adalah kegiatan utama dalam ibadah haji. Bahkan, inti ibadah haji adalah wukuf di Padang Arafah. hadir dan berada pada bagian manapun dari arafah, walau seseorang itu dalam keadaan tidur atau bangun, berkendaraan atau duduk, berbaring atau berjalan, dalam keadaan suci atau tidak, pada tanggal 9 Dzulhijah, mulai siang hari sampai maghrib.</p><p>
					Secara fisik wukuf Arafah adalah puncak berkumpulnya seluruh jamaah, yang berjumlah jutaan dari penjuru dunia dalam waktu bersamaan. Dan secara amaliah wukuf Arafah mencerminkan puncak penyempurnaan haji.</p><p>
					Di Arafah inilah Rasulullah SAW menyampaikan khutbahnya yang terkenal dengan nama khutbah wada atau khutbah perpisahan, karena tak lama setelah menyampaikan khutbah itu beliau pun wafat. Di saat itu, ayat Al-Qur'an surat al-Maa'idah ayat 3 turun sebagai pernyataan telah sempurna dan lengkapnya ajaran Islam yang disampaikan Allah SWT melalui Muhammad SAW. 'Pada hari ini telah Ku-sempurnakan untuk kamu agamamu dan telah Ku-cukupkan kepadamu nikmat-Ku dan telah Ku-ridhai Islam itu menjadi agama bagimu... (Al-Mai dah:3)</p>";


		    	$konten[2]['img'] = "images/menu_wukuf.jpg";
		    	$konten[2]['part'] = "DASAR HUKUM & KEUTAMAAN WUKUF ";
		    	$konten[2]['content'] = "<p>Wukuf di Arafah merupakan rukun terpenting dari haji, sesuai dengan hadits nabi: 'Haji itu di Arafah barang siapa yang datang pada malamnya jam'in (tanggal 8) sebelum terbitnya pajar maka ia menjumpai hajinya (hajinya sah)'. (HR.Tirmidzi)</p>";

		    	$konten[3]['img'] = "images/menu_wukuf.jpg";
		    	$konten[3]['part'] = "KEUTAMAAN WUKUF";
		    	$konten[3]['content'] = "<p>Hari pada saat wukufmerupakan hari yang palin utama dan pada saat itu Allah turun ke bumi, membanggakan penduduk bumi terhadap isi langit. Pada hari itu banyak orang dibebaskan dari neraka. (HR. Ibnu Majah).Diampuni dosa-dosanya. (HR. Ibnu Mubarak).</p>
		    		<p></p>Bahwasanya musuh Allah (Iblis) ketika ia mengetahui bahwasanya Allah telah mengabulkan do'aku (nabi), dan Allah mengampuni dosa-dosa umatku, Iblis mengambil debu ditaburkannya diatas kepalanya seraya husteris celaka, dan sangat menyesal. Dalam pada itu nabi tertawa atas kegelisahannya (Iblis).(HR. Ibnu Majah). Bertasbih (mengucap Subhaanallaah) 100 kali di pagi hari da 100 kali di sore hari, maka kita diberi pahala sebagaimana 100 kali naik haji. Bertahmid (mengucap Al-Hamdulillaah) 100 kali di pagi hari dan 100 kali di sore hari, maka kita diberi pahala sebagaimana orang yang telah menyerahkan 100 ekor unta ke dalam sabilillah atau sebgaimana pahalanya 100 kali dalam sabilillah. Bertahlil (mengucap Laa ilaaha illallaah) 100 di pagi hari dan 100 kali di sore ahri, pahalanya bagaikan memerdekaan 100 orang budak dari keturunan Ismail. Bertakbir (mengucap Allaahu akbar) 100 kali di pagi hari dan 100 kali di sore hari, maka tidak seorangpun yang mampu menandingi pahala orang tersebut kecuali orang yang sama-sama bertakbir kepada Allah </p>

		    		";		    	

			    $konten[4]['img'] = "images/menu_wukuf.jpg";
		    	$konten[4]['part'] = "TATA CARA WUKUF ";
		    	$konten[4]['content'] = "<p>Melaksanakan sholat Dzuhur dan Ashar dijama' kemudian menghadap kiblat, memperbanyak istighfar, berdzikir dan berdo'a baik untuk diri pribadi maupun orang lain, mengenai kepentingan agama atau dunia disertai taqwa dan perhatian penuh, sambil mengangkat kedua tangan. Sebaik-baik do'a adalah do'a pada hari Arafah. Setelah Maghrib, lalu perlahan-lahan meninggalkan padang Arafah menuju ke Mudzalifah dengan tenang dan tentram, sesuai dengan hadits riwayat Bukhari dan Muslim. </p>";

		    	$konten[5]['img'] = "images/menu_wukuf.jpg";
		    	$konten[5]['part'] = "HAKEKAT WUKUF ";
		    	$konten[5]['content'] = "<p>Perjalanan haji adalah perjalanan menuju Allah dan merupakan gerakan abadi yang tidak pernah berhenti. Perjalanan kembali kepada Allah terbagi menjadi tga tahap yaitu Arafat, Masy’ar (Mudzalifah) dan Mina. Arafat berarti pengetahuan dan sains, Masy’ar berarti kesadaran dan pengertian, serta Mina berarti cinta dan keyakinan. Arafat melambangkan awal penciptaan manusia. Adam turun ke bumi karena mengingkari perintah Allah dan bertemu dengan Hawa di Jabal Rahmah Arafah. Adam (manusia) memeliki kebebasan untuk mengambil keputusan, termasuk yang bertentangan dengan kehendak Allah, namun bersamaan dengan kebebasan itu memiliki rasa tanggung jawab dan kesadaran. Akibat sorga Adam penuh dengan kepuasan, kenikmatan dan kesenangan dan digantikan dengan dunia yang penuh dengan kebutuhan, ketamakan dan penderitaan. Peralihan Adam yang berada di surga menjadi Adam yang berada di dunia merupakan pencerminan dari karakter dan tingkah laku manusia bersamaan. Percikan cinta yang pertama kali dalam pertemuan Adam dan hawa menyebabkan mareka saling memahami. Itu pertanda dari pengetahuan pertama tentang jenis kelamin. Ketika melakukan haji itu gerakan yang pertama bermula di Arafat. Berhenti (wukuf) di Arafah ketika matahari sedang terik-teriknya dimaksudkan agar kita memperoleh kersadaran, wawasan, kemerdekaan, pengetahuan dan cinta di siang hari. Begitu matahari terbenam, maka wukuf di Arafat itupun berakhirlah. Taksesuatupun dapat terlihat dalam gelap, akibatnya dalam kegelapn tak ada perkenaln dan pengetahuan. Wukuf menggambarkan kehidupan manusia hanya sebentar. Dan kita melanjutkan perjalanan sampai jke Masy’ar atau negeri kesadaran lalu berhenti.</p>";

		    	$konten[6]['img'] = "images/menu_wukuf.jpg";
		    	$konten[6]['part'] = "BACAAN WUKUF ";
		    	$konten[6]['content'] = "<p>Ya Allah segala puji Allah milik-Mu semata seperti yang kau firmankan dan yang lebih baik dari pada yang kami katakan. Hanya untuk-Mu kami mepersembahkan shalat dan ibadah kami, serta hidup dan mati kami. Kepada Engkaulah tempat kami kembali dan Engkaulah Dzat yang mewaris kepada kami. Ya Allah sesungguhnya kami berlindung kepada-Mu dari siksa kubur dan keraguan hati serta kekacauannya suatu perkara. Ya Allah kami berlindung kepada-Mu dari segala macam kejelekan yang datang melalui hambusan angin </p> 
		    		<p>
		    		Setelah kita membaca do'a diatas, boleh menambahkan do'a-do'a lain sesuai dengan kebutuhan. Sebelum berdo'a sebaiknya kita memuji kepada-Nya, dengan membaca Asmaul Husna. Setelah membaca Asmaul Husna, kemudian membaca do'a pengampunan dan do'a sesuai dengan keperluannya masing-masing,Do'a Nabi Adam as dan Hawa, Do'a nabi Nuh AS,Do'a Nabi Dawud AS.
		    		</p>";

		    	
		        break;





		    case "3":
		        $konten[0]['img'] = "images/menu_tawaf.jpg";
		    	$konten[0]['part'] = "PART : TAWAF";
		    	$konten[0]['content'] = "Slide ke kanan /  ke kiri untuk melihat informasi lain";

		    	$konten[1]['img'] = "images/content/tawaf1.jpg";
		    	$konten[1]['part'] = "DEFINISI TAWAF";
		    	$konten[1]['content'] = "<p>Tawaf adalah mengelilingi Ka'bah tujuh kali dengan arah ke kiri atau berlawanan dengan jarum putaran jam. Tawaf dilakukan di Ka'bah yang dimulai di Hajar Aswad atau garis yang sejajar dengan Hajar Aswad.</p>";

		    	$konten[2]['img'] = "images/content/tawaf3.jpg";
		    	$konten[2]['part'] = "DASAR HUKUM TAWAF";
		    	$konten[2]['content'] = "<p>Dan hendaklah mereka melakukan tawaf sekeliling rumah tua itu (Baitullah). (QS. Al Hajj : 29). Tawaf dilaksanakan di Ka'bah (Masjidil Haram) yang memiliki banyak keistimewaan seperti yang difirmankan oleh Allah Sesungguhnya rumah yang mula-mula dibangun untuk tempat beribadah manusia, ialah Baitullah di Bakkah (Mekah) yang diberkahi dan menjadi petunjuk bagi semua manusia. (QS. Ali Imran: 96).</p><p>Ka'bah merupakan rumah suci sebagai pusat peribadatan dan urusan dunia bagi umat manusia (QS. 5: 97). Orang yang berhak menguasai Masjidil Haram hanyalah orang yang bertaqwa (QS. 8: 34). Orang yang memberi minuman bagi orang yang mengerjakan haji dan mengurus Masjdil Haram tidak lebih utama dari orang yang berjihad di jalan Allah (QS. 9: 19). Bagi mereka yang shalat di Masjidil Haram dengan siulan dan tepuk tangan akan dimurkai oleh Allah (QS. 8: 35), sehingga sejak tahun 9 Hijriah, orang musyrik yang mempersekutukan Allah dilarang mendekati Masjidil Haram (QS. 9: 28).</p>";

		    	$konten[3]['img'] = "images/content/tawaf3.jpg";
		    	$konten[3]['part'] = "MACAM - MACAM TAWAF";
		    	$konten[3]['content'] = "<p>Tawaf qudum yaitu tawaf sunah yang dilakukan pertama kali ketika memasuki Mekkah, disebut juga tawaf selamat datang.</p><p>Tawaf ifadah yaitu tawaf wajib dan merupakan rukun haji.</p><p>Tawaf wada' yaitu tawaf yang dilakukan ketika hendak meninggalkan kota Mekah (tawaf selamat tinggal). Tawaf ini merupakan salah satu wajib haji.</p><p>Tawaf umrah yitu tawaf yang dilakukan dalam rangkaian pelaksanaan ibadah umrah.</p><p>Tawaf sunah yaitu tawaf yang dilakukan kapan saja.</p>";

		    	$konten[4]['img'] = "images/content/tawaf4.jpg";
		    	$konten[4]['part'] = "KEUTAMAAN TAWAF";
		    	$konten[4]['content'] = "<p>Dalam Ka'bah ada 120 rohmat terdiri dari 60 rohmat untuk yang melakukan tawaf, 40 rohmat untuk yang melakukan sholat dan 20 rohmat untuk yang melihat Ka'bah. Dapat merasakan suasana di Baitullah seperti di Arsy, maka kita bersenang-senang sebagai tamu Allah.Sholat 2 rokaat di akhir tawaf pahalanya sama dengan memerdekakan budak dari Bani Ismail.Tawaf wada' akan membuat kita diampuni dosa-dosa kita yang telah lewat dan pahalanya sama dengan memerdekakan budak.Pada saat kita melaksanakan tawaf dan berbicara akan dinilai sebuah kebaikan dan Malaikat akan berdo'a sama dengan do'a tawaf sehingga kita akan diangkat 10 tingkat kebaikan.Pada saat berhadapan dengan Hajar Aswad sama dengan berhadapan dengan Allah. Bila kita dapat melaksanakan tawaf sunah 50 kali maka diampuni semua dosa kita seperti bayi yang baru lahir.</p>";

		    	$konten[5]['img'] = "images/content/tawaf5.jpg";
		    	$konten[5]['part'] = "TATACARA PELAKSANAAN TAWAF";
		    	$konten[5]['content'] = "<p>Setelah memasuki Masjidil Haram, kita berwudlu terlebih dahulu dan menuju ke sudut hajar Aswad. Tawaf dimulai dari Hajar Aswad dengan mencium atau mengusapnya, namun jika tidak mampu cukup memberi isyarat dengan tangan, lalu berjalan Mengelilingi ka'bah tujuh kali. Putaran ke 1, 2 dan 3 berjalan cepat, dan putaran ke 4, 5, 6 dan ke 7 berjalan biasa. Setelah sampai di rukun Yamani, maka memberi isyarat dengan tangan dan bila mampu mengusapnya. Setelah selesai 7 putaran, maka dikahiri dengan sholat sunah 2 rokaat di belakang maqam Ibrahim. Pada saat akan memasuki Masjidil Harom, kaki kanan didahulukan sambil berdo'a: Dengan nama Allah, semoga keselamatan dilimpahkan kepada rosulullah saw. Ya Allah berilah ampunan bagi kami serta bukakanlah bagi kami pintu rahmat-Mu.(HR. Tirmidzi).</p>
					<p>Setelah memasuki Masjidil Haram, sewaktu melihat Ka'bah kita berdo'a: Artinya : Ya Allah tambahkanlah kemuliaan, keagungan, kehormatan dan kehebatan pada Baitullah ini dan tambahkanlah pada orang-orang yang memuliakannya dan mengagungkannya dari orang-orang yang berhaji dan umroh kemuliaan, kebesaran, kehormatan dan kebaikan.(HR. Thabrani).</p>
					<p>Setelah selesai mendengar suara adzan kita berdo'a:Artinya : Ya Allah, Tuhannya seruan adzan yang sempurna dan sholat yang ditegakkan ini, berilah wasilah dan fadilah kepada Nabi Muha</p>";

		    	$konten[6]['img'] = "images/content/tawaf6.jpg";
		    	$konten[6]['part'] = "HAKEKAT TAWAF DALAM KEHIDUPAN KONTEKSTUAL ";
		    	$konten[6]['content'] = "<p>Ka’bah dalam kehidupan kaum muslimin dalam sholatnya adalah pusat eksistensi, keyakinan, cinta dan kehidupannya, ke arah Ka’bah inilah kaum muslimin yang sedang menemui ajal dihadapkan dan kaum muslimin yang meninggal dikuburkan. Namun Ka’bah sebuah bangunan persegi dan kosong. Tak ada apa-apa. itulah pusat agama, shalat, cinta, kehidupan kematian kita ?. Kekosongan ini sebagai petunjuk arah Ka’bah adalah rumah Allah dan rumah seluruh umat manusia yang telah dapat melepaskan diri dari belenggu dirinya sendiri menghadap kepada Allah. Sebagai sebuah kubus, Ka’bah memiliki 4 sisi yang menghadap segala arah, sedangkan keseluruhan sisinya melambangkan ketiadaan arah, sesuai dengan firman-Nya</p>";
		        break;





		    case "4":
		    	$konten[0]['img'] = "images/menu_sai.jpg";
		    	$konten[0]['part'] = "PART : SA'I";
		    	$konten[0]['content'] = "Slide ke kanan /  ke kiri untuk melihat informasi lain";


		    	$konten[1]['img'] = "images/content/sai1.jpg";
		    	$konten[1]['part'] = "DEFINISI SA'I";
		    	$konten[1]['content'] = "<p>Sai artinya berjalan antara bukit Shafa dan Marwah</p>";

		    	$konten[2]['img'] = "images/content/sai2.jpg";
		    	$konten[2]['part'] = "DASAR HUKUM SA'I";
		    	$konten[2]['content'] = "<p>Hukum Sai adalah wajib, Sesunggunya Shafaa dan Mawrah adalah sebagian dari syiar Allah. Maka berang siapa yang beribadah haji ke Baitullah atau berumrah, maka tidak ada dosa baginya mengerjakan sa'i antara keduanya. Dan barang siapa yang mengerjakan suatu kebajikani, maka sesungguhnya Allah Maha mensyukuri kebaikan lagi Maha Penyayang. (QS. 2:158).</p>";

		    	$konten[3]['img'] = "images/content/sai3.jpg";
		    	$konten[3]['part'] = "KEUTAMAAN SA'I & TATA CARA PELAKSANAAN SA'I";
		    	$konten[3]['content'] = "<p>Pahala sai sama dengan memerdekakan 70 orang budak.Sai dilakukan di kompleks Masjidil Haram antara pintu 18-32, antara bukit Shafa dan Marwah. Tempat sai terdiri dari 2 jalur yang ditengahnya disediakan bagi jamaah yang menggunakan kursi roda. Tempat Sai ini di dalam ruangan yang ber AC. Setelah selesai thawaf, kita menuju ke sumur air zam-zam (disunatkan minum air zam-zam), kemudian munuju bukit Shafa untuk melaksanakan sa'i. Dari Shafa menuju bukit Marwah, kembali lagi ke bukit Shafa, kemudian kembali ke bukit Marwah dst 7 kali terakhit di bukit Marwah.</p>";

		    	$konten[4]['img'] = "images/content/sai3.jpg";
		    	$konten[4]['part'] = "KESALAHAN YANG SERING TERJADI PADA SAAT SA'I";
		    	$konten[4]['content'] = "<p> 1. Sewaktu naik ke bukit Shafa atau Marwah menghadap ke Ka'bah kemudian mengangkat tangan seperti hendak shalat. Ini tidak pernah dicontohkan oleh Nabi. </p><p> Yang benar kita menghadap ke Qa'bah dengan mengangkat kedua telapak tangan sambil berdo'a.</p><p> Berjalan cepat antara Shafa- Marwah pada seluruh putaran, ini tidak perlu karena menurut sunah Rosul hanya diantara kedua tanda lampu hijau saja.</p>";
		        break;
		    case "5":
		    	$konten[0]['img'] = "images/menu_tahalul.jpg";
		    	$konten[0]['part'] = "PART : TAHALUL";
				$konten[0]['content'] = "Slide ke kanan /  ke kiri untuk melihat informasi lain";

		    	$konten[1]['img'] = "images/content/TAHALU1.jpg";
		    	$konten[1]['part'] = "DEFINISI TAHALUL";
		    	$konten[1]['content'] = "<p> Mencukur rambut. Tahalul ada 2 macam yaitu :
				Tahalul awal, yaitu mencukur/ memotong rambut setelah melempar jumrah pada hari Nahar. Maka halallah bagi orang yang sedang ihram, apa-apa yang terlarang pada waktu ihram. Kita boleh berpakaian biasa, memakai parfum dll, kecuali hubungan dengan istri/suami. Tahalul akhir, yaitu mencukur/ memotong rambut setelah melakukan thawaf ifadhah(thawaf rukun haji), maka halal segala sesuatu larangan ihram termasuk hubungan dengan istri/suami.</p>";

		    	$konten[2]['img'] = "images/content/TAHALU2.jpg";
		    	$konten[2]['part'] = "DASAR HUKUM TAHALUL";
		    	$konten[2]['content'] = "<p> Tahalul dilakukan dalam rangka mentaati perintah Allah, agar kita menghilangkan kotoran (memotong rambut dan mengerat kuku) yang ada pada badan kita dan handaklah kita menunaikan nazar-nazar kita. </p>";
		        break;	

		    case "6":
		    	$konten[0]['img'] = "images/menu_tertib.jpg";
		    	$konten[0]['part'] = "PART : TERTIB";
		    	$konten[0]['content'] = "<p>Tertib sesuai dengan tuntutan manasik haji. </p>";
		        break;	
		    default:
		        redirect('rukun');
		}
		// var_dump($data['read']);
		// die();
		$data['read'] = $konten;
		$data['link']			= base_url('rukun');
		$this->load->view('main_generik_new',$data);

	}

	function info_view(){
		$data['page'] 			= 'main_info';
		$data['link']			= base_url('haji');
		$this->load->view('main_generik_new',$data);

	}

	function info_det_view(){
		$data['page'] 			= 'main_info_det';
		$rukun = $this->uri->segment(2);

		switch ($rukun) {
		    case "1":
		    	$data['part'] 		= 'SYARAT SAH HAJI';
		    	$data['img'] 		= 'menu_syarat.jpg';
		    	$data['content'] 	= 'Syarat Sah Haji<br>1. Agama Islam<br>2. Dewasa / baligh (bukan mumayyis)<br>3. Tidak gila / waras<br>4. Bukan budak (merdeka)';
		        break;
		    case "2":
		        $data['part'] 		= 'KUMPULAN DOA';
		        $data['img'] 		= 'menu_doa.jpg';
		    	$data['content'] 	= '<ol><li>Doa Sebelum Minum Air Zam-zam</li><li>Doa Setelah Shalat Sunat di Hijir Ismail</li><li>Doa Sesudah Shalat Sunat Thawaf</li><li>Doa di Multazam Setelah Tawaf</li><li>Doa Tawaf Putaran Ketujuh</li><li>Doa Sai</li><li>DOa Melempar Jumroh</li></ol>';
		        break;
		    case "3":
		        $data['part'] 		= 'AMALAN HAJI';
		        $data['img'] 		= 'menu_amalan.jpg';
		    	$data['content'] 	= '<ol><li>Berangkat menuju Mina dan menginap disana serta melaksanakan shalat Zhuhur, Ashar, Maghrib, Isya’ dan Shubuh dengan mengqashar shalat-shalat yang empat rakaat tanpa di jamak. </li><li>Bertolak dari Mina pada hari Arafah (9 Dzulhijjah) setelah matahari terbit.</li><li>Turun di Namirah disisi padang Arafah dan melaksanakan shalat Zhuhur dan Ashar, dijamak taqdim dan diqashar dengan satu kali adzan dan dua kali iqamah.</li><li>Melaksanakan wuquf diatas padang Arafah dalam kondisi tidak berpuasa. Sambil menghadap ke arah kiblat, berdoa dengan mengangkat tangan hingga matahari terbenam.</li><li>Bertolak meninggalkan Arafah setelah matahari terbenam sambil membaca talbiyah dan berjalan dengan penuh ketenangan.</li><li>Shalat Maghrib dan Isya dengan dijamak setelah tiba di Muzdalifah, shalat ini dilakukan dengan satu kali adzan dan dua kali iqamah.</li><li>Menginap di Muzdalifah tanpa menghidupkan malam itu dengan shalat, baca al-Qur-an atau ibadah lainnya karena hal tersebut tidak dilakukan oleh Rasulullah Shalallaahu alaihi wasalam .</li></ol>
';
		        break;
		    case "4":
		        $data['part'] 		= 'TIPS & TRICK';
		        $data['img'] 		= 'menu_tips.jpg';
		    	$data['content'] 	= '<ol><li>Pertama, jangan lupakan kartu identitas jemaah haji Indonesia Anda, biasanya berupa gelang jamaah, gelang maktab dan ID card jamaah. Sehingga jika Anda hilang, petugas bisa mendeteksi rombongan Anda.</li><li>Kedua, selalu bawa serta identitas hotel berupa kartu nama yang berisi alamat dan contact person. Jika Anda tersesat, Anda bisa minta pada petugas untuk ditunjukkan ke alamat hotel.</li><li>Ketiga, usahakan untuk tidak terpisah dari rombongan, setidaknya selalu bersama salah satu teman dari rombongan sehingga kita tidak terpisah seorang diri.</li><li>Keempat, saat akan memasuki Masjidil Haram, perhatikan nomor pintu masuk, ingat-ingat nomornya atau bisa juga dicatat atau difoto sehingga kita bisa keluar melalu pintu tempat kita masuk.</li><li>Kelima, jika menggunakan bus shalawat, perhatikan stiker bus karena ada 12 rute yang mempunyai stiker dan nomor berbeda.</li></ol>';
		        break;

		    default:
		        redirect('info');
		}


		$data['link']			= base_url('info');
		$this->load->view('main_generik_new',$data);

	}



}





