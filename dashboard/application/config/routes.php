<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['home'] = 'dashboard/index';
$route['home/(:any)'] = 'dashboard/index/$1';
$route['profile'] = 'dashboard/edit_profile';
$route['update_profile'] = 'dashboard/edit_profile';
$route['update_basic_profile'] = 'dashboard/edit_basic_profile';
$route['update_password'] = 'dashboard/update_password';
$route['update_pin'] = 'dashboard/update_pin';
$route['update_contact'] = 'dashboard/update_contact';
$route['photo_profile'] = 'dashboard/upload_photo_profile';
$route['photo_cover'] = 'dashboard/upload_photo_cover';


$route['add_alamat'] = 'dashboard/add_alamat';
$route['edit_alamat/(:any)'] = 'dashboard/edit_alamat/$1';
$route['update_alamat'] = 'dashboard/update_alamat';
$route['delete_alamat/(:any)'] = 'dashboard/hapus_alamat/$1';
$route['hapus_alamat'] = 'dashboard/delete_alamat/';
$route['setDefaultAlamat/(:any)'] = 'dashboard/set_default/$1';
$route['set_default_alamat'] = 'dashboard/set_default_alamat';

$route['login'] = 'auth/index';
// $route['logout'] = 'auth/logout';
$route['logout'] = 'out/index';
$route['registrasi'] = 'ger/index';


$route['admin'] = "admin/admin_data";
$route['user_management'] = "User_management/admin_data";
$route['add_user'] = "User_management/add_user";
$route['edit_user/(:num)'] = "User_management/edit_user/$1";
$route['delete_user/(:any)'] = "User_management/delete_user/$1";
$route['add_admin'] = "admin/add_admin";
$route['edit_admin/(:num)'] = 'admin/edit_admin/$1';
$route['admin_edit'] = 'admin/update_admin';
$route['delete_admin/(:num)'] = 'admin/delete_admin/$1';
$route['admin_delete'] = 'admin/admin_delete';

$route['anggota'] = "anggota/data_anggota";
$route['anggota/(:num)'] = "anggota/data_anggota";
$route['add_anggota'] = 'anggota/add_anggota';
$route['edit_anggota/(:any)'] = 'anggota/edit_anggota/$1';
$route['update_anggota'] = 'anggota/anggota_edit';
$route['delete_anggota/(:any)'] = 'anggota/delete_anggota/$1';
$route['anggota_delete'] = 'anggota/anggota_delete';



$route['userdata/(:any)'] = 'user/user_data/$1';
$route['user'] = 'user/user_data';


$route['detail_user/(:num)'] = 'user/detail_user/$1';
$route['user_detail'] = 'user/detail';

$route['delete_user/(:num)'] = 'user/delete_user/$1';
$route['user_delete'] = 'user/user_delete';


$route['komunitas'] = 'komunitas/komunitas_data';
$route['add_komunitas'] = 'komunitas/add_komunitas';
$route['edit_komunitas/(:num)'] = 'komunitas/edit_komunitas/$1';
$route['komunitasupdate'] = 'komunitas/update_komunitas';
$route['delete_komunitas/(:num)'] = 'komunitas/delete_komunitas/$1';
$route['komunitas_delete'] = 'komunitas/komunitas_delete';

$route['anggota_komunitas'] = "anggota_komunitas/data_anggota_komunitas";
$route['add_anggota_komunitas'] = 'anggota_komunitas/add_anggota_komunitas';
$route['edit_anggota_komunitas/(:any)'] = 'anggota_komunitas/edit_anggota_komunitas/$1';
$route['update_anggota_komunitas'] = 'anggota_komunitas/anggota_komunitas_edit';
$route['delete_anggota_komunitas/(:any)'] = 'anggota_komunitas/delete_anggota_komunitas/$1';
$route['anggota_komunitas_delete'] = 'anggota_komunitas/anggota_komunitas_delete';
$route['shu_koperasi'] = 'koperasi/koperasi_shu';
$route['shu_koperasi/(:num)'] = 'koperasi/koperasi_shu';


$route['koperasi'] = 'koperasi/koperasi_data';
$route['koperasi/(:num)'] = 'koperasi/koperasi_data';

$route['cabang_koperasi'] = 'koperasi/cabang_koperasi_data';
$route['add_koperasi'] = 'koperasi/add_koperasi';
$route['edit_koperasi/(:num)'] = 'koperasi/edit_koperasi/$1';
$route['koperasiupdate'] = 'koperasi/update_koperasi';
$route['koperasi_update_basic'] = 'koperasi/update_basic_profile';
$route['koperasi_update_password'] = 'koperasi/update_password';
$route['koperasi_update_contact'] = 'koperasi/update_contact';
$route['koperasi_update_alamat'] = 'koperasi/update_alamat';
$route['delete_koperasi/(:num)'] = 'koperasi/delete_koperasi/$1';
$route['koperasi_delete'] = 'koperasi/koperasi_delete';
$route['share_profit'] = 'koperasi/share_cabang';
$route['share_profit_induk'] = 'koperasi/share_induk';
$route['edit_profit/(:any)'] = 'koperasi/edit_profit/$1';
$route['update_profit'] = 'koperasi/update_profit';

$route['pekerjaan'] = 'pekerjaan/pekerjaan_data';
$route['add_pekerjaan'] = 'pekerjaan/add_pekerjaan';
$route['edit_pekerjaan/(:num)'] = 'pekerjaan/edit_pekerjaan/$1';
$route['pekerjaanupdate'] = 'pekerjaan/update_pekerjaan';
$route['delete_pekerjaan/(:num)'] = 'pekerjaan/delete_pekerjaan/$1';
$route['pekerjaan_delete'] = 'pekerjaan/pekerjaan_delete';


$route['produk'] = 'produk/produk_corridor';

$route['produk_owner'] = 'produk/produk_data';
$route['produk_koperasi'] = 'produk/produk_data';
$route['produk_anggota'] = 'produk/produk_data';
$route['catatan/(:any)'] = 'produk/history_produk/$1';
$route['catatan_produk'] = 'produk/catatan_produk/$1';

$route['add_produk'] = 'produk/add_produk';
$route['detail_produk/(:any)'] = 'produk/detail_produk/$1';
$route['produk_detail'] = 'produk/produk_detail';
$route['update_produk'] = 'produk/update_produk';
$route['delete_produk/(:any)'] = 'produk/delete_produk/$1';
$route['produk_delete'] = 'produk/produk_delete';

$route['produk_kategori'] = 'produk/produk_kategori_data';
$route['add_produk_kategori'] = 'produk/add_produk_kategori';
$route['update_produk_kategori/(:any)'] = 'produk/update_produk_kategori/$1';
$route['produk_kategori_update'] = 'produk/produk_kategori_update';
$route['delete_produk_kategori/(:any)'] = 'produk/delete_produk_kategori/$1';
$route['produk_kategori_delete'] = 'produk/produk_kategori_delete';

$route['add_produk_foto'] = 'produk/add_produk_foto';
$route['upload_produk_foto'] = 'produk/upload_produk_foto';
$route['delete_produk_foto/(:any)'] = 'produk/delete_produk_foto/$1';
$route['produk_foto_delete'] = 'produk/produk_foto_delete';


$route['default_controller'] = 'auth';
$route['404_override'] = 'Notfound';
$route['translate_uri_dashes'] = FALSE;
$route['not_found'] = 'nothing';


$route['berita/(:any)'] = "berita/berita_data/$1";
$route['add_berita'] = "berita/add_berita";
$route['tambah_berita'] = "berita/tambah_berita";
$route['lihat_berita/(:any)'] = "berita/berita_lihat/$1";
$route['edit_berita/(:any)'] = "berita/edit_berita/$1";
$route['update_berita'] = "berita/berita_edit/";
$route['edit_foto_berita'] = "berita/edit_foto_berita";
$route['news'] = "berita/lihat_berita";
$route['delete_berita/(:any)'] = "berita/delete_berita/$1";
$route['berita_delete'] = "berita/berita_delete/";
$route['berita_koperasi'] = "berita/berita_koperasi";
$route['berita_kop/(:any)'] = "berita/berita_kop/$1";
$route['berita_komunitas'] = "berita/berita_komunitas";
$route['berita_kom/(:any)'] = "berita/berita_kom/$1";


$route['compro/(:any)'] = "compro/compro_data/$1";
$route['add_compro'] = "compro/add_compro";
$route['tambah_compro'] = "compro/tambah_compro";
$route['lihat_compro/(:any)'] = "compro/compro_lihat/$1";
$route['edit_compro/(:any)'] = "compro/edit_compro/$1";
$route['update_compro'] = "compro/compro_edit/";
$route['edit_foto_compro'] = "compro/edit_foto_compro";
$route['compro'] = "compro/lihat_compro";
$route['delete_compro/(:any)'] = "compro/delete_compro/$1";
$route['compro_delete'] = "compro/compro_delete/";
$route['compro_koperasi'] = "compro/compro_koperasi";
$route['compro_kop/(:any)'] = "compro/compro_kop/$1";
$route['compro_komunitas'] = "compro/compro_komunitas";
$route['compro_kom/(:any)'] = "compro/compro_kom/$1";



$route['event/(:any)'] = "event/event_data/$1";
$route['add_event'] = "event/add_event";
$route['tambah_event'] = "event/tambah_event";
$route['lihat_event/(:any)'] = "event/event_lihat/$1";
$route['edit_event/(:any)'] = "event/edit_event/$1";
$route['update_event'] = "event/event_edit/";
$route['edit_foto_event'] = "event/edit_foto_event";
$route['event_detail'] = "event/lihat_event";
$route['delete_event/(:any)'] = "event/delete_event/$1";
$route['event_delete'] = "event/event_delete/";
$route['event_koperasi'] = "event/event_koperasi";
$route['event_kop/(:any)'] = "event/event_kop/$1";
$route['event_komunitas'] = "event/event_komunitas";
$route['event_kom/(:any)'] = "event/event_kom/$1";



$route['agenda/(:any)'] = "agenda/agenda_data/$1";
$route['add_agenda'] = "agenda/add_agenda";
$route['tambah_agenda'] = "agenda/tambah_agenda";
$route['lihat_agenda/(:any)'] = "agenda/agenda_lihat/$1";
$route['edit_agenda/(:any)'] = "agenda/edit_agenda/$1";
$route['update_agenda'] = "agenda/agenda_edit/";
$route['edit_foto_agenda'] = "agenda/edit_foto_agenda";
$route['agenda_detail'] = "agenda/lihat_agenda";
$route['delete_agenda/(:any)'] = "agenda/delete_agenda/$1";
$route['agenda_delete'] = "agenda/agenda_delete/";
$route['agenda_koperasi'] = "agenda/agenda_koperasi";
$route['agenda_kop/(:any)'] = "agenda/agenda_kop/$1";
$route['agenda_komunitas'] = "agenda/agenda_komunitas";
$route['agenda_kom/(:any)'] = "agenda/agenda_kom/$1";


$route['majalah/(:any)'] = "majalah/majalah_data/$1";
$route['majalah_koperasi'] = "majalah/majalah_koperasi";
$route['majalah_kop/(:any)'] = "majalah/majalah_kop/$1";
$route['majalah_komunitas'] = "majalah/majalah_komunitas";
$route['majalah_kom/(:any)'] = "majalah/majalah_kom/$1";
$route['add_majalah'] = "majalah/add_majalah";
$route['tambah_majalah'] = "majalah/tambah_majalah";
$route['lihat_majalah/(:any)'] = "majalah/majalah_lihat/$1";
$route['majalah_detail'] = "majalah/lihat_majalah";
$route['delete_majalah/(:any)'] = "majalah/delete_majalah/$1";
$route['majalah_delete'] = "majalah/majalah_delete/";


$route['datacell'] = 'datacell/datacell_data';
$route['edit_datacell/(:any)'] = 'datacell/edit_datacell/$1';
$route['update_datacell'] = 'datacell/update_datacell';
$route['log_datacell/(:any)'] = 'datacell/log_datacell/$1';
$route['data_datacell'] = 'datacell/data_log_datacell';


$route['transaksi_gerai'] = 'transaksi_gerai/data_transaksi_gerai';
$route['transaksi/commerce'] = 'transaksi_commerce/list_transaksi';
$route['transaksi/gerai'] = 'transaksi_gerai/list_transaksi';
$route['transaksi/get_koperasi'] = 'transaksi_commerce/get_koperasi';
$route['get_detail_transaksi/(:any)'] = 'transaksi_commerce/get_detail_transaksi/$1';
$route['detail_transaksi'] = 'transaksi_commerce/detail_transaksi';



$route['saldo/(:any)'] = 'dashboard/log_saldo_transaksi/$1';
$route['log'] = 'log_transaksi/data_anggota';
$route['log/(:any)'] = 'log_transaksi/cek_log';
$route['log_view'] = 'log_transaksi/lihat_log';

//ROUTE PRODUK KOPERASI
$route['mykopproduk'] = 'produk/produk_data_kop';
$route['mymemproduk'] = 'produk/produk_data_mem';

//ROUTE MINIBANKING
$route['nasabah/:any/tabungan/:any'] = 'rekening/log_tabungan';
$route['nasabah/:any/virtual/:any'] = 'rekening/log_virtual';
$route['nasabah/:any/loyalti/:any'] = 'rekening/log_loyalti';
$route['nasabah/:any/loyalti'] = 'rekening/log_loyalti';
$route['nasabah/:any'] = 'rekening/detail';
$route['nasabah'] = 'rekening/detail';
$route['cek_saldo'] = 'rekening/cek_saldo';
$route['transfer_saldo/tabungan_virtual'] = 'rekening/transfer_saldo';
$route['transfer_saldo/virtual_tabungan'] = 'rekening/transfer_saldo';
$route['transfer_saldo'] = 'rekening/transfer_saldo';
$route['setor_tunai'] = 'rekening/setor_tunai';
$route['tarik_tunai'] = 'rekening/tarik_tunai';
$route['setor_tunai/success'] = 'rekening/setor_tunai_info';
$route['tarik_tunai/success'] = 'rekening/tarik_tunai_info';
$route['buka_rekening'] = 'rekening/register';
$route['ubah_status_rekening'] = 'rekening/ubah_status';
$route['rekening_favorit'] = 'rekening/rekening_favorit';
$route['profit_sharing'] = 'rekening/profit_sharing';
$route['buat_rekening_non_member'] = 'rekening/register_non_member';
$route['rekening_non_member'] = 'rekening/rekening_non_member';
$route['rekening_deposito'] = 'rekening/rekening_deposito';
$route['buat_rekening_deposito'] = 'rekening/register_rekening_deposito';
$route['buat_rekening_deposito/success'] = 'rekening/register_rekening_deposito_info';
$route['rekening_pinjaman'] = 'rekening/rekening_pinjaman';
$route['buat_rekening_pinjaman'] = 'rekening/register_rekening_pinjaman';
$route['buat_rekening_pinjaman/success'] = 'rekening/register_rekening_pinjaman_info';
$route['bayar_angsuran'] = 'rekening/pembayaran_angsuran';
$route['bayar_angsuran/success'] = 'rekening/pembayaran_angsuran_info';
$route['rekening_kredit_cicilan'] = 'rekening/rekening_kredit_cicilan';
$route['buat_rekening_kredit_cicilan'] = 'rekening/register_rekening_kredit_cicilan';
$route['buat_rekening_kredit_cicilan/success'] = 'rekening/register_rekening_kredit_cicilan_info';
$route['bayar_angsuran_kredit_cicilan'] = 'rekening/pembayaran_angsuran_kredit_cicilan';
$route['bayar_angsuran_kredit_cicilan/success'] = 'rekening/pembayaran_angsuran_kredit_cicilan_info';
$route['nasabah/:any/pinjaman/:any'] = 'rekening/log_pinjaman';
$route['nasabah/:any/kredit/:any'] = 'rekening/log_kredit_cicilan';
$route['profit_koperasi/:num'] = 'rekening/profit_koperasi';
$route['share_profit_smidumay'] = 'rekening/profit_smidumay';
$route['share_profit_koperasi'] = 'rekening/profit_koperasi';

//ROUTE VENDOR
$route['gerai_vendor'] = 'gerai/h2h/vendor';
$route['gerai_operator'] = 'gerai/h2h/operator';
$route['gerai_kategori_produk'] = 'gerai/h2h/produk';
$route['gerai_vendor_produk'] = 'gerai/h2h/vendor_produk';


// ROUTE STORE
$route['store'] = 'store/koperasi';

// ROUTE GERAI
$route['geraimuslim'] = 'gerai/gerai_main';
$route['gerai'] 	  = 'gerai/gerai_main';


//ROUTE COMPRO
$route['services'] 	= 'home/services';
$route['faq'] 		= 'home/faq';
$route['contact'] 	= 'home/contact';
$route['partners'] 	= 'home/partners';
$route['about'] 	= 'home/aboutus';
$route['agenda'] 	= 'home/agenda_home';
$route['detail_agenda/(:any)'] = 'home/agenda_detail';
$route['news'] 			= 'home/news';
$route['emag'] 			= 'home/emag';
$route['emag/(:any)'] 	= 'home/emag_detail';
$route['news/(:any)'] 	= 'home/news_detail';
$route['detail_event/(:any)'] 	= 'home/event_detail';




$route['chart/jumlah_transaksi'] = "chart_report/jumlah_transaksi";
$route['chart/total_transaksi']  = "chart_report/total_transaksi";
$route['chart/total_transaksi/(:any)']  = "chart_report/total_transaksi/$1";

$route['chart/anggota'] = "chart_report/chart_anggota";
$route['chart/anggota/(:any)'] = "chart_report/chart_anggota/$1";
$route['get_anggota_kabupaten/(:any)']  = "chart_report/get_anggota_kabupaten/$1";
$route['anggota_kabupaten/(:any)']  = "chart_report/anggota_kabupaten/$1";
$route['anggota_kabupaten']  = "chart_report/anggota_kabupaten";



$route['get_kabupaten/(:any)']  = "chart_report/get_kabupaten/$1";
$route['total_transaksi_kabupaten/(:any)']  = "chart_report/total_transaksi_kabupaten/$1";
$route['total_transaksi_kabupaten']  = "chart_report/total_transaksi_kabupaten";

$route['get_produk_provinsi/(:any)'] = "chart_report/get_produk_provinsi/$1";
$route['produk_provinsi'] = "chart_report/produk_provinsi";
$route['produk_provinsi/(:num)'] = "chart_report/produk_provinsi/$1";




$route['report/product_sell/(:any)'] = "chart_report/product_table/$1";
$route['report/product_sell'] = "chart_report/product_table";


$route['add_peruntukan/(:any)'] = 'produk/tambah_peruntukan/$1';
$route['peruntukan'] = 'produk/peruntukan';
$route['update_peruntukan/(:any)'] = 'produk/edit_peruntukan/$1';


$route['polis'] = "polis/data_polis";
$route['update_polis'] = "polis/update_polis";
$route['edit_polis/(:any)'] = "polis/edit_polis/$1";
$route['add_polis'] = "polis/add_polis";
$route['logo_polis'] = "polis/upload_logo_polis";
$route['update_logo_polis'] = "polis/update_logo_polis";
$route['delete_polis/(:any)'] = "polis/delete_polis/$1";
$route['hapus_polis'] = "polis/hapus_polis";


$route['report_data_produk'] = "report/data_produk";
$route['report_produk_admin'] = "report/data_produk_admin";
$route['report_produk_anggota'] = "report/data_produk_anggota";
$route['report_transaksi_pln'] = "report/data_transaksi_pln";
$route['report_transaksi_pulsa'] = "report/data_transaksi_pulsa";
$route['report_penjualan_koperasi'] = "report/data_penjualan_koperasi";
$route['report_penjualan_admin'] = "report/data_penjualan_admin";
$route['report_penjualan_anggota'] = "report/data_penjualan_anggota";


$route['report_pendapatan_gerai'] = "report/data_pendapatan_gerai";
$route['report_pendapatan_produk'] = "report/data_pendapatan_dari_produk";
$route['report_pengiriman_barang'] = "report/data_pengiriman_produk";


$route['report_data_koperasi'] = "report/data_koperasi";
$route['report_data_komunitas'] = "report/data_komunitas";
