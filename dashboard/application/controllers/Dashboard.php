<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('id_user')) == NULL)
        {
            redirect(SMIDUMAY, 'refresh');
        }
        $this->load->model('admin_mod');
        $this->load->model('anggota_mod');
        $this->load->model('anggota_komunitas_mod');
        $this->load->model('koperasi_mod');
        $this->load->model('pekerjaan_mod');
        $this->load->model('komunitas_mod');
        $this->load->model('compro_model');
        $this->load->model('alamat_mod');
        $this->load->model('produk_mod');
        $this->load->model('alamat_mod');
        $this->load->model('rekening_virtual_mod');
        $this->load->model('rekening_tabungan_mod');
        $this->load->model('rekening_loyalty_mod');
        $this->load->model('chart_mod');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger style="padding: 6px 12px;height:34px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
        // $this->session->set_userdata('id', $this->session->userdata('id_user'));

    }
    public function index()
    {
        // echo $this->session->userdata('level');
        // die();
        if ($this->session->userdata('level') == "1")
        {
            $data['produk'] = $this->produk_mod->get_all_produk()->num_rows();
            $data['koperasi_induk'] = count($this->koperasi_mod->get_all_koperasi_induk() ['data']);
            $data['koperasi_cabang'] = count($this->koperasi_mod->get_all_koperasi_cabang() ['data']);
            $data['anggota_koperasi'] = count($this->anggota_mod->get_all_anggota() ['data']);
            $data['anggota_komunitas'] = $this->anggota_komunitas_mod->get_all_anggota_komunitas()->num_rows();
            $data['komunitas'] = $this->komunitas_mod->get_all_komunitas()->num_rows();
            $data['provinsi'] = $this->alamat_mod->get_nama_provinsi();
            $data['last_login_user'] = $this->anggota_mod->last_login()->result();

            $this->load->library('pagination');

            $config['base_url'] = site_url('home');
            $config['total_rows'] = $this->chart_mod->count_koperasi();
            $config['per_page'] = 10;
            $config['uri_segment'] = 2;
            $config['num_links'] = 5;

            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tagl_close']  = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tagl_close']  = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tagl_close']  = "</li>";

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data['koperasi_anggota'] = $this->chart_mod->anggota_koperasi_data($config['per_page'], $page);

            $data['pagination'] = $this->pagination->create_links();



        }
        else if ($this->session->userdata('level') == "2")
        {
            $data['produk'] = $this->produk_mod->get_all_produk_milik_kop()->num_rows();

            //BOBBY UPDATE'S
            // $data['koperasi'] = $this->koperasi_mod->get_all_cabang_koperasi()->num_rows();
            $this->load->library('pagination');
            $config['base_url'] = site_url('home');
            $config['total_rows'] = $this->chart_mod->count_koperasi();
            $config['per_page'] = 10;
            $config['uri_segment'] = 2;
            $config['num_links'] = 5;

            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tagl_close']  = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tagl_close']  = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tagl_close']  = "</li>";

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data['koperasi_anggota'] = $this->chart_mod->anggota_koperasi_data($config['per_page'], $page);

            $data['pagination'] = $this->pagination->create_links();
            $data['provinsi'] = $this->alamat_mod->get_nama_provinsi_koperasi();
            $data['koperasi'] = count($this->koperasi_mod->get_all_koperasi_cabang() ['data']);
            $data['anggota'] = count($this->anggota_mod->get_all_anggota() ['data']);
            $data['last_login_user'] = $this->anggota_mod->last_login()->result();

        }
        else if ($this->session->userdata('level') == "3")
        {
            //cek rekening virtual
            if ($this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota())
            {
                if($this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array()['saldo'] != NULL AND $this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array()['saldo'] != "" AND !empty($this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array()['saldo'])){
                    $data['saldo_virtual'] = $this->rekening_virtual_mod->get_saldo_rekening_virtual_anggota()->row_array();
                }
                else {
                    $data['saldo_virtual']['saldo'] = "0";
                }
            }
            else
            {
                $data['saldo_virtual']['saldo'] = "0";
            }

            //cek rekening tabungan
            if ($this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota())
            {
                if($this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array()['saldo'] != NULL AND $this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array()['saldo'] != "" AND !empty($this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array()['saldo'])){
                    $data['saldo_tabungan'] = $this->rekening_tabungan_mod->get_saldo_rekening_tabungan_anggota()->row_array();
                }
                else {
                    $data['saldo_tabungan']['saldo'] = "0";
                }
            }
            else
            {
                $data['saldo_tabungan']['saldo'] = "0";
            }

            //cek rekening loyalty
            if ($this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota())
            {
                if($this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result() != NULL AND $this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result() != "" AND !empty($this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result())){
                    $data['saldo_loyalti'] = $this->rekening_loyalty_mod->get_saldo_rekening_loyalty_anggota()->result();
                }
                else{
                    $data['saldo_loyalti'] = array(
                                                  (object) array("jenis_rekening" => "CASH", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "INSURANCE", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "ROYALTY", "saldo"=> "0.00"),
                                              );
                }
            }
            else
            {
                $data['saldo_loyalti'] = array(
                                                  (object) array("jenis_rekening" => "CASH", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "INSURANCE", "saldo"=> "0.00"),
                                                  (object) array("jenis_rekening" => "ROYALTY", "saldo"=> "0.00"),
                                              );
            }

            $data['produk'] = $this->produk_mod->get_all_produk_milik_mem()->num_rows();
        }

        else if ($this->session->userdata('level') == "4")
        {
            $data['anggota_komunitas'] = '';
            $data['berita'] = '';
            $data['event'] = '';
            $data['last_login_user'] = $this->anggota_mod->last_login()->result();
        };

        if($this->compro_model->get_logo_cover()){
            $data['logo_cover']        = $this->compro_model->get_logo_cover()->row_array();
            $this->session->set_userdata('');
        }
        else {
            $cover = array(
                'foto'          => "smi-logo.png",
                'cover_foto'    => "" // <======== INI DIISI APA
                );
            $data['logo_cover'] = $cover;
        }


        $data['title'] = "Dashboard";
        $data['user'] = $this->session->userdata('nama');
        $this->load->view('dashboard', $data);
    }
    function edit_profile()
    {
        $data['title'] = "Profile";
        $data['provinsi'] = $this->alamat_mod->get_provinsi();
        $data['alamat'] = $this->alamat_mod->get_alamat_by_id_and_user()->result();
        $data['no'] = 1;

        if ($this->session->userdata('level') == 1)
        {
            if ($this->admin_mod->get_admin_by_id($this->session->userdata('id_user'))->num_rows() > 0)
            {
                $data['user'] = $this->admin_mod->get_admin_by_id($this->session->userdata('id_user'))->row_array();
                $this->session->set_userdata('id', $this->session->userdata('id_user'));
                $data['text_upload_photo'] = "Upload Foto Profil";
                $this->load->view('edit_profil/edit_profile_admin', $data);
            }
            else
            {
                redirect(base_url() . 'not_found', 'refresh');
            }
        }
        else if ($this->session->userdata('level') == 2)
        {
            if ($this->koperasi_mod->get_koperasi_by_id_profile($this->session->userdata('id_user'))->num_rows() > 0)
            {
                $data['user'] = $this->koperasi_mod->get_koperasi_by_id_profile($this->session->userdata('id_user'))->row_array();
                $data['data_kop'] = $this->koperasi_mod->get_id_nama()->result();
                $data['text_upload_photo'] = "Upload Logo Koperasi";
                $this->session->set_userdata('id', $this->session->userdata('id_user'));
                $this->load->view('edit_profil/edit_profile_koperasi', $data);
            }
            else
            {
                redirect(base_url() . 'not_found', 'refresh');
            }
        }

        else if ($this->session->userdata('level') == 3)
        {
            if ($this->anggota_mod->get_anggota_by_id($this->session->userdata('id_user'))->num_rows() > 0)
            {
                $data['user'] = $this->anggota_mod->get_anggota_by_id($this->session->userdata('id_user'))->row_array();
                $data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
                $data['data_kop'] = $this->koperasi_mod->get_id_nama()->result();
                $data['text_upload_photo'] = "Upload Foto Profil";
                $this->session->set_userdata('id', $this->session->userdata('id_user'));
                $this->load->view('edit_profil/edit_profile_anggota_koperasi', $data);
            }
            else
            {
                redirect(base_url() . 'not_found', 'refresh');
            }
        }
        else if ($this->session->userdata('level') == 4)
        {
            if ($this->komunitas_mod->get_komunitas_by_id_profile($this->session->userdata('id_user'))->num_rows() > 0)
            {
                $data['user'] = $this->komunitas_mod->get_komunitas_by_id_profile($this->session->userdata('id_user'))->row_array();
                $data['text_upload_photo'] = "Upload Logo Komunitas";
                $this->session->set_userdata('id', $this->session->userdata('id_user'));
                $this->load->view('edit_profil/edit_profile_komunitas', $data);
            }
            else
            {
                redirect(base_url() . 'not_found', 'refresh');
            }

        }

        else if ($this->session->userdata('level') == 5)
        {
            if ($this->anggota_mod->get_anggota_by_id($this->session->userdata('id_user'))->num_rows() > 0)
            {
                $data['user'] = $this->anggota_komunitas_mod->get_anggota_komunitas_by_id($this->session->userdata('id_user'))->row_array();
                $data['text_upload_photo'] = "Upload Foto Profil";
                $data['pekerjaan'] = $this->pekerjaan_mod->get_all_pekerjaan()->result();
                $data['data_kom'] = $this->komunitas_mod->get_id_nama()->result();
                $this->session->set_userdata('id', $this->session->userdata('id_user'));
                $this->load->view('edit_profile_anggota_komunitas', $data);
            }
            else
            {
                redirect(base_url() . 'not_found', 'refresh');
            }
        }
    }
    function upload_photo_profile()
    {
        $config['upload_path'] = 'assets/images/user';
        $config['allowed_types'] = 'jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo'))
        {
            $this->session->set_flashdata('msg', $this->upload->display_errors());
            redirect(base_url() . 'profile/', 'refresh');
        }
        else
        {
            $this->session->set_userdata('error', "");
            $this->session->set_flashdata('msg', 'Photo profil berhasil diubah');
            if (($this->session->userdata('foto_user')))
            {
                unlink(FCPATH . "assets/images/user/" . $this->session->userdata('foto_user'));
            }

            if ($this->session->userdata('level') == "1")
            {
                $this->admin_mod->upload_profile($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_user', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }
            else if ($this->session->userdata('level') == "2")
            {
                $this->koperasi_mod->upload_profile($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_user', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }
            else if ($this->session->userdata('level') == "3")
            {
                $this->anggota_mod->upload_profile($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_user', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }
            else if ($this->session->userdata('level') == "4")
            {
                $this->komunitas_mod->upload_profile($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_user', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }
            else if ($this->session->userdata('level') == "5")
            {
                $this->anggota_komunitas_mod->upload_profile($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_user', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }

        }
    }

    function upload_photo_cover()
    {
        $config['upload_path'] = 'assets/images/cover';
        $config['allowed_types'] = 'jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo'))
        {
            $this->session->set_flashdata('msg', $this->upload->display_errors());
            redirect(base_url() . 'profile/', 'refresh');
        }
        else
        {
            $this->session->set_userdata('error', "");
            $this->session->set_flashdata('msg', 'Cover berhasil diubah');

            if (($this->session->userdata('foto_cover')))
            {
                unlink(FCPATH . "assets/images/cover/" . $this->session->userdata('foto_cover'));
            }

            if ($this->session->userdata('level') == "2")
            {
                $this->koperasi_mod->upload_cover($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_cover', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }
            else if ($this->session->userdata('level') == "4")
            {
                $this->komunitas_mod->upload_cover($this->upload->data() ['file_name']);
                $this->session->set_userdata('foto_cover', $this->upload->data() ['file_name']);
                redirect(base_url() . 'profile', 'refresh');
            }

        }
    }

    function select_kabupaten($id_provinsi)
    {
        $kab = $this->alamat_mod->get_kabupaten($id_provinsi);
        echo "<option value=''>Pilih Kota/Kab</option>";
        foreach ($kab as $k)
        {
            echo "<option value='{$k->id_kabupaten}'>{$k->nama}</option>";
        }
    }

    function select_kecamatan()
    {
        $kec = $this->alamat_mod->get_kecamatan($id_kabupaten);
        echo "<option value=''>Pilih Kecamatan</option>";
        foreach ($kec as $k)
        {
            echo "<option value='{$k->id_kecamatan}'>{$k->nama}</option>";
        }
    }

    function select_kelurahan()
    {
        $kel = $this->alamat_mod->get_kelurahan($id_kecamtan);
        echo "<option value=''>Pilih Kelurahan</option>";
        foreach ($kab as $k)
        {
            echo "<option value='{$k->id_kelurahan}'>{$k->nama}</option>";
        }
    }

    function add_alamat()
    {
        $this->alamat_mod->add_alamat($this->session->userdata('id_user'));
        $this->session->set_flashdata('msg', 'Alamat Berhasil Ditambahkan');
        redirect(base_url() . 'profile', 'refresh');
    }

    function set_default()
    {
        $this->session->set_flashdata('id_alamat', $this->uri->rsegment(3));
        redirect(base_url() . 'set_default_alamat', 'refresh');
    }
    function set_default_alamat()
    {
        if ($this->alamat_mod->get_alamat($this->session->flashdata('id_alamat'))->num_rows() > 0)
        {
            $this->alamat_mod->set_default($this->session->flashdata('id_alamat'), $this->session->userdata('id_user'));
            $this->session->set_flashdata('msg', 'Alamat Default Berhasil Diubah');
            redirect(base_url() . 'profile', 'refresh');
        }
        else
        {
            redirect(base_url() . 'not_found', 'refresh');
        }
    }

    function hapus_alamat()
    {
        $this->session->set_flashdata('id_alamat', $this->uri->rsegment(3));
        redirect(base_url() . 'hapus_alamat', 'refresh');
    }

    function delete_alamat()
    {
        if ($this->alamat_mod->get_alamat($this->session->flashdata('id_alamat'))->num_rows() > 0)
        {
            $this->alamat_mod->delete_alamat($this->session->flashdata('id_alamat'));
            $this->session->set_flashdata('msg', 'Alamat Berhasil Dihapus');
            redirect(base_url() . 'profile', 'refresh');
        }
        else
        {
            redirect(base_url() . 'not_found', 'refresh');
        }
    }

    function log_saldo_transaksi()
    {
        if ($this->uri->segment(2) == "virtual")
        {
            if ($this->rekening_virtual_mod->get_log_virtual_anggota()->num_rows() > 0)
            {
                $data['saldo'] = $this->rekening_virtual_mod->get_log_virtual_anggota();
            }
            else
            {
                $data['saldo'] = NULL;
            }
        }
        else if ($this->uri->segment(2) == "tabungan")
        {
            if ($this->rekening_tabungan_mod->get_log_tabungan_anggota()->num_rows() > 0)
            {
                $data['saldo'] = $this->rekening_tabungan_mod->get_log_tabungan_anggota();
            }
            else
            {
                $data['saldo'] = NULL;
            }
        }
        else if ($this->uri->segment(2) == "loyalty")
        {
            if ($this->rekening_loyalty_mod->get_log_loyalty_anggota()->num_rows() > 0)
            {
                $data['saldo'] = $this->rekening_loyalty_mod->get_log_loyalty_anggota();
            }
            else
            {
                $data['saldo'] = NULL;
            }
        }

        $data['no'] = 1;
        $data['title'] = "Saldo " . ucwords($this->uri->segment(3));
        $this->load->view('log_transaksi/log_transaksi_saldo_anggota', $data);
    }

    function edit_basic_profile()
    {

        //------------------------------------------ JIKA ADMIN ------------------------------------------------------------------
        if ($this->session->userdata('level') == '1'):
            $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
            $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
            $this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->admin_mod->update_basic($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Profil berhasil diubah');
                $this->session->set_userdata('nama', $this->input->post('nama_depan') . "&nbsp;" . $this->input->post('nama_belakang'));
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ADMIN -------------------------------------------------------------------


        //------------------------------------------ JIKA KOPERASI ---------------------------------------------------------------
        if ($this->session->userdata('level') == '2'):
            $this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
            $this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
            $this->form_validation->set_rules('legal', 'Legal', 'xss_clean');
            $this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
            $this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->koperasi_mod->update_basic($this->session->userdata('koperasi'));
                $this->session->set_flashdata('msg', 'Profil berhasil diubah');
                $this->session->set_userdata('nama', $this->input->post('nama'));
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;

        //----------------------------------------END OF KOPERASI ----------------------------------------------------------------
        //------------------------------------------ JIKA ANGGOTA KOPERASI -------------------------------------------------------
        if ($this->session->userdata('level') == '3'):
            $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
            $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
            $this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'xss_clean|required');
            $this->form_validation->set_rules('noktp', 'Nomor KTP', 'xss_clean|required|numeric|min_length[10]|max_length[20]');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'xss_clean');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'min_length[10]');
            $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->anggota_mod->update_basic($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Profil berhasil diubah');
                $this->session->set_userdata('nama', $this->input->post('nama_depan') . "&nbsp;" . $this->input->post('nama_belakang'));
                redirect(base_url() . 'profile', 'refresh');
            }

        endif;
        //----------------------------------------END OF ANGGOTA KOPERASI --------------------------------------------------------
        //------------------------------------------ JIKA KOMUNITAS --------------------------------------------------------------
        if ($this->session->userdata('level') == '4'):
            $this->form_validation->set_rules('nama', 'Nama Koperasi', 'required|xss_clean');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
            $this->form_validation->set_rules('berdiri', 'Tanggal Berdiri', 'required|xss_clean');
            $this->form_validation->set_rules('ketua', 'Ketua Koperasi', 'required|xss_clean');
            $this->form_validation->set_rules('ketua_telp', 'No Telepon Ketua Koperasi', 'numeric|required|xss_clean');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->komunitas_mod->update_basic($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Profil berhasil diubah');
                $this->session->set_userdata('nama', $this->input->post('nama'));
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;

        //----------------------------------------END OF KOMUNITAS ---------------------------------------------------------------
        //------------------------------------------ JIKA ANGGOTA KOMUNITAS -----------------------------------------------------
        if ($this->session->userdata('level') == '5'):
            $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|xss_clean');
            $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'xss_clean');
            $this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'xss_clean|required');
            $this->form_validation->set_rules('noktp', 'Nomor KTP', 'xss_clean|required|numeric|min_length[10]|max_length[20]');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'alpha|xss_clean');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'min_length[10]');
            $this->form_validation->set_rules('Alamat', 'Jenis Kelamin', 'xss_clean|required');
            $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->anggota_mod->update_basic($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Profil berhasil diubah');
                $this->session->set_userdata('nama', $this->input->post('nama_depan') . "&nbsp;" . $this->input->post('nama_belakang'));
                redirect(base_url() . 'profile', 'refresh');
            }

        endif;
        //----------------------------------------END OF ANGGOTA KOMUNITAS ------------------------------------------------------



    }

    function update_password()
    {

        //------------------------------------------ JIKA ADMIN ------------------------------------------------------------------
        if ($this->session->userdata('level') == '1'):

            $this->form_validation->set_rules('old_password', 'Password Lama', 'required|min_length[5]|callback_cek_password_lama');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|min_length[5]|matches[new_password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->admin_mod->update_password($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Password berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ADMIN -------------------------------------------------------------------
        //------------------------------------------ JIKA KOPERASI ---------------------------------------------------------------
        if ($this->session->userdata('level') == '2'):

            $this->form_validation->set_rules('old_password', 'Password Lama', 'required|min_length[5]|callback_cek_password_lama');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|min_length[5]|matches[new_password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->koperasi_mod->update_password($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Password berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF KOPERASI ----------------------------------------------------------------
        //------------------------------------------ JIKA ANGGOTA KOPERASI -------------------------------------------------------
        if ($this->session->userdata('level') == '3'):

            $this->form_validation->set_rules('old_password', 'Password Lama', 'required|min_length[5]|callback_cek_password_lama');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|min_length[5]|matches[new_password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->anggota_mod->update_password();
                $this->session->set_flashdata('msg', 'Password berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ANGGOTA KOPERASI --------------------------------------------------------
        //------------------------------------------ JIKA KOMUNITAS -------------------------------------------------------------
        if ($this->session->userdata('level') == '4'):

            $this->form_validation->set_rules('old_password', 'Password Lama', 'required|min_length[5]|callback_cek_password_lama');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|min_length[5]|matches[new_password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->komunitas_mod->update_password();
                $this->session->set_flashdata('msg', 'Password berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF KOMUNITAS --------------------------------------------------------------
        //------------------------------------------ JIKA ANGGOTA KOMUNITAS ------------------------------------------------------
        if ($this->session->userdata('level') == '5'):

            $this->form_validation->set_rules('old_password', 'Password Lama', 'required|min_length[5]|callback_cek_password_lama');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|min_length[5]|matches[new_password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->anggota_mod->update_password();
                $this->session->set_flashdata('msg', 'Password berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ANGGOTA KOMUNITAS ------------------------------------------------------

    }

    function update_contact()
    {

        //------------------------------------------ JIKA ADMIN ------------------------------------------------------------------
        if ($this->session->userdata('level') == '1'):

            $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
            $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->admin_mod->update_contact($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Kontak berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ADMIN -------------------------------------------------------------------
        //------------------------------------------ JIKA KOPERASI ---------------------------------------------------------------
        if ($this->session->userdata('level') == '2'):

            $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
            $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->koperasi_mod->update_contact($this->session->userdata('koperasi'));
                $this->session->set_flashdata('msg', 'Kontak berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF KOPERASI ----------------------------------------------------------------
        //------------------------------------------ JIKA ANGGOTA KOPERASI -------------------------------------------------------
        if ($this->session->userdata('level') == '3'):

            $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
            $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->anggota_mod->update_contact($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Kontak berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ANGGOTA KOPERASI --------------------------------------------------------
        //------------------------------------------ JIKA KOMUNITAS -------------------------------------------------------------
        if ($this->session->userdata('level') == '4'):

            $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
            $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->komunitas_mod->update_contact($this->session->userdata('koperasi'));
                $this->session->set_flashdata('msg', 'Kontak berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF KOMUNITAS --------------------------------------------------------------
        //------------------------------------------ JIKA ANGGOTA KOMUNITAS ----------------------------------------------------
        if ($this->session->userdata('level') == '5'):

            $this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
            $this->form_validation->set_rules('telepon', 'Telepon', 'numeric|required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect(base_url() . 'profile', 'refresh');
            }
            else
            {
                $this->anggota_mod->update_contact($this->session->userdata('id_user'));
                $this->session->set_flashdata('msg', 'Kontak berhasil diubah');
                redirect(base_url() . 'profile', 'refresh');
            }
        endif;
        //----------------------------------------END OF ANGGOTA KOMUNITAS ------------------------------------------------------

    }

    function update_pin()
    {
        $this->form_validation->set_rules('old_pin', 'PIN Lama', 'numeric|required|min_length[6]|callback_cek_pin_lama');
        $this->form_validation->set_rules('new_pin', 'PIN Baru', 'numeric|required|min_length[6]');
        $this->form_validation->set_rules('confirm_pin', 'Konfirmasi PIN Baru', 'numeric|required|min_length[6]|matches[new_pin]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('validation_errors', validation_errors());
            redirect(base_url() . 'profile', 'refresh');
        }
        else
        {
            $this->anggota_mod->update_pin();
            $this->session->set_flashdata('msg', 'PIN berhasil diubah');
            redirect(base_url() . 'profile', 'refresh');
        }
    }

    function cek_pin_lama()
    {
        $pin = sha1(md5(strrev($this->input->post('old_pin'))));
        $cek = $this->anggota_mod->cek_pin($pin);

        if (!$cek)
        {
            $this->form_validation->set_message('cek_pin_lama', 'PIN lama yang anda masukan salah');
            return FALSE;
        }
        else
        {
            if ($cek->row_array() ['user_ver'] == $pin)
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('cek_pin_lama', 'PIN lama yang anda masukan salah');
                return FALSE;
            }
        }

    }

    function cek_password_lama()
    {
        $password = sha1(md5(strrev($this->input->post('old_password'))));
        $cek      = $this->admin_mod->cek_password($password);

        if (!$cek)
        {
            $this->form_validation->set_message('cek_password_lama', 'Password lama yang anda masukan salah');
            return FALSE;
        }
        else
        {
            if ($cek->row_array() ['password'] == $password)
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('cek_password_lama', 'Password lama yang anda masukan salah');
                return FALSE;
            }
        }

    }

}
