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

		switch ($rukun) {
		    case "1":
		    	$data['part'] 		= 'PART : IHRAM';
		    	$data['content'] 	= 'keadaan seseorang yang telah beniat untuk melaksanakan ibadah haji dan atau umrah. ';
		        break;
		    case "2":
		        $data['part'] 		= 'PART : WUKUF';
		    	$data['content'] 	= ' mengasingkan diri atau mengantarkan diri ke suatu “panggung replika” padang Masyhar. ';
		        break;
		    case "3":
		        $data['part'] 		= 'PART : TAWAF';
		    	$data['content'] 	= 'salah satu amal ibadah yang dilakukan oleh Muslim pada saat melaksanakan haji dan umrah. ';
		        break;
		    case "4":
		        $data['part'] 		= 'PART : SAI';
		    	$data['content'] 	= ' salah satu rukun umrah yang dilakukan dengan berjalan kaki (berlari-lari kecil) bolak-balik 7 kali dari Bukit Shafa ke Bukit Marwah. ';
		        break;
		    case "5":
		        $data['part'] 		= 'PART : TAHALUL';
		    	$data['content'] 	= 'dihalalkan, dalam haji dan umrah maksudnya adalah diperbolehkannya jamaah haji dari larangan/ pantangan ihram. ';
		        break;	
		    case "6":
		        $data['part'] 		= 'PART : TERTIB';
		    	$data['content'] 	= 'Tertib sesuai dengan tuntutan manasik haji. ';
		        break;	
		    default:
		        redirect('rukun');
		}


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





