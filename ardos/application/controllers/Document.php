<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_documents');
        $this->auth->restrict();
    }

    private static $title = "Dokumen &minus; Arsip Dokumen Dokumen | SMK Muhammadiyah 3 Nganjuk";
    private static $table = 'documents';
    private static $primaryKey = 'd_id';

    public function index()
	{
        $where = "d_status = 'Kosong'";
        $data['map'] = $this->m_documents->gm($where);
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/document";
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
                array('db' => 's_grade', 'dt' => 's_grade'),
                array('db' => 's_mid', 'dt' => 's_mid'),
                array('db' => 'd_cname', 'dt' => 'd_cname'),
                array('db' => 'd_fname', 'dt' => 'd_fname'),
                array('db' => 'd_map', 'dt' => 'd_map'),
                array(
                    'db' => 'd_kode_map',
                    'dt' => 'd_kode_map',
                    'formatter' => function($d_kode_map) {
                        return '<span class="btn btn-danger btn-sm">'.$d_kode_map.'</span>';
                    }
                ),
                array(
                    'db' => 'd_id',
                    'dt' => 'tindakan',
                    'formatter' => function($d_id) {
                        return '<a class="btn btn-success btn-sm mb" href="'.site_url('document/view/'.$d_id).'">Lihat</a>
                        <a class="btn btn-info btn-sm mb" href="'.site_url('document/edit/'.$d_id).'">Ubah</a>
                        <a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('document/delete/'.$d_id).'" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        <a class="btn btn-warning btn-sm mb" href="'.site_url('document/borrow/'.$d_id).'">Pinjam</a>
                        <a class="btn btn-success btn-sm mb" href="'.site_url('document/returned/'.$d_id).'">Kembali</a>
                        <a class="btn btn-info btn-sm mb" href="'.site_url('document/take/'.$d_id).'" onclick="return confirmDialogTake()">Ambil</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN students ON students.s_id = documents.d_sid";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "d_status = 'Penuh' AND d_is_deleted = 'FALSE'", $qjoin )
            );
        }
    }

    public function detail()
    {
        $ad_id = $this->uri->segment(3);
        $where = "ad_id = '$ad_id'";
        $data['document'] = $this->m_documents->get_details($where);
        $data['title'] = $data['document']['s_name']." &minus; Arsip Dokumen Dokumen | SMK Muhammadiyah 3 Nganjuk";
        $data['attachment'] = 'Isi Dokumen';
        $data['content'] = 'dashboard/document-view';
        if (!$ad_id) {
            redirect(site_url('document'));
        } else {
            $this->load->view('dashboard/index', $data);
        }
    }

    public function find()
    {
        $keyword = $this->uri->segment(3);
        $where = "s_is_active = 'Aktif'";
        $data = $this->m_documents->get_result($keyword, $where);

        if (is_array($data) && !empty($data)) {
            foreach($data as $row)
            {
                $arr['query'] = $keyword;
                $arr['suggestions'][] = [
                    'value'	=> $row->s_nisn." — ".$row->s_name." — ".$row->s_grade." — ".$row->m_name,
                    's_id' => $row->s_id,
                    's_name' => $row->s_name,
                    's_nisn' => $row->s_nisn,
                    's_grade' => $row->s_grade,
                    'm_name' => $row->m_name,
                ];
            }
            echo json_encode($arr);

        } else {
            $arr['suggestions'][] = [
                'value'	=> "<span>Siswa tidak ditemukan!</span>",
                's_id' => "",
                's_name' => "",
                's_nisn' => "",
                's_grade' => "",
                'm_name' => "",
            ];
            echo json_encode($arr);
        }
    }

    public function add()
    {
        $this->load->helper(['form', 'string', 'notification']);

        if ($this->validation()) {
            $d_sid = $this->input->post('d_sid', TRUE);
            $where = "d_sid = '$d_sid'";
            $data = $this->m_documents->is_exist($where);
            $d_kode_map = $this->input->post('d_kode_map', TRUE);
            $wkm = "d_kode_map = '$d_kode_map'";
            $dkm = $this->m_documents->is_exist_km($wkm);

            if ($data['d_sid'] === $this->input->post('d_sid', TRUE)) {
                $data['document'] = FALSE;
                $wc = "c_is_deleted = 'FALSE'";
                $data['cabinet'] = $this->m_documents->get_cabinets($wc);
                $wf = "f_is_deleted = 'FALSE'";
                $data['folder'] = $this->m_documents->get_folders($wf);

                $this->session->set_flashdata('alert', error('Siswa ini sudah pernah mengumpulkan data!'));
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Dokumen";
                $data['s_name'] = "";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/document-form';
                $this->load->view('dashboard/index', $data);

            } else if ($dkm['d_kode_map'] === $this->input->post('d_kode_map', TRUE)) {
                $data['document'] = FALSE;
                $wc = "c_is_deleted = 'FALSE'";
                $data['cabinet'] = $this->m_documents->get_cabinets($wc);
                $wf = "f_is_deleted = 'FALSE'";
                $data['folder'] = $this->m_documents->get_folders($wf);

                $this->session->set_flashdata('alert', error('Kode map sudah digunakan!'));
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Dokumen";
                $data['s_name'] = "";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/document-form';
                $this->load->view('dashboard/index', $data);

            } else {
                $ijazah = $this->input->post('d_ijazah', TRUE);
                $skhun = $this->input->post('d_skhun', TRUE);
                $kk = $this->input->post('d_kk', TRUE);
                $ktpa = $this->input->post('d_ktpa', TRUE);
                $ktpi = $this->input->post('d_ktpi', TRUE);
                $kips = $this->input->post('d_kips', TRUE);
                $sktm = $this->input->post('d_sktm', TRUE);

                if ($ijazah == "Ada") {
                    $d_ijazah_added_at = date('Y-m-d H:i:s');
                    $d_ijazah_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_ijazah_added_at = NULL;
                    $d_ijazah_added_by = NULL;
                }
                if ($skhun == "Ada") {
                    $d_skhun_added_at = date('Y-m-d H:i:s');
                    $d_skhun_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_skhun_added_at = NULL;
                    $d_skhun_added_by = NULL;
                }
                if ($kk == "Ada") {
                    $d_kk_added_at = date('Y-m-d H:i:s');
                    $d_kk_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_kk_added_at = NULL;
                    $d_kk_added_by = NULL;
                }
                if ($ktpa == "Ada") {
                    $d_ktpa_added_at = date('Y-m-d H:i:s');
                    $d_ktpa_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_ktpa_added_at = NULL;
                    $d_ktpa_added_by = NULL;
                }
                if ($ktpi == "Ada") {
                    $d_ktpi_added_at = date('Y-m-d H:i:s');
                    $d_ktpi_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_ktpi_added_at = NULL;
                    $d_ktpi_added_by = NULL;
                }
                if ($kips == "Ada") {
                    $d_kips_added_at = date('Y-m-d H:i:s');
                    $d_kips_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_kips_added_at = NULL;
                    $d_kips_added_by = NULL;
                }
                if ($sktm == "Ada") {
                    $d_sktm_added_at = date('Y-m-d H:i:s');
                    $d_sktm_added_by = $this->session->userdata['u_fname'];
                } else {
                    $d_sktm_added_at = NULL;
                    $d_sktm_added_by = NULL;
                }

                $data = [
                    'd_id' => random_string('alnum', 10),
                    'd_sid' => $this->input->post('d_sid', TRUE),
                    'd_ijazah' => $ijazah,
                    'd_ijazah_added_at' => $d_ijazah_added_at,
                    'd_ijazah_added_by' => $d_ijazah_added_by,
                    'd_skhun' => $skhun,
                    'd_skhun_added_at' => $d_skhun_added_at,
                    'd_skhun_added_by' => $d_skhun_added_by,
                    'd_kk' => $kk,
                    'd_kk_added_at' => $d_kk_added_at,
                    'd_kk_added_by' => $d_kk_added_by,
                    'd_ktpa' => $ktpa,
                    'd_ktpa_added_at' => $d_ktpa_added_at,
                    'd_ktpa_added_by' => $d_ktpa_added_by,
                    'd_ktpi' => $ktpi,
                    'd_ktpi_added_at' => $d_ktpi_added_at,
                    'd_ktpi_added_by' => $d_ktpi_added_by,
                    'd_kips' => $kips,
                    'd_kips_added_at' => $d_kips_added_at,
                    'd_kips_added_by' => $d_kips_added_by,
                    'd_sktm' => $sktm,
                    'd_sktm_added_at' => $d_sktm_added_at,
                    'd_sktm_added_by' => $d_sktm_added_by,
                    'd_cname' => $this->input->post('d_cname', TRUE),
                    'd_fname' => $this->input->post('d_fname', TRUE),
                    'd_map' => $this->input->post('d_map', TRUE),
                    'd_kode_map' => $this->input->post('d_kode_map', TRUE),
                    'd_status' => 'Penuh',
                    'd_created_by' => $this->session->userdata['u_fname'],
                    'd_is_deleted' => 'FALSE'
                ];

                $this->m_documents->add($data);
                $this->session->set_flashdata('alert', success('Data dokumen berhasil ditambahkan.'));
                redirect('document');
            }

        } else {
            $data['document'] = FALSE;
            $wc = "c_is_deleted = 'FALSE'";
            $data['cabinet'] = $this->m_documents->get_cabinets($wc);
            $wf = "f_is_deleted = 'FALSE'";
            $data['folder'] = $this->m_documents->get_folders($wf);
            $data['lastmap'] = $this->m_documents->get_last();
            $data['title'] = "Tambah ".self::$title;
            $data['form_title'] = "Tambah Dokumen";
            $data['s_name'] = "";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/document-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function check()
    {
        $keyword = $this->input->get('keyword', TRUE);
        $where = "d_sid = '$keyword'";
        echo $this->m_documents->get_maps($where) ? 1 : 0;
    }

    public function result()
    {
        $keyword = $this->input->get('keyword', TRUE);
        $where = "d_kode_map = '$keyword'";
        echo $this->m_documents->get_maps($where) ? 1 : 0;
    }

    public function edit()
    {
        $this->load->helper(['form', 'string', 'notification']);
        $d_id = $this->uri->segment(3);

        if (!$d_id) {
            redirect(site_url('document'));
        }

        $where = "d_id = '$d_id'";
        $data['document'] = $this->m_documents->get_documents($where);

        if ($this->validation()) {
            $ijazah = $this->input->post('d_ijazah', TRUE);
            $skhun = $this->input->post('d_skhun', TRUE);
            $kk = $this->input->post('d_kk', TRUE);
            $ktpa = $this->input->post('d_ktpa', TRUE);
            $ktpi = $this->input->post('d_ktpi', TRUE);
            $kips = $this->input->post('d_kips', TRUE);
            $sktm = $this->input->post('d_sktm', TRUE);

            $check = $this->m_documents->not_empty($d_id);

            if ($ijazah == $check['d_ijazah']) {
                $d_ijazah_added_at = $data['document']['d_ijazah_added_at'];
                $d_ijazah_added_by = $data['document']['d_ijazah_added_by'];
            } else {
                $d_ijazah_added_at = date('Y-m-d H:i:s');
                $d_ijazah_added_by = $this->session->userdata['u_fname'];
            }
            if ($skhun == $check['d_skhun']) {
                $d_skhun_added_at = $data['document']['d_skhun_added_at'];
                $d_skhun_added_by = $data['document']['d_skhun_added_by'];
            } else {
                $d_skhun_added_at = date('Y-m-d H:i:s');
                $d_skhun_added_by = $this->session->userdata['u_fname'];
            }
            if ($kk == $check['d_kk']) {
                $d_kk_added_at = $data['document']['d_kk_added_at'];
                $d_kk_added_by = $data['document']['d_kk_added_by'];
            } else {
                $d_kk_added_at = date('Y-m-d H:i:s');
                $d_kk_added_by = $this->session->userdata['u_fname'];
            }
            if ($ktpa == $check['d_ktpa']) {
                $d_ktpa_added_at = $data['document']['d_ktpa_added_at'];
                $d_ktpa_added_by = $data['document']['d_ktpa_added_by'];
            } else {
                $d_ktpa_added_at = date('Y-m-d H:i:s');
                $d_ktpa_added_by = $this->session->userdata['u_fname'];
            }
            if ($ktpi == $check['d_ktpi']) {
                $d_ktpi_added_at = $data['document']['d_ktpi_added_at'];
                $d_ktpi_added_by = $data['document']['d_ktpi_added_by'];
            } else {
                $d_ktpi_added_at = date('Y-m-d H:i:s');
                $d_ktpi_added_by = $this->session->userdata['u_fname'];
            }
            if ($kips == $check['d_kips']) {
                $d_kips_added_at = $data['document']['d_kips_added_at'];
                $d_kips_added_by = $data['document']['d_kips_added_by'];
            } else {
                $d_kips_added_at = date('Y-m-d H:i:s');
                $d_kips_added_by = $this->session->userdata['u_fname'];
            }
            if ($sktm == $check['d_sktm']) {
                $d_sktm_added_at = $data['document']['d_sktm_added_at'];
                $d_sktm_added_by = $data['document']['d_sktm_added_by'];
            } else {
                $d_sktm_added_at = date('Y-m-d H:i:s');
                $d_sktm_added_by = $this->session->userdata['u_fname'];
            }

            $data = [
                'd_ijazah' => $ijazah,
                'd_ijazah_added_at' => $d_ijazah_added_at,
                'd_ijazah_added_by' => $d_ijazah_added_by,
                'd_skhun' => $skhun,
                'd_skhun_added_at' => $d_skhun_added_at,
                'd_skhun_added_by' => $d_skhun_added_by,
                'd_kk' => $kk,
                'd_kk_added_at' => $d_kk_added_at,
                'd_kk_added_by' => $d_kk_added_by,
                'd_ktpa' => $ktpa,
                'd_ktpa_added_at' => $d_ktpa_added_at,
                'd_ktpa_added_by' => $d_ktpa_added_by,
                'd_ktpi' => $ktpi,
                'd_ktpi_added_at' => $d_ktpi_added_at,
                'd_ktpi_added_by' => $d_ktpi_added_by,
                'd_kips' => $kips,
                'd_kips_added_at' => $d_kips_added_at,
                'd_kips_added_by' => $d_kips_added_by,
                'd_sktm' => $sktm,
                'd_sktm_added_at' => $d_sktm_added_at,
                'd_sktm_added_by' => $d_sktm_added_by,
                'd_updated_at' => date('Y-m-d H:i:s'),
                'd_updated_by' => $this->session->userdata['u_fname']
            ];

            $this->m_documents->edit($data, $d_id);
            $this->session->set_flashdata('alert', success('Data dokumen berhasil diperbarui.'));
            redirect('document');

        } else {
            $data['title'] = "Edit ".self::$title;
            $data['form_title'] = "Edit Dokumen";
            $data['s_name'] = $data['document']['s_name'];
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/document-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function view()
    {
        $d_id = $this->uri->segment(3);
        $where = "d_id = '$d_id'";

        $data['document'] = $this->m_documents->get_documents($where);
        $data['title'] = $data['document']['s_name']." &minus; Arsip Dokumen Dokumen | SMK Muhammadiyah 3 Nganjuk";
        $data['attachment'] = 'Isi Dokumen';
        $data['content'] = 'dashboard/document-view';
        if (!$d_id) {
            redirect(site_url('document'));
        } else {
            $this->load->view('dashboard/index', $data);
        }
    }

    public function print_data()
    {
        $d_id = $this->uri->segment(3);
        $where = "d_id = '$d_id'";

        $data['document'] = $this->m_documents->get_documents($where);
        $data['title'] = $data['document']['d_name']." &minus; Arsip Dokumen Dokumen | SMK Muhammadiyah 3 Nganjuk";
        $data['attachment'] = 'Lampiran';
        if (!$d_id) {
            redirect(site_url('document'));
        } else {
            $this->load->view('dashboard/document-print', $data);
        }
    }

    public function take($d_id)
    {
        $this->load->helper(['notification', 'string']);

        $where = "d_id = '$d_id'";
        $d = $this->m_documents->get_documents($where);

        $s_id = $d['s_id'];
        $std = [
            's_yo' => date('Y-m-d H:i:s'),
            's_updated_by' => $this->session->userdata['u_id'],
            's_is_active' => 'Tidak Aktif'
        ];
        $this->m_documents->unactive($std, $s_id);

        $dar = [
            'ad_id' => $d['d_id'],
            'ad_sid' => $d['d_sid'],
            'ad_ijazah' => $d['d_ijazah'],
            'ad_ijazah_added_at' => $d['d_ijazah_added_at'],
            'ad_ijazah_borrowed_at' => $d['d_ijazah_borrowed_at'],
            'ad_ijazah_returned_at' => $d['d_ijazah_returned_at'],
            'ad_ijazah_added_by' => $d['d_ijazah_added_by'],
            'ad_ijazah_borrowed_by' => $d['d_ijazah_borrowed_by'],
            'ad_ijazah_returned_by' => $d['d_ijazah_returned_by'],
            'ad_skhun' => $d['d_skhun'],
            'ad_skhun_added_at' => $d['d_skhun_added_at'],
            'ad_skhun_borrowed_at' => $d['d_skhun_borrowed_at'],
            'ad_skhun_returned_at' => $d['d_skhun_returned_at'],
            'ad_skhun_added_by' => $d['d_skhun_added_by'],
            'ad_skhun_borrowed_by' => $d['d_skhun_borrowed_by'],
            'ad_skhun_returned_by' => $d['d_skhun_returned_by'],
            'ad_kk' => $d['d_kk'],
            'ad_kk_added_at' => $d['d_kk_added_at'],
            'ad_kk_added_by' => $d['d_kk_added_by'],
            'ad_ktpa' => $d['d_ktpa'],
            'ad_ktpa_added_at' => $d['d_ktpa_added_at'],
            'ad_ktpa_added_by' => $d['d_ktpa_added_by'],
            'ad_ktpi' => $d['d_ktpi'],
            'ad_ktpi_added_at' => $d['d_ktpi_added_at'],
            'ad_ktpi_added_by' => $d['d_ktpi_added_by'],
            'ad_kips' => $d['d_kips'],
            'ad_kips_added_at' => $d['d_kips_added_at'],
            'ad_kips_added_by' => $d['d_kips_added_by'],
            'ad_sktm' => $d['d_sktm'],
            'ad_sktm_added_at' => $d['d_sktm_added_at'],
            'ad_sktm_added_by' => $d['d_sktm_added_by'],
            'ad_cname' => $d['d_cname'],
            'ad_fname' => $d['d_fname'],
            'ad_map' => $d['d_map'],
            'ad_kode_map' => $d['d_kode_map'],
            'ad_status' => 'Diambil',
            'ad_updated_at' => $d['d_updated_at'],
            'ad_deleted_at' => $d['d_deleted_at'],
            'ad_restored_at' => $d['d_restored_at'],
            'ad_updated_by' => $d['d_updated_by'],
            'ad_deleted_by' => $d['d_deleted_by'],
            'ad_restored_by' => $d['d_restored_by'],
            'ad_is_deleted' => $d['d_is_deleted'],
            'ad_taken_at' => date('Y-m-d H:i:s'),
            'ad_taken_by' => $this->session->userdata['u_fname']
        ];

        $this->m_documents->save($dar, $d_id);

        $data = [
            'd_id' => random_string('alnum', 10),
            'd_sid' => NULL,
            'd_ijazah' => NULL,
            'd_ijazah_added_at' => NULL,
            'd_ijazah_borrowed_at' => NULL,
            'd_ijazah_returned_at' => NULL,
            'd_ijazah_added_by' => NULL,
            'd_ijazah_borrowed_by' => NULL,
            'd_ijazah_returned_by' => NULL,
            'd_skhun' => NULL,
            'd_skhun_added_at' => NULL,
            'd_skhun_borrowed_at' => NULL,
            'd_skhun_returned_at' => NULL,
            'd_skhun_added_by' => NULL,
            'd_skhun_borrowed_by' => NULL,
            'd_skhun_returned_by' => NULL,
            'd_kk' => NULL,
            'd_kk_added_at' => NULL,
            'd_kk_added_by' => NULL,
            'd_ktpa' => NULL,
            'd_ktpa_added_at' => NULL,
            'd_ktpa_added_by' => NULL,
            'd_ktpi' => NULL,
            'd_ktpi_added_at' => NULL,
            'd_ktpi_added_by' => NULL,
            'd_kips' => NULL,
            'd_kips_added_at' => NULL,
            'd_kips_added_by' => NULL,
            'd_sktm' => NULL,
            'd_sktm_added_at' => NULL,
            'd_sktm_added_by' => NULL,
            'd_status' => 'Kosong',
            'd_updated_at' => date('Y-m-d H:i:s'),
            'd_deleted_at' => NULL,
            'd_restored_at' => NULL,
            'd_updated_by' => $this->session->userdata['u_fname'],
            'd_deleted_by' => NULL,
            'd_restored_by' => NULL,
            'd_is_deleted' => 'FALSE'
		];

        $this->m_documents->edit($data, $d_id);
        $this->session->set_flashdata('alert', success('Status data dokumen berhasil diperbarui.'));
        redirect(site_url('document'));
    }

    public function delete($d_id)
    {
        $this->load->helper('notification');

        $data = [
            'd_deleted_at' => date('Y-m-d H:i:s'),
            'd_deleted_by' => $this->session->userdata['u_fname'],
            'd_is_deleted' => TRUE
        ];

        $this->m_documents->delete($data, $d_id);
        $this->session->set_flashdata('alert', success('Data dokumen berhasil dihapus.'));
        redirect(site_url('document'));
    }

    public function emptied()
    {
        $data['title'] = "Map Kosong &minus; Arsip Dokumen Dokumen | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = "dashboard/document-empty";
        $this->load->view('dashboard/index', $data);
    }

    public function get_empty()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'd_cname', 'dt' => 'd_cname'),
                array('db' => 'd_fname', 'dt' => 'd_fname'),
                array('db' => 'd_map', 'dt' => 'd_map'),
                array(
                    'db' => 'd_kode_map',
                    'dt' => 'd_kode_map',
                    'formatter' => function($d_kode_map) {
                        return '<span class="btn btn-danger btn-sm">'.$d_kode_map.'</span>';
                    }
                ),
                array('db' => 'd_created_at', 'dt' => 'd_created_at'),
                array('db' => 'd_created_by', 'dt' => 'd_created_by'),
                array(
                    'db' => 'd_id',
                    'dt' => 'tindakan',
                    'formatter' => function($d_id) {
                        return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('document/usemap/'.$d_id).'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Gunakan Map</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = NULL;

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "d_status = 'Kosong'", $qjoin)
            );
        }
    }

    public function usemap()
    {
        $this->load->helper(['form', 'string', 'notification']);
        $d_id = $this->uri->segment(3);

        if (!$d_id) {
            redirect(site_url('document/empty'));
        }

        if ($this->validation()) {
            $data = [
                'd_sid' => $this->input->post('d_sid', TRUE),
                'd_ijazah' => $this->input->post('d_ijazah', TRUE),
                'd_ijazah_added_at' => date('Y-m-d H:i:s'),
                'd_ijazah_added_by' => $this->session->userdata['u_fname'],
                'd_skhun' => $this->input->post('d_skhun', TRUE),
                'd_skhun_added_at' => date('Y-m-d H:i:s'),
                'd_skhun_added_by' => $this->session->userdata['u_fname'],
                'd_kk' => $this->input->post('d_kk', TRUE),
                'd_kk_added_at' => date('Y-m-d H:i:s'),
                'd_kk_added_by' => $this->session->userdata['u_fname'],
                'd_ktpa' => $this->input->post('d_ktpa', TRUE),
                'd_ktpa_added_at' => date('Y-m-d H:i:s'),
                'd_ktpa_added_by' => $this->session->userdata['u_fname'],
                'd_ktpi' => $this->input->post('d_ktpi', TRUE),
                'd_ktpi_added_at' => date('Y-m-d H:i:s'),
                'd_ktpi_added_by' => $this->session->userdata['u_fname'],
                'd_kips' => $this->input->post('d_kips', TRUE),
                'd_kips_added_at' => date('Y-m-d H:i:s'),
                'd_kips_added_by' => $this->session->userdata['u_fname'],
                'd_sktm' => $sktm = $this->input->post('d_sktm', TRUE),
                'd_sktm_added_at' => date('Y-m-d H:i:s'),
                'd_sktm_added_by' => $this->session->userdata['u_fname'],
                'd_updated_at' => date('Y-m-d H:i:s'),
                'd_updated_by' => $this->session->userdata['u_fname'],
                'd_status' => 'Penuh'
            ];

            $this->m_documents->edit($data, $d_id);
            $this->session->set_flashdata('alert', success('Data dokumen berhasil disimpan.'));
            redirect('document');

        } else {
            $where = "d_id = '$d_id'";
            $data['document'] = $this->m_documents->use_get_documents($where);

            $data['document']['s_nisn'] = "";
            $data['document']['s_name'] = "";
            $data['document']['s_grade'] = "";
            $data['document']['m_name'] = "";

            $data['title'] = "Gunakan Map ".self::$title;
            $data['form_title'] = "Gunakan Map";
            $data['s_name'] = "<span class='btn btn-danger'><strong>".$data['document']['d_kode_map']."</strong></span>";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/document-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function deleted()
    {
        $data['title'] = "Data Dokumen Terhapus &minus; Arsip Dokumen Dokumen | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = "dashboard/document-deleted";
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
                array('db' => 's_grade', 'dt' => 's_grade'),
                array('db' => 's_mid', 'dt' => 's_mid'),
                array(
                    'db' => 'd_kode_map',
                    'dt' => 'd_kode_map',
                    'formatter' => function($d_kode_map) {
                        return '<span class="btn btn-danger btn-sm">'.$d_kode_map.'</span>';
                    }
                ),
                array('db' => 'd_deleted_by', 'dt' => 'd_deleted_by'),
                array('db' => 'd_deleted_at', 'dt' => 'd_deleted_at'),
                array(
                    'db' => 'd_id',
                    'dt' => 'tindakan',
                    'formatter' => function($d_id) {
                        return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('document/restore/'.$d_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN students ON students.s_id = documents.d_sid";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "d_is_deleted = 'TRUE'", $qjoin )
            );
        }
    }

    public function restore()
    {
        $this->load->helper(['form', 'notification']);
        $d_id = $this->uri->segment(3);

        $data = [
			'd_restored_at' => date('Y-m-d H:i:s'),
			'd_restored_by' => $this->session->userdata['u_fname'],
			'd_is_deleted' => 'FALSE'
		];

        $this->m_documents->restore($data ,$d_id);
        $this->session->set_flashdata('alert', success('Data dokumen berhasil direstore.'));
        redirect(site_url('document/deleted'));
    }

    public function archived()
    {
        $data['title'] = "Arsip Dokumen Siswa &minus; ".self::$title;
        $data['content'] = "dashboard/document-archived";
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
                array('db' => 's_grade', 'dt' => 's_grade'),
                array('db' => 's_mid', 'dt' => 's_mid'),
                array(
                    'db' => 'ad_kode_map',
                    'dt' => 'ad_kode_map',
                    'formatter' => function($ad_kode_map) {
                        return '<span class="btn btn-danger btn-sm">'.$ad_kode_map.'</span>';
                    }
                ),
                array('db' => 'ad_updated_at', 'dt' => 'ad_updated_at'),
                array('db' => 'ad_taken_by', 'dt' => 'ad_taken_by'),
                array(
                    'db' => 'ad_id',
                    'dt' => 'tindakan',
                    'formatter' => function($ad_id) {
                        return '<a class="btn btn-success btn-sm mb" href="'.site_url('document/detail/'.$ad_id).'">Lihat Detail</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN students ON students.s_id = archived_documents.ad_sid";
            $table = "archived_documents";
            $primaryKey = "ad_id";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, $table, $primaryKey, $columns, NULL, "ad_status = 'Diambil'", $qjoin)
            );
        }
    }

    public function borrow()
    {
        $d_id = $this->uri->segment(3);
        if (!$d_id) {
            redirect(site_url('document'));
        }
        $where = "d_id = '$d_id'";
        $data['document'] = $this->m_documents->get_documents($where);
        $whi = "d_id = '$d_id' AND d_ijazah = 'Ada' AND d_ijazah_borrowed_at IS NULL";
        $data['bi'] = $this->m_documents->get_bi($whi);

        $whs = "d_id = '$d_id' AND d_skhun = 'Ada' AND d_skhun_borrowed_at IS NULL";
        $data['bs'] = $this->m_documents->get_bs($whs);

        $data['title'] = "Pinjam Dokumen ".self::$title;
        $data['content'] = "dashboard/document-br-form";
        $this->load->view('dashboard/index', $data);
    }

    public function borrow_ijazah($d_id)
    {
        $this->load->helper(['form', 'notification']);

        $data = [
            'd_ijazah_borrowed_at' => date('Y-m-d H:i:s'),
            'd_ijazah_borrowed_by' => $this->session->userdata['u_fname'],
            'd_ijazah_returned_at' => NULL,
            'd_ijazah_returned_by' => NULL
        ];

        $this->m_documents->edit($data ,$d_id);
        $this->session->set_flashdata('alert', success('Ijazah berhasil dipinjam.'));
        redirect(site_url('document'));
    }

    public function borrow_skhun($d_id)
    {
        $this->load->helper(['form', 'notification']);
        $data = [
            'd_skhun_borrowed_at' => date('Y-m-d H:i:s'),
            'd_skhun_borrowed_by' => $this->session->userdata['u_fname'],
            'd_skhun_returned_at' => NULL,
            'd_skhun_returned_by' => NULL
        ];
        $this->m_documents->edit($data ,$d_id);
        $this->session->set_flashdata('alert', success('SKHUN berhasil dipinjam.'));
        redirect(site_url('document'));
    }

    public function borrow_all($d_id)
    {
        $this->load->helper(['form', 'notification']);
        $data = [
            'd_ijazah_borrowed_at' => date('Y-m-d H:i:s'),
            'd_ijazah_borrowed_by' => $this->session->userdata['u_fname'],
            'd_ijazah_returned_at' => NULL,
            'd_ijazah_returned_by' => NULL,
            'd_skhun_borrowed_at' => date('Y-m-d H:i:s'),
            'd_skhun_borrowed_by' => $this->session->userdata['u_fname'],
            'd_skhun_returned_at' => NULL,
            'd_skhun_returned_by' => NULL
        ];
        $this->m_documents->edit($data ,$d_id);
        $this->session->set_flashdata('alert', success('Ijazah dan SKHUN berhasil dipinjam.'));
        redirect(site_url('document'));
    }

    public function returned()
    {
        $d_id = $this->uri->segment(3);
        if (!$d_id) {
            redirect(site_url('document'));
        }
        $where = "d_id = '$d_id'";
        $data['document'] = $this->m_documents->get_documents($where);

        $whi = "d_id = '$d_id' AND d_ijazah = 'Ada' AND d_ijazah_borrowed_at != 'NULL'";
        $data['ri'] = $this->m_documents->get_bi($whi);

        $whs = "d_id = '$d_id' AND d_skhun = 'Ada' AND d_skhun_borrowed_at != 'NULL'";
        $data['rs'] = $this->m_documents->get_bs($whs);

        $data['title'] = "Pinjam Dokumen ".self::$title;
        $data['content'] = "dashboard/document-br-form";
        $this->load->view('dashboard/index', $data);
    }

    public function return_ijazah($d_id)
    {
        $this->load->helper(['form', 'notification']);
        $data = [
            'd_ijazah_borrowed_at' => NULL,
            'd_ijazah_borrowed_by' => NULL,
            'd_ijazah_returned_at' => date('Y-m-d H:i:s'),
            'd_ijazah_returned_by' => $this->session->userdata['u_fname']
        ];
        $this->m_documents->edit($data ,$d_id);
        $this->session->set_flashdata('alert', success('Ijazah berhasil dikembalikan.'));
        redirect(site_url('document'));
    }

    public function return_skhun($d_id)
    {
        $this->load->helper(['form', 'notification']);
        $data = [
            'd_skhun_borrowed_at' => NULL,
            'd_skhun_borrowed_by' => NULL,
            'd_skhun_returned_at' => date('Y-m-d H:i:s'),
            'd_skhun_returned_by' => $this->session->userdata['u_fname']
        ];
        $this->m_documents->edit($data ,$d_id);
        $this->session->set_flashdata('alert', success('SKHUN berhasil dikembalikan.'));
        redirect(site_url('document'));
    }

    public function return_all($d_id)
    {
        $this->load->helper(['form', 'notification']);
        $data = [
            'd_ijazah_borrowed_at' => NULL,
            'd_ijazah_borrowed_by' => NULL,
            'd_ijazah_returned_at' => date('Y-m-d H:i:s'),
            'd_ijazah_returned_by' => $this->session->userdata['u_fname'],
            'd_skhun_borrowed_at' => NULL,
            'd_skhun_borrowed_by' => NULL,
            'd_skhun_returned_at' => date('Y-m-d H:i:s'),
            'd_skhun_returned_by' => $this->session->userdata['u_fname']
        ];
        $this->m_documents->edit($data ,$d_id);
        $this->session->set_flashdata('alert', success('Ijazah dan SKHUN berhasil dikembalikan.'));
        redirect(site_url('document'));
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('d_sid', 'Id Siswa', 'trim|required|exact_length[10]');
        $this->form_validation->set_rules('d_ijazah', 'Ijazah', 'trim|required');
        $this->form_validation->set_rules('d_skhun', 'SKHUN', 'trim|required');
        $this->form_validation->set_rules('d_kk', 'Kartu Keluarga', 'trim|required');
        $this->form_validation->set_rules('d_ktpa', 'KTP Ayah', 'trim|required');
        $this->form_validation->set_rules('d_ktpi', 'KTP Ibu', 'trim|required');
        $this->form_validation->set_rules('d_kips', 'KIP / KPS', 'trim|required');
        $this->form_validation->set_rules('d_sktm', 'SKTM', 'trim|required');
        $this->form_validation->set_rules('d_cname', 'Lemari', 'trim|required');
        $this->form_validation->set_rules('d_fname', 'Bendel', 'trim|required');
        $this->form_validation->set_rules('d_map', 'Map', 'trim|required');
        $this->form_validation->set_rules('d_kode_map', 'Kode Map', 'trim|required');
        return $this->form_validation->run();
    }
}
