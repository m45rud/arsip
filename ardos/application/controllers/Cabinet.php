<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cabinet extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_cabinets');
        $this->auth->restrict();
    }

    private static $title = "Lemari &minus; Arsip Dokumen Siswa | SMK Muhammadiyah 3 Nganjuk";
    private static $table = 'cabinets';
	private static $primaryKey = 'c_id';

    public function index()
	{
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/cabinet";
		$this->load->view('dashboard/index', $data);
	}

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'c_id', 'dt' => 'c_id'),
                array('db' => 'c_name', 'dt' => 'c_name'),
                array('db' => 'u_fname', 'dt' => 'u_fname'),
                array('db' => 'c_created_at', 'dt' => 'c_created_at'),
                array('db' => 'c_updated_at', 'dt' => 'c_updated_at'),
                array(
                    'db' => 'c_id',
                    'dt' => 'tindakan',
                    'formatter' => function($c_id) {
                        return '<a class="btn btn-info btn-sm mb" href="'.site_url('cabinet/edit/'.$c_id).'">Ubah</a>
                        <a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('cabinet/delete/'.$c_id).'">Hapus</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN users ON users.u_id = cabinets.c_created_by";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "c_is_deleted = 'FALSE'", $qjoin)
            );
        }
    }

    public function add()
    {
        $this->load->helper(['form', 'notification']);
        if ($this->validation()) {

            $c_name = $this->input->post('c_name', TRUE);
            $where = "c_name = '$c_name'";

            $data = $this->m_cabinets->is_exist($where);
            if (strtolower($data['c_name']) === strtolower($this->input->post('c_name', TRUE))) {
                $this->session->set_flashdata('alert', error('Nama Lemari sudah ada!'));
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Lemari";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/cabinet-form';
                $this->load->view('dashboard/index', $data);

            } else {
                $this->load->helper('string');

                $data = [
                    'c_id' => random_string('alnum', 5),
                    'c_name' => strtoupper($this->input->post('c_name', TRUE)),
                    'c_created_by' => $this->session->userdata['u_id'],
                    'c_is_deleted' => 'FALSE'
                ];

                $this->m_cabinets->add($data);
                $this->session->set_flashdata('alert', success('Data Lemari berhasil ditambahkan.'));
                redirect('cabinet');
            }

        } else {
            $data['cabinet'] = FALSE;
            $data['title'] = "Tambah ".self::$title;
            $data['form_title'] = "Tambah Lemari";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/cabinet-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function edit()
    {
        $this->load->helper(['form', 'notification']);
        $c_id = $this->uri->segment(3);

        if ($this->validation()) {
            $data = [
                'c_id' => $c_id,
                'c_name' => strtoupper($this->input->post('c_name', TRUE)),
                'c_updated_at' => date('Y-m-d H:i:s'),
                'c_updated_by' => $this->session->userdata['u_id']
            ];

            $this->m_cabinets->edit($data, $c_id);
            $this->session->set_flashdata('alert', success('Data Lemari berhasil diperbarui.'));
            redirect('cabinet');

        } else {
            $where = "c_id = '$c_id'";

            $data['cabinet'] = $this->m_cabinets->get_cabinets($where);
            $data['title'] = "Edit ".self::$title;
            $data['form_title'] = "Tambah Lemari";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/cabinet-form';
            if (!$c_id) {
                redirect('cabinet');
            } else {
                $this->load->view('dashboard/index', $data);
            }
        }
    }

    public function delete($c_id)
    {
        $this->load->helper('notification');

        $data = [
            'c_deleted_at' => date('Y-m-d H:i:s'),
            'c_deleted_by' => $this->session->userdata['u_id'],
            'c_is_deleted' => TRUE
        ];

        $this->m_cabinets->delete($data, $c_id);
        $this->session->set_flashdata('alert', success('Data Lemari berhasil dihapus.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/cabinet";
        $this->load->view('dashboard/index', $data);
        redirect('cabinet');
    }

    public function deleted()
    {
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/cabinet-deleted";
        $this->load->view('dashboard/index', $data);
    }

    public function get_deleted()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'c_name', 'dt' => 'c_name'),
                array('db' => 'u_fname', 'dt' => 'u_fname'),
                array('db' => 'c_created_at', 'dt' => 'c_created_at'),
                array('db' => 'c_deleted_at', 'dt' => 'c_deleted_at'),
                array(
                    'db' => 'c_id',
                    'dt' => 'tindakan',
                    'formatter' => function($c_id) {
                        return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('cabinet/restore/'.$c_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN users ON users.u_id = cabinets.c_deleted_by";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "c_is_deleted = 'TRUE'", $qjoin)
            );
        }
    }

    public function restore()
    {
        $this->load->helper('notification');
        $c_id = $this->uri->segment(3);

        $data = [
			'c_restored_at' => date('Y-m-d H:i:s'),
			'c_restored_by' => $this->session->userdata['u_id'],
			'c_is_deleted' => 'FALSE'
		];

        $this->m_cabinets->restore($data, $c_id);
        $this->session->set_flashdata('alert', success('Data Lemari berhasil direstore.'));
        redirect('cabinet/deleted');
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('c_name', 'Nama Lemari', 'trim|required|max_length[20]');
        return $this->form_validation->run();
    }

}
