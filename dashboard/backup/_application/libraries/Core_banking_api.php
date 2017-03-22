<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Core_banking_api {

    protected $CI;    

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('core_banking_model');
    }

    function debit_virtual_account($id_user,$total_debit,$kode_transaksi,$jenis_transaksi){

        // CEK KODE TRANSAKSI
        $kode_transaksi_list = array('COMMERCE','GERAI');
        if (!in_array($kode_transaksi, $kode_transaksi_list)) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Kode Transaksi Tidak Tersedia.'
                );
            return $response;
        }

        // GET REKENING VIRTUAL BY ID USER
        $get_virtual    = $this->CI->core_banking_model->get_virtual_account_by_user($id_user);
        if ($get_virtual==FALSE) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'User tidak mempunyai Rekening Virtual'
                );
            return $response;
        }

        $virtual_account  = $get_virtual[0];
        
        // CEK APAKAH REKENING DIBLOKIR
        if ($virtual_account['status_rekening']!='ACTIVE') {
            switch ($virtual_account['status_rekening']) {
                case 'BLOCKED':
                    $response = array(
                        'status'    => FALSE,
                        'message'   => 'Saldo Tabungan Virtual anda terblokir. Silahkan hubungi admin.'
                        );
                    return $response;
                    break;
                
                case 'CLOSED':
                    $response = array(
                        'status'    => FALSE,
                        'message'   => 'Saldo Tabungan Virtual telah ditutup. Silahkan hubungi admin.'
                        );
                    return $response;
                    break;
                
                default:
                    $response = array(
                        'status'    => FALSE,
                        'message'   => 'Saldo Tabungan Virtual Tidak Aktif. Silahkan hubungi admin.'
                        );
                    return $response;
                    break;
            }
        }


        // CEK APAKAH SALDO CUKUP UNTUK DIDEBIT
        if ($virtual_account['saldo']<$total_debit) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Saldo Tabungan Virtual tidak mencukupi untuk didebit.'
                );
            return $response;
        }

        $beginning_balance = $virtual_account['saldo'];
        $ending_balance    = $beginning_balance-$total_debit;
        $now_date          = date('Y-m-d');
        $now_date_time     = date('Y-m-d H:i:s');
        $no_transaksi      = strtoupper(uniqid(rand().time()));

        // INSERT LOG TRANSAKSI
        $data_insert_log = array(
            'no_transaksi'      => $no_transaksi,
            'id_user'           => $virtual_account['id_user'],
            'kode_transaksi'    => $kode_transaksi,
            'tipe_transaksi'    => 'DEBET',
            'no_rekening_primary'    => $virtual_account['no_rekening_virtual'],
            'no_rekening_secondary'  => NULL,
            'tanggal_transaksi'      => $now_date_time,
            'nilai_transaksi'   => $total_debit,
            'saldo_awal'        => $beginning_balance,
            'saldo_akhir'       => $ending_balance,
            'jenis_transaksi'   => $jenis_transaksi,
            'jenis_account'     => 'VIRTUAL',
            'tanggal'   => date('d'),
            'bulan'     => date('m'),
            'tahun'     => date('Y'),
            'sumber_dana'       => 'VIRTUAL',
            'service_time'      => $now_date_time,
            'service_user'      => $virtual_account['id_user'],
            'service_action'    => 'INSERT',
            );

        $insert_log = $this->CI->core_banking_model->insert_log_transaksi($data_insert_log);
        if ($insert_log==FALSE) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Saldo Tabungan Virtual gagal didebit. Server Error: Insert Log.'
                );
            return $response;
        }


        // INSERT TRANSAKSI
        $data_insert_transaksi = array(
            'no_transaksi_rekening' => $no_transaksi,
            'id_user'           => $virtual_account['id_user'],
            'jenis_transaksi'   => 'PENARIKAN',
            'sumber_dana'       => 'VIRTUAL',
            'tujuan_dana'       => $kode_transaksi,
            'no_rekening_transaksi'    => $virtual_account['no_rekening_virtual'],
            'jumlah_dana'       => $total_debit,
            'tanggal_transaksi' => $now_date_time,
            'id_user'           => $id_user,
            'keterangan'        => $jenis_transaksi,
            'service_time'      => $now_date_time,
            'service_user'      => $virtual_account['id_user'],
            'service_action'    => 'INSERT',
            );

        $insert_transaksi = $this->CI->core_banking_model->insert_transaksi($data_insert_transaksi);
        if ($insert_transaksi==FALSE) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Saldo Tabungan Virtual gagal didebit. Server Error: Insert Transaksi.'
                );
            return $response;
        }


        // UPDATE SALDO REKENING VIRTUAL BY ID USER
        $data_update = array(
            'no_rekening_virtual'   => $virtual_account['no_rekening_virtual'],
            'id_user'   => $virtual_account['id_user'],
            'saldo'     => $ending_balance,
            'tanggal_transaksi_terakhir'   => $now_date,
            'service_time'      => $now_date_time,
            'service_action'    => 'UPDATE',
            'service_user'      => $id_user,
            );
        $update_virtual = $this->CI->core_banking_model->update_virtual_account($data_update);
        if ($update_virtual==FALSE) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Saldo Tabungan Virtual gagal didebit. Server Error: Update virtual account.'
                );
            return $response;
        }else{
            $response = array(
                'status'    => TRUE,
                'message'   => 'Saldo Tabungan Virtual Berhasil didebit. Sisa saldo adalah Rp. '.$ending_balance,
                'data'      => array(
                    'beginning_balance' => $beginning_balance,
                    'total_debit'       => $total_debit,
                    'ending_balance'    => $ending_balance,
                    )
                );
            return $response;
        }


    }




    function deposit_loyalty_account($id_user,$total_point,$sumber_dana,$jenis_transaksi){
        
        // CEK SUMBER DANA
        $sumber_dana_list = array('COMMERCE','GERAI');
        if (!in_array($sumber_dana, $sumber_dana_list)) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Sumber dana Tidak Tersedia.'
                );
            return $response;
        }

        // GET REKENING LOYALTI BY ID USER
        $get_loyalty    = $this->CI->core_banking_model->get_loyalty_account_by_user($id_user);
        if ($get_loyalty==FALSE) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'User tidak mempunyai Rekening Loyalty'
                );
            return $response;
        }




        $loyalty_point          = $this->count_loyalty_point($total_point);
        $data_update_loyalty    = $get_loyalty;
        $loyalty_account_not_active = array();

        foreach ($get_loyalty as $k => $v) {
            foreach ($loyalty_point as $i => $j) {
                if ($v['jenis_rekening']==$i) {
                    
                    // CEK APAKAH REKENING DIBLOKIR
                    if ($v['status_rekening']=='ACTIVE') {
                        
                        $beginning_balance = $v['saldo'];
                        $ending_balance    = $beginning_balance+$j;
                        $now_date          = date('Y-m-d');
                        $now_date_time     = date('Y-m-d H:i:s');
                        $no_transaksi      = strtoupper(uniqid(rand().time()));

                        // INSERT TRANSAKSI
                        $data_insert_transaksi = array(
                            'no_transaksi_rekening' => $no_transaksi,
                            'id_user'           => $v['id_user'],
                            'jenis_transaksi'   => 'SETORAN',
                            'sumber_dana'       => $sumber_dana,
                            'tujuan_dana'       => 'LOYALTI',
                            'no_rekening_transaksi'    => $v['no_rekening_loyalti'],
                            'jumlah_dana'       => $j,
                            'tanggal_transaksi' => $now_date_time,
                            'id_user'           => $id_user,
                            'keterangan'        => $jenis_transaksi,
                            'service_time'      => $now_date_time,
                            'service_user'      => $v['id_user'],
                            'service_action'    => 'INSERT',
                            );

                        $insert_transaksi = $this->CI->core_banking_model->insert_transaksi($data_insert_transaksi);
                        if ($insert_transaksi==FALSE) {
                            $response = array(
                                'status'    => FALSE,
                                'message'   => 'Saldo Rekening Loyalti gagal di-update. Server Error: Insert Transaksi.'
                                );
                            return $response;
                        }


                        // INSERT LOG TRANSAKSI
                        $data_insert_log = array(
                            'no_transaksi'      => $no_transaksi,
                            'id_user'           => $v['id_user'],
                            'kode_transaksi'    => 'REKENING',
                            'tipe_transaksi'    => 'KREDIT',
                            'no_rekening_primary'    => $v['no_rekening_loyalti'],
                            'no_rekening_secondary'  => NULL,
                            'tanggal_transaksi'      => $now_date_time,
                            'nilai_transaksi'   => $j,
                            'saldo_awal'        => $beginning_balance,
                            'saldo_akhir'       => $ending_balance,
                            'jenis_transaksi'   => $jenis_transaksi,
                            'jenis_account'     => 'LOYALTI',
                            'tanggal'   => date('d'),
                            'bulan'     => date('m'),
                            'tahun'     => date('Y'),
                            'sumber_dana'       => $sumber_dana,
                            'service_time'      => $now_date_time,
                            'service_user'      => $v['id_user'],
                            'service_action'    => 'INSERT',
                            );

                        $insert_log = $this->CI->core_banking_model->insert_log_transaksi($data_insert_log);
                        if ($insert_log==FALSE) {
                            $response = array(
                                'status'    => FALSE,
                                'message'   => 'Saldo Rekening Loyalti gagal di-update. Server Error: Insert Log.'
                                );
                            return $response;
                        }else{

                            // DATA UPDATE REKENING LOYALTI
                            $data_update_loyalty[$k]['saldo'] = $j+$get_loyalty[$k]['saldo'];
                            $data_update_loyalty[$k]['tanggal_transaksi_terakhir'] = date('Y-m-d');
                            $data_update_loyalty[$k]['service_user']    = $id_user;
                            $data_update_loyalty[$k]['service_time']    = date('Y-m-d H:i:s');
                            $data_update_loyalty[$k]['service_action']  = "UPDATE";
                        }

                    }else{
                        $loyalty_account_not_active[] = $v['jenis_rekening'];
                    }
                    // END CEK REKENING DIBLOKIR

                }
            }
        }

        // Generate loyalti not active message
        if (!empty($loyalty_account_not_active)) {
            $msg_loyalty_not_active ='';
            foreach ($loyalty_account_not_active as $k) {
                $msg_loyalty_not_active.= $k.',';
            }
            $msg_loyalty_not_active.= 'Tidak Aktif.';
        }else{
            $msg_loyalty_not_active = '';
        }


        // UPDATE BATCH LOYALTY
        $update_loyalty = $this->CI->core_banking_model->update_loyalty_account_batch($data_update_loyalty);
        if ($update_loyalty==FALSE) {
            $response = array(
                'status'    => FALSE,
                'message'   => 'Update Saldo Rekening Loyalty Gagal. Server Error: Update Batch'
                );
            return $response;
        }else{
            $response = array(
                'status'    => TRUE,
                'message'   => 'Update Saldo Rekening Loyalty Berhasil.'.$msg_loyalty_not_active,
                'data'      => $data_update_loyalty
                );
            return $response;
        }

    }



    function count_loyalty_point($total_point=0){
        $data['CASH']       = $total_point*40/100;
        $data['INSURANCE']  = $total_point*40/100;
        $data['REWARDS']    = $total_point*20/100;

        return $data;
    }




}