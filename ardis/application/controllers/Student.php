<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_students');
        $this->auth->restrict();
    }

    private static $title = "Siswa &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
    private static $table = 'students';
    private static $primaryKey = 's_id';

    public function index()
	{
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/student";
		$this->load->view('dashboard/index', $data);
	}

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 's_nisn', 'dt' => 's_nisn'),
                array('db' => 's_name', 'dt' => 's_name'),
                array('db' => 's_dob', 'dt' => 's_dob'),
                array('db' => 's_gender', 'dt' => 's_gender'),
                array('db' => 's_grade', 'dt' => 's_grade'),
                array('db' => 'm_id', 'dt' => 'm_id'),
                array('db' => 's_status', 'dt' => 's_status'),
                array(
                    'db' => 's_id',
                    'dt' => 'tindakan',
                    'formatter' => function($s_id) {
                        return '<a class="btn btn-warning btn-sm mb" href="'.site_url('student/print_data/'.$s_id).'" target="_blank" title="Cetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
                        <a class="btn btn-success btn-sm mb" href="'.site_url('student/view/'.$s_id).'">Lihat</a>
                        <a class="btn btn-info btn-sm mb" href="'.site_url('student/edit/'.$s_id).'">Ubah</a>
                        <a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('student/delete/'.$s_id).'" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a><a class="btn btn-default btn-sm mb" href="'.site_url('student/status/'.$s_id).'" onclick="return confirmDialogStatus();">Ubah Status</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN majors ON majors.m_id = students.s_mid";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "s_is_active = 'Aktif' AND s_is_deleted = 'FALSE'", $qjoin )
            );
        }
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('s_nisn', 'NISN', 'trim|required');
        $this->form_validation->set_rules('s_name', 'Nama Siswa', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('s_dob', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('s_gender', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('s_grade', 'Inisial Siswa', 'trim|required|max_length[3]');
        $this->form_validation->set_rules('s_mid', 'Program Keahlian', 'trim|required|max_length[4]');
        $this->form_validation->set_rules('s_yi', 'Tahun Masuk', 'trim|required|max_length[4]');
        $this->form_validation->set_rules('s_status', 'Status Data', 'trim|required');
        return $this->form_validation->run();
    }

    public function add()
    {
        $this->load->helper(['form', 'string', 'notification']);

        if ($this->validation()) {
            $s_nisn = $this->input->post('s_nisn', TRUE);
            $where = "s_nisn = '$s_nisn'";
            $data = $this->m_students->is_exist($where);

            if ($data['s_nisn'] === $this->input->post('s_nisn', TRUE)) {
                $this->session->set_flashdata('alert', error('NISN sudah ada sudah ada!'));
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else {
                $s_id = random_string('alnum', 10);

                $s_foto = $_FILES['s_foto']['name'];
                $s_kk = $_FILES['s_kk']['name'];
                $s_ktpa = $_FILES['s_ktpa']['name'];
                $s_ktpi = $_FILES['s_ktpi']['name'];
                $s_kips = $_FILES['s_kips']['name'];
                $s_sktm = $_FILES['s_sktm']['name'];
                $s_ijazah = $_FILES['s_ijazah']['name'];
                $s_skhun = $_FILES['s_skhun']['name'];

                $this->load->library('upload');

                if (!empty($s_foto)) {
                    $config['upload_path'] = './uploads/foto/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '1024';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_foto);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-foto.".$ext;
                    $foto = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_foto');
                }

                if (!empty($s_kk)) {
                    $config['upload_path'] = './uploads/kk/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_kk);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-kk.".$ext;
                    $kk = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_kk');
                }

                if (!empty($s_ktpa)) {
                    $config['upload_path'] = './uploads/ktpa/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_ktpa);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-ktpa.".$ext;
                    $ktpa = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_ktpa');
                }

                if (!empty($s_ktpi)) {
                    $config['upload_path'] = './uploads/ktpi/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_ktpi);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-ktpi.".$ext;
                    $ktpi = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_ktpi');
                }

                if (!empty($s_kips)) {
                    $config['upload_path'] = './uploads/kips/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_kips);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-kips.".$ext;
                    $kips = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_kips');
                }

                if (!empty($s_sktm)) {
                    $config['upload_path'] = './uploads/sktm/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_sktm);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-sktm.".$ext;
                    $sktm = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_sktm');
                }

                if (!empty($s_ijazah)) {
                    $config['upload_path'] = './uploads/ijazah/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_ijazah);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-ijazah.".$ext;
                    $ijazah = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_ijazah');
                }

                if (!empty($s_skhun)) {
                    $config['upload_path'] = './uploads/skhun/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['overwrite'] = TRUE;
                    $x = explode(".", $s_skhun);
                    $ext = strtolower(end($x));
                    $config['file_name'] = $s_id."-skhun.".$ext;
                    $skhun = $config['file_name'];
                    $this->upload->initialize($config);
                    $this->upload->do_upload('s_skhun');
                }

                if (!empty($s_foto) && !$this->upload->do_upload('s_foto')) {
                    $data['err_foto'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_kk) && !$this->upload->do_upload('s_kk')) {
                    $data['err_kk'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_ktpa) && !$this->upload->do_upload('s_ktpa')) {
                    $data['err_ktpa'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_ktpi) && !$this->upload->do_upload('s_ktpi')) {
                    $data['err_ktpi'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_kips) && !$this->upload->do_upload('s_kips')) {
                    $data['err_kips'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_sktm) && !$this->upload->do_upload('s_sktm')) {
                    $data['err_sktm'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_ijazah) && !$this->upload->do_upload('s_ijazah')) {
                    $data['err_ijazah'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else if (!empty($s_skhun) && !$this->upload->do_upload('s_skhun')) {
                    $data['err_skhun'] = $this->upload->display_errors();
                    $where = "m_is_deleted = 'False'";
                    $data['majors'] = $this->m_students->get_majors($where);
                    $data['title'] = "Tambah ".self::$title;
                    $data['form_title'] = "Tambah Siswa";
                    $data['action'] = site_url(uri_string());
                    $data['content'] = 'dashboard/student-form';
                    $this->load->view('dashboard/index', $data);

                } else {

                    $data = [
                        's_id' => $s_id,
                        's_nisn' => $this->input->post('s_nisn', TRUE),
                        's_nisn' => $this->input->post('s_nisn', TRUE),
                        's_name' => $this->input->post('s_name', TRUE),
                        's_dob' => $this->input->post('s_dob', TRUE),
                        's_gender' => $this->input->post('s_gender', TRUE),
                        's_grade' => $this->input->post('s_grade', TRUE),
                        's_mid' => $this->input->post('s_mid', TRUE),
                        's_yi' => $this->input->post('s_yi', TRUE),
                        's_foto' => (!empty($foto)) ? $foto : NULL,
                        's_kk' => (!empty($kk)) ? $kk : NULL,
                        's_ktpa' => (!empty($ktpa)) ? $ktpa : NULL,
                        's_ktpi' => (!empty($ktpi)) ? $ktpi : NULL,
                        's_kips' => (!empty($kips)) ? $kips : NULL,
                        's_sktm' => (!empty($sktm)) ? $sktm : NULL,
                        's_ijazah' => (!empty($ijazah)) ? $ijazah : NULL,
                        's_skhun' => (!empty($skhun)) ? $skhun : NULL,
                        's_status' => $this->input->post('s_status', TRUE),
                        's_created_by' => $this->session->userdata['u_id'],
                        's_is_active' => 'Aktif'
                    ];

                    $this->m_students->add($data);
                    $this->session->set_flashdata('alert', success('Data siswa berhasil ditambahkan.'));
                    $data['title'] = "Data ".self::$title;
                    $data['content'] = "dashboard/student";
                    redirect('student');
                }
            }

        } else {
            $where = "m_is_deleted = 'False'";
            $data['majors'] = $this->m_students->get_majors($where);
            $data['title'] = "Tambah ".self::$title;
            $data['form_title'] = "Tambah Siswa";
            $data['s_name'] = "";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/student-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function import()
    {
        $this->load->helper(['form', 'notification', 'string']);

        if (isset($_POST['import'])) {
            $file = $_FILES['scsv']['tmp_name'];

            if (empty($file)) {
                $this->session->set_flashdata('alert', error('Form file data siswa wajib diisi!'));
                $data['title'] = "Impor Data ".self::$title;
                $data['form_title'] = "Impor Data Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-import';
                $this->load->view('dashboard/index', $data);
            }

            $eks = explode('.', $_FILES['scsv']['name']);

            if (strtolower(end($eks)) === 'csv') {
                $handle = fopen($file, "r");
                while (($row = fgetcsv($handle, 2048))) {

                    for ($i = 1; $i <= count($row) ; $i++) {
                        $s_id = random_string('alnum', 10);
                    }

                    $data = [
                        's_id' => $s_id,
                        's_nisn' => $row[1],
                        's_name' => $row[2],
                        's_dob' => $row[3],
                        's_gender' => $row[4],
                        's_grade' => $row[5],
                        's_mid' => $row[6],
                        's_yi' => $row[7],
                        's_yo' => $row[8],
                        's_foto' => NULL,
                        's_kk' => NULL,
                        's_ktpa' => NULL,
                        's_ktpi' => NULL,
                        's_kips' => NULL,
                        's_sktm' => NULL,
                        's_ijazah' => NULL,
                        's_skhun' => NULL,
                        's_status' => 'Belum Ada Data',
                        's_created_at' => date('Y-m-d H:i:s'),
                        's_updated_at' => date('Y-m-d H:i:s'),
                        's_deleted_at' => NULL,
                        's_restored_at' => NULL,
                        's_created_by' => $this->session->userdata['u_id'],
                        's_updated_by' => $this->session->userdata['u_id'],
                        's_deleted_by' => NULL,
                        's_restored_by' => NULL,
                        's_is_deleted' => 'FALSE',
                        's_is_active' => 'Aktif'
                    ];

                    $this->db->insert(self::$table, $data);
                }

                fclose($handle);
                $this->session->set_flashdata('alert', success('Data siswa berhasil diimport.'));
                $data['title'] = "Impor Data ".self::$title;
                $data['content'] = 'dashboard/student';
                redirect('student');

            } else {
                $this->session->set_flashdata('alert', error('Formal file yang diperbolehkan hanya *.csv.'));
                $data['title'] = "Impor Data ".self::$title;
                $data['form_title'] = "Impor Data Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-import';
                $this->load->view('dashboard/index', $data);

            }
        } else {
            $data['title'] = "Impor Data ".self::$title;
            $data['form_title'] = "Impor Data Siswa";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/student-import';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function view()
    {
        $s_id = $this->uri->segment(3);

        $where = "s_id = '$s_id'";

        $data['student'] = $this->m_students->get_students($where);
        $data['title'] = $data['student']['s_name']." &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['attachment'] = 'Lampiran';
        $data['content'] = 'dashboard/student-view';
        if (!$s_id) {
            redirect(site_url('student'));
        } else {
            $this->load->view('dashboard/index', $data);
        }
    }

    public function print_data()
    {
        $s_id = $this->uri->segment(3);

        $where = "s_id = '$s_id'";

        $data['student'] = $this->m_students->get_students($where);
        $data['title'] = $data['student']['s_name']." &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['attachment'] = 'Lampiran';
        if (!$s_id) {
            redirect(site_url('student'));
        } else {
            $this->load->view('dashboard/student-print', $data);
        }
    }

    public function status($s_id)
    {
        $this->auth->not_admin();
        $this->load->helper('notification');

        $data = [
			's_yo' => date('Y'),
			's_updated_at' => date('Y-m-d H:i:s'),
			's_updated_by' => $this->session->userdata['u_id'],
			's_is_active' => 'Tidak Aktif'
		];

        $this->m_students->status($data, $s_id);
        $this->session->set_flashdata('alert', success('Status data siswa berhasil diperbarui.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/student";
        $this->load->view('dashboard/index', $data);
        redirect(site_url('student'));
    }

    public function edit()
    {
        $this->load->helper(['form', 'notification']);
        $s_id = $this->uri->segment(3);
        $where = "s_id = '$s_id'";
        $data['student'] = $this->m_students->get_students($where);

        if ($this->validation()) {

            $s_foto = $_FILES['s_foto']['name'];
            $s_kk = $_FILES['s_kk']['name'];
            $s_ktpa = $_FILES['s_ktpa']['name'];
            $s_ktpi = $_FILES['s_ktpi']['name'];
            $s_kips = $_FILES['s_kips']['name'];
            $s_sktm = $_FILES['s_sktm']['name'];
            $s_ijazah = $_FILES['s_ijazah']['name'];
            $s_skhun = $_FILES['s_skhun']['name'];

            $this->load->library('upload');

            if (!empty($s_foto)) {
                $config['upload_path'] = './uploads/foto/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '1024';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_foto);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-foto.".$ext;
                $foto = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_foto');
            }

            if (!empty($s_kk)) {
                $config['upload_path'] = './uploads/kk/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_kk);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-kk.".$ext;
                $kk = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_kk');
            }

            if (!empty($s_ktpa)) {
                $config['upload_path'] = './uploads/ktpa/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_ktpa);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-ktpa.".$ext;
                $ktpa = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_ktpa');
            }

            if (!empty($s_ktpi)) {
                $config['upload_path'] = './uploads/ktpi/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_ktpi);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-ktpi.".$ext;
                $ktpi = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_ktpi');
            }

            if (!empty($s_kips)) {
                $config['upload_path'] = './uploads/kips/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_kips);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-kips.".$ext;
                $kips = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_kips');
            }

            if (!empty($s_sktm)) {
                $config['upload_path'] = './uploads/sktm/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_sktm);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-sktm.".$ext;
                $sktm = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_sktm');
            }

            if (!empty($s_ijazah)) {
                $config['upload_path'] = './uploads/ijazah/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_ijazah);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-ijazah.".$ext;
                $ijazah = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_ijazah');
            }

            if (!empty($s_skhun)) {
                $config['upload_path'] = './uploads/skhun/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '2048';
                $config['overwrite'] = TRUE;
                $x = explode(".", $s_skhun);
                $ext = strtolower(end($x));
                $config['file_name'] = $s_id."-skhun.".$ext;
                $skhun = $config['file_name'];
                $this->upload->initialize($config);
                $this->upload->do_upload('s_skhun');
            }

            if (!empty($s_foto) && !$this->upload->do_upload('s_foto')) {
                $data['err_foto'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_kk) && !$this->upload->do_upload('s_kk')) {
                $data['err_kk'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_ktpa) && !$this->upload->do_upload('s_ktpa')) {
                $data['err_ktpa'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_ktpi) && !$this->upload->do_upload('s_ktpi')) {
                $data['err_ktpi'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_kips) && !$this->upload->do_upload('s_kips')) {
                $data['err_kips'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_sktm) && !$this->upload->do_upload('s_sktm')) {
                $data['err_sktm'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_ijazah) && !$this->upload->do_upload('s_ijazah')) {
                $data['err_ijazah'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else if (!empty($s_skhun) && !$this->upload->do_upload('s_skhun')) {
                $data['err_skhun'] = $this->upload->display_errors();
                $where = "m_is_deleted = 'False'";
                $data['majors'] = $this->m_students->get_majors($where);
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Siswa";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/student-form';
                $this->load->view('dashboard/index', $data);

            } else {

                $data = [
                    's_id' => $s_id,
                    's_nisn' => $this->input->post('s_nisn', TRUE),
                    's_nisn' => $this->input->post('s_nisn', TRUE),
                    's_name' => $this->input->post('s_name', TRUE),
                    's_dob' => $this->input->post('s_dob', TRUE),
                    's_gender' => $this->input->post('s_gender', TRUE),
                    's_grade' => $this->input->post('s_grade', TRUE),
                    's_mid' => $this->input->post('s_mid', TRUE),
                    's_yi' => $this->input->post('s_yi', TRUE),
                    's_foto' => (!empty($foto)) ? $foto : $data['student']['s_foto'],
                    's_kk' => (!empty($kk)) ? $kk : $data['student']['s_kk'],
                    's_ktpa' => (!empty($ktpa)) ? $ktpa : $data['student']['s_ktpa'],
                    's_ktpi' => (!empty($ktpi)) ? $ktpi : $data['student']['s_ktpi'],
                    's_kips' => (!empty($kips)) ? $kips : $data['student']['s_kips'],
                    's_sktm' => (!empty($sktm)) ? $sktm : $data['student']['s_sktm'],
                    's_ijazah' => (!empty($ijazah)) ? $ijazah : $data['student']['s_ijazah'],
                    's_skhun' => (!empty($skhun)) ? $skhun : $data['student']['s_skhun'],
                    's_status' => $this->input->post('s_status', TRUE),
                    's_updated_at' => date('Y-m-d H:i:s'),
        			's_updated_by' => $this->session->userdata['u_id'],
                ];

                $this->m_students->edit($data, $s_id);
                $this->session->set_flashdata('alert', success('Data siswa berhasil diperbarui.'));
                $data['title'] = "Data ".self::$title;
                $data['content'] = "dashboard/student";
                redirect(site_url('student'));
            }

        } else {
            $data['majors'] = $this->m_students->get_majors();
            $data['title'] = "Edit ".self::$title;
            $data['form_title'] = "Edit Data ".$data['student']['s_name'] ;
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/student-form';
            if (!$s_id) {
                redirect(site_url('student'));
            } else {
                $this->load->view('dashboard/index', $data);
            }
        }
    }

    public function delete($s_id)
    {
        $this->load->helper('notification');

        $data = [
            's_deleted_at' => date('Y-m-d H:i:s'),
            's_deleted_by' => $this->session->userdata['u_id'],
            's_is_deleted' => TRUE
        ];

        $this->m_students->delete($data, $s_id);
        $this->session->set_flashdata('alert', success('Data siswa berhasil dihapus.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/student";
        $this->load->view('dashboard/index', $data);
        redirect(site_url('student'));
    }

    public function deleted()
    {
        $data['title'] = "Data Siswa Terhapus &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = "dashboard/student-deleted";
        $this->load->view('dashboard/index', $data);
    }

    public function get_deleted()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 's_nisn', 'dt' => 's_nisn'),
                array('db' => 's_name', 'dt' => 's_name'),
                array('db' => 's_dob', 'dt' => 's_dob'),
                array('db' => 's_gender', 'dt' => 's_gender'),
                array('db' => 's_grade', 'dt' => 's_grade'),
                array('db' => 'm_id', 'dt' => 'm_id'),
                array('db' => 's_deleted_at', 'dt' => 's_deleted_at'),
                array(
                    'db' => 's_id',
                    'dt' => 'tindakan',
                    'formatter' => function($s_id) {
                        return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('student/restore/'.$s_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN majors ON majors.m_id = students.s_mid";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "s_is_deleted = 'TRUE'", $qjoin)
            );
        }
    }

    public function restore()
    {
        $this->load->helper(['form', 'notification']);
        $s_id = $this->uri->segment(3);

        $data = [
			's_restored_at' => date('Y-m-d H:i:s'),
			's_restored_by' => $this->session->userdata['u_id'],
			's_is_deleted' => 'FALSE'
		];

        $this->m_students->restore($data ,$s_id);
        $this->session->set_flashdata('alert', success('Data siswa berhasil direstore.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/student-deleted";
        redirect(site_url('student/deleted'));
    }

    public function archived()
    {
        $this->auth->admin();
        $data['title'] = "Arsip ".self::$title;
        $data['content'] = "dashboard/student-archived";
        $this->load->view('dashboard/index', $data);
    }

    public function get_archived()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 's_nisn', 'dt' => 's_nisn'),
                array('db' => 's_name', 'dt' => 's_name'),
                array('db' => 's_gender', 'dt' => 's_gender'),
                array('db' => 's_grade', 'dt' => 's_grade'),
                array('db' => 'm_id', 'dt' => 'm_id'),
                array('db' => 's_yi', 'dt' => 's_yi'),
                array('db' => 's_yo', 'dt' => 's_yo'),
                array('db' => 's_is_active', 'dt' => 's_is_active'),
                array(
                    'db' => 's_id',
                    'dt' => 'tindakan',
                    'formatter' => function($s_id) {
                        return '<a class="btn btn-info btn-sm mb" href="'.site_url('student/view/'.$s_id).'">Lihat</a>
                        <a class="btn btn-success btn-sm mb" onclick="return confirmDialog();" href="'.site_url('student/active/'.$s_id).'">Ubah Status</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN majors ON majors.m_id = students.s_mid";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "s_is_active = 'Tidak Aktif'", $qjoin)
            );
        }
    }

    public function active()
    {
        $this->load->helper('notification');
        $s_id = $this->uri->segment(3);

        $data = [
			's_yo' => NULL,
			's_updated_at' => date('Y-m-d H:i:s'),
			's_updated_by' => $this->session->userdata['u_id'],
			's_is_active' => 'Aktif'
		];

        $this->m_students->active($data, $s_id);
        $this->session->set_flashdata('alert', success('Status data siswa berhasil diperbarui.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/student-archived";
        redirect(site_url('student/archived'));
    }
}
