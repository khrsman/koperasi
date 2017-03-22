<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SQL_Menu extends CI_Controller {

	public function index()
	{
		$query = $this->db->query("INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `class`, `position`, `group_id`, `image`, `auth_visibility`) VALUES (146, 96, 'List Data Produk', 'report_data_produk', NULL, 1, 2, NULL, '[1,2]'),
(147, 96, 'Data Produk Admin', 'report_produk_admin', NULL, 2, 2, NULL, '[1]'),
(148, 96, 'Data Produk Anggota', 'report_produk_anggota', NULL, 3, 2, NULL, '[1,2]'),
(149, 96, 'Laporan Penjualan PLN', 'report_transaksi_pln', NULL, 4, 2, NULL, '[1]'),
(150, 96, 'Laporan Penjualan Pulsa', 'report_transaksi_pulsa', NULL, 5, 2, NULL, '[1]'),
(151, 96, 'Laporan Penjualan Produk Koperasi', 'report_penjualan_koperasi', NULL, 7, 2, NULL, '[1,2]'),
(152, 96, 'Laporan Penjualan Produk Admin', 'report_penjualan_admin', NULL, 6, 2, NULL, '[1]'),
(153, 96, 'Laporan Penjualan Produk Anggota', 'report_penjualan_anggota', NULL, 8, 2, NULL, '[1,2,3]'),
(154, 96, 'Laporan Pendapatan dari Gerai', 'report_pendapatan_gerai', NULL, 9, 2, NULL, '[1]'),
(155, 96, 'Pendapatan Koperasi dari Produk', 'report_pendapatan_produk', NULL, 10, 2, NULL, '[1,2]'),
(156, 96, 'Laporan Pengiriman Barang', 'report_pengiriman_barang', NULL, 11, 2, NULL, '[1,2]'),
(157, 96, 'Laporan Data Koperasi', 'report_data_koperasi', NULL, 12, 2, NULL, '[1]'),
(158, 96, 'Laporan Data Komunitas', 'report_data_komunitas', NULL, 13, 2, NULL, '[1]')");

		if($query){
			echo "SUCCESS";
		}
		else {
			echo "ERROR";
		}
	}

}

/* End of file SQL_Menu.php */
/* Location: ./application/controllers/SQL_Menu.php */